{!! \Assets::css() !!}

{{--Перевод средств--}}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">@lang('mpouspehm::profile.score.transfer')</h4>
</div>
<div class="modal-body">

    <form method="post" action="{{ route(config('mpouspehm.panel_url') . '.payments.profileTransferPayment') }}"
    enctype="multipart/form-data" id="transferPaymentId" data-validation="MPOproperty/Mpouspehm/Requests/ProfileTransferRequest">

        <input type="hidden" name="_token" id="_token" value="{{csrf_token() }}" />

        <div class="form-group">
            <label class="control-label">@lang('mpouspehm::payment.paymentForm.price')</label>
            <input type="text" name="price_transfer" id="price_transfer"
                   class="form-control" value="{{ Input::old('price_transfer') }}">
        </div>

        <div class="form-group">
            <label class="control-label">@lang('mpouspehm::payment.paymentForm.user_to')</label>
            <select id="user_transfer_to" class="form-control" name="user_transfer_to" id="user_transfer_to" data-placeholder="@lang('mpouspehm::payment.selectUser')" >
                 @foreach ($users as $key => $user)
                    <option @if(Input::old('user_transfer_to') == $key) selected="selected" @endif value="{{ $key }}">{{ $user }}</option>
                @endforeach
            </select>
        </div>


         <div class="form-group">
            <label class="control-label">@lang('mpouspehm::payment.paymentForm.description')</label>
            <input type="text" name="description" id="description"
                   class="form-control" value="{{ $descriptionTransfer or Input::old('description') }}">
        </div>

        <div class="form-group">
            <button class="btn blue" data-dismiss="modal">
                @lang('mpouspehm::payment.back')
            </button>
            <button type="submit" class="btn green-haze">
                @lang('mpouspehm::payment.transferButton')
            </button>
        </div>
    </form>
</div>

@include('vendor.lrgt.ajax_script', [
    'form' => 'transferPaymentId',
    'on_start'=>false
])

{!! \Assets::js() !!}