@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<div class="card">
				<div class="card-header bg-primary text-white">
					<h4 class="card-title">
						قائمة التذاكر
					</h4>
				</div>
				<div class="card-content">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-body">
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label>البحث</label>
												<div class="input-group">
													<input type="text" class="form-control search" id="focus_field" value="{{ $search }}" placeholder="أدخل كلمة البحث" autofocus="" autocomplete="off">
													<div class="input-group-append">
														<button class="btn btn-teal searchButton" id="urlSearch" data-url="{{ $route }}?orderKey={{ $orderKey }}&orderBy={{ $orderBy }}&search=" type="button">
															<i class="ft-search"></i>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>ترتيب حسب</label>
												<select class="form-control btn-teal" id="urlSelect">
													@foreach ($orderKeyList as $key => $value)
														<option data-url="{{ $route }}?orderKey={{ $key }}&orderBy={{ $orderBy }}&search={{ $search }}" {{ $orderKey == $key ? "selected" : "" }}>{{ $value }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label><p></p></label>
												<select class="form-control btn-teal" id="urlSelect">
													<option data-url="{{ $route }}?orderKey={{ $orderKey }}&orderBy=asc&search={{ $search }}" {{ $orderBy == "asc" ? "selected" : "" }}>تصاعدي</option>
													<option data-url="{{ $route }}?orderKey={{ $orderKey }}&orderBy=desc&search={{ $search }}" {{ $orderBy == "desc" ? "selected" : "" }}>تنازلي</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="table-responsive">
						    <table class="table table-bordered">
						        <thead class="bg-primary text-white">
						            <tr>
						                <th>رقم التذكرة</th>
						            </tr>
						        </thead>
						        <tbody class="bg-white">
						            @foreach ($array as $data)
						            <tr>
						                <td>
						                    <a href="#" id="urlChange" data-url="{{route('ticket', $data->id)}}">
						                    	التذكرة رقم {{ str_pad($data->id, 10, '0', STR_PAD_LEFT) }}
						                    </a>
						                </td>
						            </tr>
						            @endforeach
						        </tbody>
						    </table>
						</div>
						<div class="float-right">
						    {{ $array->links() }}
						</div>
	            	</div>
                </div>
			</div>
		</div>
	</div>
@endsection