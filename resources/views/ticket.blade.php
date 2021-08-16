@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-xl-5 col-lg-12">
			<div class="card">
				<div class="card-header bg-primary text-white">
					<h4 class="card-title">
						التذكرة رقم {{ str_pad($sale->id, 10, '0', STR_PAD_LEFT) }}
					</h4>
				</div>
				<div class="card-header bg-black text-success">
					<h1 class="font-large-2">
						<strong>
							@php
								$total = 0;
							@endphp
							@foreach ($sale->items as $item)
							@php
								$total = $total+($item->price*$item->quantity);
							@endphp
							@endforeach
							{{ number_format($total) }} دج
						</strong>
					</h1>
				</div>
				<div class="card-content pb-1">
					<div id="items" class="table-responsive height-400 position-relative">
						<table class="table table-hover mb-0">
							<thead>
								<tr>
									<th></th>
									<th>السلعة</th>
									<th>السعر</th>
									<th>الكمية</th>
									<th>المجموع</th>
									<th>خيارات</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($sale->items as $item)
								<tr>
									<td width="5%">
										<i class="fa fa-shopping-cart"></i>
									</td>
									<td width="45%">
										{{ $item->item->name }}
									</td>
									<td width="10%">
										<span class="badge badge-dark">
											{{ number_format($item->price) }} دج
										</span>
									</td>
									<td width="5%">
										<span class="badge badge-danger">
											{{ $item->quantity }}
										</span>
									</td>
									<td width="10%">
										<span class="badge badge-dark">
											{{ number_format($item->price*$item->quantity) }} دج
										</span>
									</td>
									<td width="25%" style="cursor: pointer;">
										<span class="badge badge-danger" data-url="{{route('icondelete', $item->id)}}" id="iconClick">
											<i class="fa fa-close"></i>
										</span>
										<span class="badge badge-success" data-url="{{route('iconplus', $item->id)}}" id="iconClick">
											<i class="fa fa-plus"></i>
										</span>
										<span class="badge badge-warning" data-url="{{route('iconminus', $item->id)}}" id="iconClick">
											<i class="fa fa-minus"></i>
										</span>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-12">
			<div class="card">
				<div class="input-group input-group-lg">
					<input type="text" class="form-control input-lg" name="product" autofocus="" id="focus_field" autocomplete="off">
					<div class="input-group-append" id="button-addon2">
						<button class="btn btn-primary" type="button" id="buttonAdd" data-url="{{route('addbuy', $sale->id)}}" data-url2="{{route('ticket', $sale->id)}}"><i class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="card-content">
					<div class="row">
						<div class="col-xl-12 col-lg-12 text-center">
							<div class="btn-group pt-1">
			                    <button type="button" class="btn btn-blue" id="buttonText" data-number="0">
			                    	<span class="font-large-1">0</span>
			                    </button>
			                    <button type="button" class="btn btn-secondary" id="buttonText" data-number="1">
			                        <span class="font-large-1">1</span>
			                    </button>
			                    <button type="button" class="btn btn-primary" id="buttonText" data-number="2">
			                        <span class="font-large-1">2</span>
			                    </button>
			                    <button type="button" class="btn btn-success" id="buttonText" data-number="3">
			                        <span class="font-large-1">3</span>
			                    </button>
			                    <button type="button" class="btn btn-info" id="buttonText" data-number="4">
			                        <span class="font-large-1">4</span>
			                    </button>
			                </div>
							<div class="btn-group pt-1 pb-1">
			                    <button type="button" class="btn btn-warning" id="buttonText" data-number="5">
			                        <span class="font-large-1">5</span>
			                    </button>
			                    <button type="button" class="btn btn-danger" id="buttonText" data-number="6">
			                    	<span class="font-large-1">6</span>
			                    </button>
			                    <button type="button" class="btn btn-red" id="buttonText" data-number="7">
			                        <span class="font-large-1">7</span>
			                    </button>
			                    <button type="button" class="btn btn-light" id="buttonText" data-number="8">
			                        <span class="font-large-1">8</span>
			                    </button>
			                    <button type="button" class="btn btn-dark" id="buttonText" data-number="9">
			                        <span class="font-large-1">9</span>
			                    </button>
			                </div>
						</div>
						<div class="col-xl-12 col-lg-12 text-center">
		                    <button type="button" class="btn btn-info btn-block" id="print" data-url="{{route('print', $sale->id)}}">
		                        <span class="font-large-1">طباعة (Del)</span>
		                    </button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-12">
			<div class="card">
				<div class="card-header bg-danger text-white">
					<h4 class="card-title">آخر التذاكر</h4>
				</div>
				<div class="card-content pb-1">
					<div id="tickets" class="height-500 position-relative">
						<table class="table table-hover mb-0" style="cursor: pointer;">
							<thead>
								@foreach ($salesLast as $sales)
								<tr id="urlChange" data-url="{{route('ticket', $sales->id)}}">
									<th width="5%">
										<i class="fa fa-shopping-cart"></i>
									</th>
									<th width="70%">
										التذكرة رقم 
										<span class="badge badge-dark">
											{{ str_pad($sales->id, 10, '0', STR_PAD_LEFT) }}
										</span>
									</th>
									<th width="25%">
										<span class="badge badge-danger">
											{{ $sales->created_at }}
										</span>
									</th>
								</tr>
								@endforeach
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection