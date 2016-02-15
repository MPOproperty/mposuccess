<div class="flash-message">
	@foreach (['danger', 'warning', 'success', 'info'] as $msg)
	  @if(Session::has('alert-' . $msg))
	  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	  @endif
	@endforeach
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-shopping-cart"></i>@lang('mpouspehm::payment.createPayment')
				</div>
				<div class="actions btn-set">
					<a href="/panel/admin/payments" class="btn default">
						<i class="fa fa-angle-left"></i> @lang('mpouspehm::panel.back')
					</a>
				</div>
			</div>

			<div class="portlet-body">
				<div class="tabbable">
					{{--Tabs--}}
					<ul class="nav nav-tabs">
						<li @if (!in_array(Input::old('_tab'), [2,3])) class="active" @endif>
							<a href="#tab_balanse" data-toggle="tab">
							@lang('mpouspehm::payment.intakeExternalPayment') </a>
						</li>
						<li @if (Input::old('_tab') == 3) class="active" @endif>
							<a href="#tab_balanse3" data-toggle="tab">
							@lang('mpouspehm::payment.accountTransferPayment') </a>
						</li>
					</ul>
					<div class="tab-content no-space">
						{{--Tab 1--}}
						<div class="tab-pane @if (!in_array(Input::old('_tab'), [2,3])) active @endif>" id="tab_balanse">
							<form method="post" action="{{ route(config('mpouspehm.admin_prefix') . '.payments.intakeExternalPayment') }}" enctype="multipart/form-data">

							<input type="hidden" name="_token" id="_token" value="{{csrf_token() }}" />
							<input type="hidden" name="_tab" value="1" />

							<div class="form-body">
								<div class="form-group @if($errors->has('price_intake')) has-error @endif">
									<label class="control-label">@lang('mpouspehm::payment.paymentForm.price')</label>
									<input type="text" name="price_intake"
										   class="form-control" value="{{ Input::old('price_intake') }}">
									@if($errors->has('price_intake'))
										<span id="name-error" class="help-block">{{ $errors->first('price_intake') }}</span>
									@endif
								</div>

								<div class="form-group @if($errors->has('user_to')) has-error @endif">
									<label class="control-label">@lang('mpouspehm::payment.paymentForm.user')</label>
									<select id="select2_program" class="form-control" name="user_to" data-placeholder="@lang('mpouspehm::payment.selectUser')" >
										 @foreach ($users as $key => $user)
											<option @if(Input::old('user_to') == $key) selected="selected" @endif value="{{ $key }}">{{ $user }}</option>
										@endforeach
									</select>
									@if($errors->has('user_to'))
										<span id="name-error" class="help-block">{{ $errors->first('user_to') }}</span>
									@endif
								</div>

								<div class="form-group">
									<button type="submit" class="btn green-haze">
										@lang('mpouspehm::payment.saveChanges')
									</button>
								</div>
							</div>
							</form>
						</div>

						{{--Tab 3--}}
						<div class="tab-pane @if (Input::old('_tab') == 3) active @endif>" id="tab_balanse3">
							<form method="post" action="{{ route(config('mpouspehm.admin_prefix') . '.payments.accountTransferPayment') }}" enctype="multipart/form-data">

							<input type="hidden" name="_token" id="_token" value="{{csrf_token() }}" />
							<input type="hidden" name="_tab" value="3" />

							<div class="form-body">
								<div class="form-group @if($errors->has('price_transfer')) has-error @endif">
									<label class="control-label">@lang('mpouspehm::payment.paymentForm.price')</label>
									<input type="text" name="price_transfer"
										   class="form-control" value="{{ Input::old('price_transfer') }}">
									@if($errors->has('price_transfer'))
										<span id="name-error" class="help-block">{{ $errors->first('price_transfer') }}</span>
									@endif
								</div>

								<div class="form-group @if($errors->has('user_transfer_from')) has-error @endif">
									<label class="control-label">@lang('mpouspehm::payment.paymentForm.user_from')</label>
									<select id="select2_program" class="form-control" name="user_transfer_from" data-placeholder="@lang('mpouspehm::payment.selectUser')" >
										 @foreach ($users as $key => $user)
											<option @if(Input::old('user_transfer_from') == $key) selected="selected" @endif value="{{ $key }}">{{ $user }}</option>
										@endforeach
									</select>
									@if($errors->has('user_transfer_from'))
										<span id="name-error" class="help-block">{{ $errors->first('user_transfer_from') }}</span>
									@endif
								</div>

								<div class="form-group @if($errors->has('user_transfer_to')) has-error @endif">
									<label class="control-label">@lang('mpouspehm::payment.paymentForm.user_to')</label>
									<select id="select2_program" class="form-control" name="user_transfer_to" data-placeholder="@lang('mpouspehm::payment.selectUser')" >
										 @foreach ($users as $key => $user)
											<option @if(Input::old('user_transfer_to') == $key) selected="selected" @endif value="{{ $key }}">{{ $user }}</option>
										@endforeach
									</select>
									@if($errors->has('user_transfer_to'))
										<span id="name-error" class="help-block">{{ $errors->first('user_transfer_to') }}</span>
									@endif
								</div>

								<div class="form-group">
									<button type="submit" class="btn green-haze">
										@lang('mpouspehm::payment.saveChanges')
									</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>