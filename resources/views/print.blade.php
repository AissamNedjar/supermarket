<!DOCTYPE html>
<html dir="rtl">
<head>
	<style type="text/css">
		@media print {
		    body {
		    	padding: 0;
		    	margin: 0;
		    }
		    h3, h4, h5, strong {
		    	text-align: center;
		    }
		    table {
		    	font-size: 11px;
		    }
		}
	</style>
</head>
<body>
	<h3>
		{{ config('app.name') }}
		<br>
		القرارم قوقة
	</h3>
	<h4>
		<strong>({{ str_pad($sale->id, 10, '0', STR_PAD_LEFT) }})</strong> / {{ $sale->created_at }}
	</h4>
	<hr>
	<table width="100%">
		@php
            $total = 0;
		@endphp
		@foreach ($sale->items()->get() as $buy)
			@php
                $price = ($buy->price * $buy->quantity);
                $total = $total + $price;
			@endphp
			<tr>
				<td>
					{{ $buy->item->name }}
				</td>
				<td>
					{{ number_format($buy->price) }} دج
				</td>
				<td>
					({{ $buy->quantity }})
				</td>
				<td>
                    {{ number_format($buy->price*$buy->quantity) }} دج
				</td>
			</tr>
		@endforeach
		<tr>
			<td colspan="4" align="left">
                {{ number_format($total) }} دج
			</td>
		</tr>
	</table>
	<hr>
	<h4>
		شكرا على الزيارة
	</h4>
</body>
</html>