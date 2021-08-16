@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-xl-8 col-lg-12">
			<div class="card">
				<div class="card-header bg-primary text-white">
					<h4 class="card-title">إحصائيات عامة</h4>
				</div>
				<div class="card-content">
					<div class="card-body">
						<div class="row">
							<div class="col-xl-4 col-lg-6 col-12">
								<div class="card ">
									<div class="card-content">
										<div class="media align-items-stretch">
											<div class="p-2 text-center bg-primary bg-darken-2">
												<i class="fa fa-cart-arrow-down font-large-2 white"></i>
											</div>
											<div class="p-2 bg-gradient-x-primary white media-body">
												<h5>تذاكر اليوم</h5>
												<h5 class="text-bold-400 mb-0">{{ $salesToday }}</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-6 col-12">
								<div class="card">
									<div class="card-content">
										<div class="media align-items-stretch">
											<div class="p-2 text-center bg-danger bg-darken-2">
												<i class="fa fa-shopping-cart font-large-2 white"></i>
											</div>
											<div class="p-2 bg-gradient-x-danger white media-body">
												<h5>جميع التذاكر</h5>
												<h5 class="text-bold-400 mb-0">{{ $sales }}</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-6 col-12">
								<div class="card">
									<div class="card-content">
										<div class="media align-items-stretch">
											<div class="p-2 text-center bg-purple bg-darken-2">
												<i class="fa fa-tags font-large-2 white"></i>
											</div>
											<div class="p-2 bg-gradient-x-purple white media-body">
												<h5>السلع</h5>
												<h5 class="text-bold-400 mb-0">{{ $items }}</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-6 col-12">
								<div class="card">
									<div class="card-content">
										<div class="media align-items-stretch">
											<div class="p-2 text-center bg-warning bg-darken-2">
												<i class="fa fa-tag font-large-2 white"></i>
											</div>
											<div class="p-2 bg-gradient-x-warning white media-body">
												<h5>السلع المباعة</h5>
												<h5 class="text-bold-400 mb-0">{{ $buys }}</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
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
				<div class="card-content">
					<div id="tickets" class="height-300 position-relative">
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
											{{ str_pad($sales->id, 8, '0', STR_PAD_LEFT) }}
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