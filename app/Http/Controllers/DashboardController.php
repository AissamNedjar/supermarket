<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Item;
use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use  Validator;


class DashboardController extends Controller
{

	public function __construct()
	{
	    $this->middleware('auth');
	}

	public function home(Request $request)
	{
		$items = Item::count();
		$buys = Buy::count();
		$sales = Sale::count();
		$salesToday = Sale::whereDate('created_at', Carbon::today())->count();

		$salesLast = Sale::orderBy('created_at', 'desc')->limit(20)->get();

		$ajax = false;
		if ($request->ajax()) {
			$ajax = true;
		}

	    return view('home', compact(
	    	'items',
	    	'buys',
	    	'sales',
	    	'salesToday',
	    	'salesLast',
	    	'ajax'
	    ));
	}

	public function ticket(Request $request, $id)
	{
		if ((int)$id == 0) {
			$ticket = new Sale();
			$ticket->user_id = Auth::user()->id;
			$ticket->save();

			$ticket_id = $ticket->id;
		}else {

			$ticket_id = $id;
		}

		$sale = Sale::findOrFail($ticket_id);
		$salesLast = Sale::orderBy('created_at', 'desc')->limit(20)->get();

		$ajax = false;
		if ($request->ajax()) {
			$ajax = true;
		}

	    return view('ticket', compact(
	    	'sale',
	    	'salesLast',
	    	'ajax'
	    ));
	}

	public function addbuy(Request $request, $id)
	{
		$sale = Sale::findOrFail($id);
		$salesLast = Sale::orderBy('created_at', 'desc')->limit(20)->get();

		$ajax = true;

		$product = $request->input('product');
		if (!empty($product)) {
			$product = str_replace(array('à', '&', 'é', '"', "'", '(', '-', 'è', '_', 'ç'), array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), $product);
			if (substr($product, 0, 1) == "+") {
				$item = 1;
				$price = substr($product, 1);
			}else {
				$search = Item::where('barcode', $product)->first();
				if ($search) {
					$item = $search->id;
					$price = $search->price;
				}else {
					$item = null;
				}
			}

			if ($item != null) {
				$buy = Buy::where('sale_id', $sale->id)->where('item_id', $item)->where('price', $price)->first();
				if ($buy) {
					$buy->increment('quantity', 1);
				}else {
					$new = New Buy();
					$new->user_id = Auth::user()->id;
					$new->sale_id = $sale->id;
					$new->item_id = $item;
					$new->price = $price;
					$new->quantity = 1;
					$new->save();
				}
			}
		}

	    return view('ticket', compact(
	    	'sale',
	    	'salesLast',
	    	'ajax'
	    ));
	}

	public function icondelete(Request $request, $id)
	{
		$item = Buy::findOrFail($id);
		$sale = Sale::findOrFail($item->sale_id);
		$item->delete();
		$salesLast = Sale::orderBy('created_at', 'desc')->limit(20)->get();

		$ajax = true;

	    return view('ticket', compact(
	    	'sale',
	    	'salesLast',
	    	'ajax'
	    ));
	}

	public function iconplus(Request $request, $id)
	{
		$item = Buy::findOrFail($id);
		$sale = Sale::findOrFail($item->sale_id);
		$item->increment('quantity', 1);
		$salesLast = Sale::orderBy('created_at', 'desc')->limit(20)->get();

		$ajax = true;

	    return view('ticket', compact(
	    	'sale',
	    	'salesLast',
	    	'ajax'
	    ));
	}

	public function iconminus(Request $request, $id)
	{
		$item = Buy::findOrFail($id);
		$sale = Sale::findOrFail($item->sale_id);
		if ($item->quantity == 1) {
			$item->delete();
		}else {
			$item->decrement('quantity', 1);
		}
		$salesLast = Sale::orderBy('created_at', 'desc')->limit(20)->get();

		$ajax = true;

	    return view('ticket', compact(
	    	'sale',
	    	'salesLast',
	    	'ajax'
	    ));
	}

	public function print(Request $request, $id)
	{
		$sale = Sale::findOrFail($id);

	    return view('print', compact(
	    	'sale'
	    ));
	}

	public function items(Request $request)
	{
        $appends = [];

        $orderKey = $request->get('orderKey');
        $orderBy = $request->get('orderBy');

        $search = str_replace(array('à', '&', 'é', '"', "'", '(', '-', 'è', '_', 'ç'), array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), $request->get('search'));


        $orderKey = ($orderKey == "" ? "id" : $orderKey);
        $orderBy = ($orderBy == "" ? "asc" : $orderBy);

        $appends['orderKey'] = $orderKey;
        $appends['orderBy'] = $orderBy;

        $orderKeyList = array(
            'id' => 'رقم السلعة',
            'name' => 'إسم السلعة',
            'price' => 'سعر السلعة',
            'barcode' => 'باركود السلعة'
        );

        $route = route("items");

        if (!empty($search)) {
            $appends['search'] = $search;
        }

        $array = Item::where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%')
                            ->orWhere('price', 'like', '%'.$search.'%')
                            ->orWhere('barcode', 'like', '%'.$search.'%');
                });
            }
        })->orderBy($orderKey, $orderBy)->paginate(20);

        $array->appends($appends);

		$ajax = false;
		if ($request->ajax()) {
			$ajax = true;
		}

	    return view('items.list', compact(
            'array',
            'search',
            'orderKey',
            'orderBy',
            'orderKeyList',
            'route',
	    	'ajax'
	    ));
	}

	public function tickets(Request $request)
	{
        $appends = [];

        $orderKey = $request->get('orderKey');
        $orderBy = $request->get('orderBy');

        $search = $request->get('search');


        $orderKey = ($orderKey == "" ? "id" : $orderKey);
        $orderBy = ($orderBy == "" ? "asc" : $orderBy);

        $appends['orderKey'] = $orderKey;
        $appends['orderBy'] = $orderBy;

        $orderKeyList = array(
            'id' => 'رقم التذكرة'
        );

        $route = route("tickets");

        if (!empty($search)) {
            $appends['search'] = $search;
        }

        $array = Sale::where(function ($query) use ($search) {
            if (!empty($search)) {
                $query->where(function ($query) use ($search) {
                    $query->where('id', $search);
                });
            }
        })->orderBy($orderKey, $orderBy)->paginate(20);

        $array->appends($appends);

		$ajax = false;
		if ($request->ajax()) {
			$ajax = true;
		}

	    return view('items.tickets', compact(
            'array',
            'search',
            'orderKey',
            'orderBy',
            'orderKeyList',
            'route',
	    	'ajax'
	    ));
	}

	public function addEditItem(Request $request, $id)
	{
		if ((int)$id != 0) {
			$item = Item::findOrFail($id);
			$id = $item->id;
			$name = $item->name;
			$price = $item->price;
			$barcode = $item->barcode;
		}else {
			$id = 0;
			$name = '';
			$price = '';
			$barcode = '';
		}

		$ajax = false;
		if ($request->ajax()) {
			$ajax = true;
		}

	    return view('items.addedit', compact(
	    	'id',
	    	'name',
	    	'price',
	    	'barcode',
	    	'ajax'
	    ));
	}

	public function storeItem(Request $request, $id)
	{

	    $requestData = $request->all();

	    $requestData['barcode'] = str_replace(array('à', '&', 'é', '"', "'", '(', '-', 'è', '_', 'ç'), array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), $requestData['barcode']);

	    $request->replace($requestData);

        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'barcode' => 'required|unique:items,barcode,'.$id
        ];

        $messages = [
            'name.required' => 'إسم السلعة مطلوب.',
            'price.required' => 'سعر السلعة مطلوب.',
            'price.numeric' => 'سعر السلعة يجب أن يكون أرقام فقط.',
            'barcode.required' => 'باركود السلعة مطلوب.',
            'barcode.unique' => 'باركود السلعة مستعمل من قبل.'
        ];

        $validate = Validator::make($request->all(), $rules, $messages);

        if ($validate->fails()) {
            $data = [
                'status' => 'error',
                'message' => 'هناك بعض الأخطاء, الرجاء معالجتها!',
                'errors' => $validate->errors()
            ];
        }else {
			if ((int)$id != 0) {
				$item = Item::findOrFail($id);
				$item->name = $request->input('name');
				$item->price = $request->input('price');
				$item->barcode = $request->input('barcode');
				$item->save();

				$type = 'edit';
				$message = 'تم تحديث السلعة بنجاح تام!';
			}else {
				$item = New Item();
				$item->user_id = Auth::user()->id;
				$item->name = $request->input('name');
				$item->price = $request->input('price');
				$item->barcode = $request->input('barcode');
				$item->save();

				$type = 'add';
				$message = 'تم إضافة السلعة بنجاح تام!';
			}

            $data = [
            	'type' => $type,
              	'status' => 'success',
              	'message' => $message
            ];
        }

        return response()->json($data);

	}
}
