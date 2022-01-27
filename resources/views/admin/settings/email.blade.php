
<form class="user" method="POST" action="{{ route('settings.save') }}">
    @csrf
    <input type="hidden" name="name" value="{{$type}}">
    <input type="hidden" name="write_on_env" value="1">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Email Settings</h6>
            <button type="submit" class="btn btn-primary btn-md px-5">
                {{ __('Save') }}
            </button>
        </div>
        <div class="card-body">


        <div class="row">
            <div class="col-md-6">                    
                <div class="form-group">
                    <label for="MAIL_MAILER">{{ __('MAIL MAILER*') }}</label>
                    <input id="MAIL_MAILER" type="text" class="form-control  @error('value.MAIL_MAILER') is-invalid @enderror" name="value[MAIL_MAILER]" 
                    @if(old('value.MAIL_MAILER')) value="{{old('value.MAIL_MAILER')}}"
                    @else value="{{ (isset($Settings['MAIL_MAILER'])) ? $Settings['MAIL_MAILER'] : '' }}" @endif required="" placeholder="{{ __('MAIL MAILER') }}"  autocomplete="MAIL_MAILER" autofocus>
                    @error("value.MAIL_MAILER")
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="col-md-6">                    
                <div class="form-group">
                    <label for="MAIL_HOST">{{ __('MAIL HOST*') }}</label>
                    <input id="MAIL_HOST" type="text" class="form-control  @error('value.MAIL_HOST') is-invalid @enderror" name="value[MAIL_HOST]" 
                    @if(old('value.MAIL_HOST')) value="{{old('value.MAIL_HOST')}}"
                    @else value="{{ (isset($Settings['MAIL_HOST'])) ? $Settings['MAIL_HOST'] : '' }}" @endif required="" placeholder="{{ __('MAIL HOST') }}"  autocomplete="MAIL_HOST" autofocus>
                    @error("value.MAIL_HOST")
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="col-md-6">                    
                <div class="form-group">
                    <label for="MAIL_PORT">{{ __('MAIL PORT*') }}</label>
                    <input id="MAIL_PORT" type="text" class="form-control  @error('value.MAIL_PORT') is-invalid @enderror" name="value[MAIL_PORT]" 
                    @if(old('value.MAIL_PORT')) value="{{old('value.MAIL_PORT')}}"
                    @else value="{{ (isset($Settings['MAIL_PORT'])) ? $Settings['MAIL_PORT'] : '' }}" @endif required="" placeholder="{{ __('MAIL PORT') }}"  autocomplete="MAIL_PORT" autofocus>
                    @error("value.MAIL_PORT")
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="col-md-6">                    
                <div class="form-group">
                    <label for="MAIL_USERNAME">{{ __('MAIL USERNAME*') }}</label>
                    <input id="MAIL_USERNAME" type="text" class="form-control  @error('value.MAIL_USERNAME') is-invalid @enderror" name="value[MAIL_USERNAME]" 
                    @if(old('value.MAIL_USERNAME')) value="{{old('value.MAIL_USERNAME')}}"
                    @else value="{{ (isset($Settings['MAIL_USERNAME'])) ? $Settings['MAIL_USERNAME'] : '' }}" @endif required="" placeholder="{{ __('MAIL USERNAME') }}"  autocomplete="MAIL_USERNAME" autofocus>
                    @error("value.MAIL_USERNAME")
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="col-md-6">                    
                <div class="form-group">
                    <label for="MAIL_PASSWORD">{{ __('MAIL PASSWORD*') }}</label>
                    <input id="MAIL_PASSWORD" type="password" class="form-control  @error('value.MAIL_PASSWORD') is-invalid @enderror" name="value[MAIL_PASSWORD]" 
                    @if(old('value.MAIL_PASSWORD')) value="{{old('value.MAIL_PASSWORD')}}"
                    @else value="{{ (isset($Settings['MAIL_PASSWORD'])) ? $Settings['MAIL_PASSWORD'] : '' }}" @endif required="" placeholder="{{ __('MAIL PASSWORD') }}"  autocomplete="MAIL_PASSWORD" autofocus>
                    @error("value.MAIL_PASSWORD")
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="col-md-6">                    
                <div class="form-group">
                    <label for="MAIL_ENCRYPTION">{{ __('MAIL ENCRYPTION*') }}</label>
                    <input id="MAIL_ENCRYPTION" type="text" class="form-control  @error('value.MAIL_ENCRYPTION') is-invalid @enderror" name="value[MAIL_ENCRYPTION]" 
                    @if(old('value.MAIL_ENCRYPTION')) value="{{old('value.MAIL_ENCRYPTION')}}"
                    @else value="{{ (isset($Settings['MAIL_ENCRYPTION'])) ? $Settings['MAIL_ENCRYPTION'] : '' }}" @endif required="" placeholder="{{ __('MAIL ENCRYPTION') }}"  autocomplete="MAIL_ENCRYPTION" autofocus>
                    @error("value.MAIL_ENCRYPTION")
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="col-md-6">                    
                <div class="form-group">
                    <label for="MAIL_FROM_ADDRESS">{{ __('MAIL FROM ADDRESS') }}</label>
                    <input id="MAIL_FROM_ADDRESS" type="email" class="form-control  @error('value.MAIL_FROM_ADDRESS') is-invalid @enderror" name="value[MAIL_FROM_ADDRESS]" 
                    @if(old('value.MAIL_FROM_ADDRESS')) value="{{old('value.MAIL_FROM_ADDRESS')}}"
                    @else value="{{ (isset($Settings['MAIL_FROM_ADDRESS'])) ? $Settings['MAIL_FROM_ADDRESS'] : '' }}" @endif required="" placeholder="{{ __('MAIL FROM ADDRESS') }}"  autocomplete="MAIL_FROM_ADDRESS" autofocus>
                    @error("value.MAIL_FROM_ADDRESS")
                        {{$message}}
                    @enderror
                </div>
            </div>


        </div>
    </div>
</form>

