@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<div class="card">
				<div class="card-header bg-primary text-white">
					<h4 class="card-title">
						إضافة سلعة
					</h4>
				</div>
				<div class="card-content">
					<div class="card-body">
						<form id="form" data-url="{{route('storeitem', $id)}}">
							<div class="row">
								<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
									<fieldset class="form-group" id="name">
										<label for="basicInput">إسم السلعة</label>
										<input type="text" class="form-control" id="focus_field" name="name" value="{{ $name }}" autofocus="" autocomplete="off">
										<div class="form-control-position"></div>
									</fieldset>
								</div>
								<div class="col-xl-3 col-lg-6 col-md-12 mb-1">
									<fieldset class="form-group" id="price">
										<label for="helpInputTop">سعر السلعة</label>
										<input type="text" class="form-control" name="price" value="{{ $price }}" autocomplete="off">
										<div class="form-control-position"></div>
									</fieldset>
								</div>
								<div class="col-xl-3 col-lg-6 col-md-12 mb-1">
									<fieldset class="form-group" id="barcode">
										<label for="disabledInput">باركود السلعة</label>
										<input type="text" class="form-control" name="barcode" value="{{ $barcode }}" autocomplete="off">
										<div class="form-control-position"></div>
									</fieldset>
								</div>
								<div class="col-xl-12 col-lg-12">
									<button type="button" class="btn btn-primary btn-block" id="submit">
										<i class="ft-check-square"></i> إدخال
									</button>
								</div>
							</div>
						</form>
	            	</div>
                </div>
			</div>
		</div>
	</div>
@endsection