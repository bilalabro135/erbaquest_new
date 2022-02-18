
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

            <div class="col-md-6">                    
                <div class="form-group">
                    <label for="page_title">{{ __('Registration Page Title*') }}</label>
                    <input id="page_title" type="text" class="form-control  @error('value.page_title') is-invalid @enderror" name="value[page_title]" 
                    @if(old('value.page_title')) value="{{old('value.page_title')}}"
                    @else value="{{ (isset($Settings['page_title'])) ? $Settings['page_title'] : '' }}" @endif required="" placeholder="{{ __('Registration Page Title') }}"  autocomplete="page_title" autofocus>
                    @error("value.page_title")
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="col-md-12">                    
                <div class="form-group">
                    <label for="signup_banner_preview">Registration Page Banner(<small ><a class="text-danger" href="javascript:void(0)" onclick="removeImage('#signup_banner', '#signup_banner_preview', 'Registration Page Banner');">Remove</a></small>)</label>
                    <div class="lfm file-upload" id="signup_banner_preview" data-input="signup_banner" data-preview="signup_banner_preview">
                    @if(isset($Settings['signup_banner']))
                    <img src="{{$Settings['signup_banner']}}" style="height: 5rem;">
                    @else
                    Registration Page Banner
                    @endif
                </div>
                    <input type="hidden" name="value[signup_banner]" value="{{(isset($Settings['signup_banner'])) ?$Settings['signup_banner'] : '' }}" id="signup_banner">
                    @error("value.signup_banner")
                        {{$message}}
                    @enderror
                </div>
            </div>

        </div>

        </div>
    </div>
</form>

@section('scripts')
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script type="text/javascript">
    var route_prefix = "{{route('unisharp.lfm.show')}}";
    $('.lfm').filemanager('image', {prefix: route_prefix});
    function removeImage(input, placeholder, text = 'Upload') {
        $(input).val('');
        $(placeholder).html(text)
    }
    </script>
@endsection