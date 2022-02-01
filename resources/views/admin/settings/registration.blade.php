
<form class="user" method="POST" action="{{ route('settings.save') }}">
    @csrf
    <input type="hidden" name="name" value="{{$type}}">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Registration Settings</h6>
            <button type="submit" class="btn btn-primary btn-md px-5">
                {{ __('Save') }}
            </button>
        </div>
        <div class="card-body">

        <div class="row">
            <div class="col-md-6">                    
                <div class="form-group">

                    <div class="custom-control custom-checkbox small">
                        <input id="email_verification_on_reg" type="checkbox" class=" custom-control-input @error('value.email_verification_on_reg') is-invalid @enderror" name="value[email_verification_on_reg]" value="1" @if(old('value.email_verification_on_reg')) checked="checked"  @else {{ (isset($Settings['email_verification_on_reg'])) ? 'checked="checked"' : '' }}" @endif >
                        <label for="email_verification_on_reg" class="custom-control-label">{{ __('Allow Email Verification During Registration') }}</label>
                            @error("value.email_verification_on_reg")
                                {{$message}}
                            @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-6">                    
                <div class="form-group">

                    <div class="custom-control custom-checkbox small">
                        <input id="allow_forget_password" type="checkbox" class=" custom-control-input @error('value.allow_forget_password') is-invalid @enderror" name="value[allow_forget_password]" value="1" @if(old('value.allow_forget_password')) checked="checked"  @else {{ (isset($Settings['allow_forget_password'])) ? 'checked="checked"' : '' }}" @endif >
                        <label for="allow_forget_password" class="custom-control-label">{{ __('Allow Forget Password') }}</label>
                            @error("value.allow_forget_password")
                                {{$message}}
                            @enderror
                    </div>
                </div>
            </div>

        </div>

        </div>
    </div>
</form>