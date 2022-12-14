
<form class="user" method="POST" action="{{ route('settings.save') }}">
    @csrf
    <input type="hidden" name="name" value="{{$type}}">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">General Settings</h6>
            <button type="submit" class="btn btn-primary btn-md px-5">
                {{ __('Save') }}
            </button>
        </div>
        <div class="card-body">


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="site_name">{{ __('Site Name*') }}</label>
                    <input id="site_name" type="text" class="form-control  @error('value.site_name') is-invalid @enderror" name="value[site_name]"
                    @if(old('value.site_name')) value="{{old('value.site_name')}}"
                    @else value="{{ (isset($Settings['site_name'])) ? $Settings['site_name'] : '' }}" @endif required="" placeholder="{{ __('Site Name') }}"  autocomplete="site_name" autofocus>
                    @error("value.site_name")
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="site_title">{{ __('Site Title*') }}</label>
                    <input id="site_title" type="text" class="form-control  @error('value.site_title') is-invalid @enderror" name="value[site_title]" @if(old('value.site_title')) value="{{old('value.site_title')}}"
                    @else value="{{ (isset($Settings['site_title'])) ? $Settings['site_title'] : '' }}"  @endif placeholder="{{ __('Site Title') }}"  autocomplete="site_title"  autofocus>
                    @error("value.site_title")
                        {{$message}}
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="home_page">{{ __('Home Page*') }}</label>

                    <select class="form-control" id="home_page" name="value[home_page]">
                        <option value="default"  {{ (isset($Settings['home_page']) && $Settings['home_page'] == 'default') ? 'selected="selected"' : '' }}>Default</option>
                        @foreach($pages as $page)
                            <option value="{{$page->slug}}" {{ (isset($Settings['home_page']) && $Settings['home_page'] == $page->slug) ? 'selected="selected"' : '' }}>{{$page->name}}</option>
                        @endforeach
                    </select>
                    @error("value.home_page")
                        {{$message}}
                    @enderror

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="blog_page">{{ __('Blog Page*') }}</label>

                    <select class="form-control" id="blog_page" name="value[blog_page]"><option value="" >Default</option>
                        @foreach($pages as $page)
                            <option value="{{$page->slug}}" {{ (isset($Settings['blog_page']) && $Settings['blog_page'] == $page->slug) ? 'selected="selected"' : '' }}>{{$page->name}}</option>
                        @endforeach
                    </select>
                    @error("value.blog_page")
                        {{$message}}
                    @enderror

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="site_logo_preview">Site Logo (<small ><a class="text-danger" href="javascript:void(0)" onclick="removeImage('#site_logo', '#site_logo_preview', 'Logo');">Remove</a></small>)</label>
                    <div class="lfm file-upload" id="site_logo_preview" data-input="site_logo" data-preview="site_logo_preview">
                    @if(isset($Settings['site_logo']))
                    <img src="{{$Settings['site_logo']}}" style="height: 5rem;">
                    @else
                    Logo
                    @endif
                </div>
                    <input type="hidden" name="value[site_logo]" value="{{(isset($Settings['site_logo'])) ?$Settings['site_logo'] : '' }}" id="site_logo">
                    @error("value.site_logo")
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="site_fav_preview">Site Fav Icon(<small ><a class="text-danger" href="javascript:void(0)" onclick="removeImage('#site_fav', '#site_fav_preview', 'Fav Icon');">Remove</a></small>)</label>
                    <div class="site_fav lfm file-upload" id="site_fav_preview" data-input="site_fav" data-preview="site_fav_preview"> @if(isset($Settings['site_fav']))
                    <img src="{{$Settings['site_fav']}}" style="height: 5rem;">
                    @else
                    Fav Icon
                    @endif</div>
                    <input type="hidden" name="value[site_fav]" id="site_fav" value="{{(isset($Settings['site_fav'])) ?$Settings['site_fav'] : '' }}">
                    @error("value.site_fav")
                        {{$message}}
                    @enderror

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">{{ __('Address') }}</label>
                    <textarea style="height: 150px" name="value[address]" id="address" class="form-control  @error('value.address') is-invalid @enderror" >@if(old('value.address')){{old('value.address')}}@else{{ (isset($Settings['address'])) ? $Settings['address'] : '' }}@endif</textarea>
                    @error("value.address")
                        {{$message}}
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="site_name">{{ __('Site Name*') }}</label>
                    <input id="site_name" type="text" class="form-control  @error('value.site_name') is-invalid @enderror" name="value[site_name]"
                    @if(old('value.site_name')) value="{{old('value.site_name')}}"
                    @else value="{{ (isset($Settings['site_name'])) ? $Settings['site_name'] : '' }}" @endif required="" placeholder="{{ __('Site Name') }}"  autocomplete="site_name" autofocus>
                    @error("value.site_name")
                        {{$message}}
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="telephone">{{ __('Telephone') }}</label>
                    <input id="telephone" type="text" class="form-control  @error('value.telephone') is-invalid @enderror" name="value[telephone]" @if(old('value.telephone')) value="{{old('value.telephone')}}"
                    @else value="{{ (isset($Settings['telephone'])) ? $Settings['telephone'] : '' }}"  @endif placeholder="{{ __('Telephone') }}"  autocomplete="telephone"  autofocus>
                    @error("value.telephone")
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Email">{{ __('Email') }}</label>
                    <input id="Email" type="email" class="form-control  @error('value.email') is-invalid @enderror" name="value[email]" @if(old('value.email')) value="{{old('value.email')}}"
                    @else value="{{ (isset($Settings['email'])) ? $Settings['email'] : '' }}"  @endif placeholder="{{ __('email') }}"  autocomplete="email"  autofocus>
                    @error("value.email")
                        {{$message}}
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="remindb">{{ __('Reminder Before') }}</label>
                    <input id="remindb" type="number" class="form-control  @error('value.remindb') is-invalid @enderror" name="value[remindb]" @if(old('value.remindb')) value="{{old('value.remindb')}}"
                           @else value="{{ (isset($Settings['remindb'])) ? $Settings['remindb'] : '' }}"  @endif placeholder="{{ __('Reminder Before') }}"  autofocus>
                    @error("value.remindb")
                    {{$message}}
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="Email">{{ __('Footer Text') }}</label>
                    <textarea style="height: 150px" name="value[footer_text]" id="footer_text" class="form-control  @error('value.footer_text') is-invalid @enderror" >@if(old('value.footer_text')){{old('value.footer_text')}}@else{{ (isset($Settings['footer_text'])) ? $Settings['footer_text'] : '' }}@endif</textarea>
                    @error("value.footer_text")
                        {{$message}}
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="header_scripts">{{ __('Header Scripts*') }}</label>
                    <textarea style="height: 150px" name="value[header_scripts]" id="header_scripts" class="form-control  @error('value.header_scripts') is-invalid @enderror" >@if(old('value.header_scripts')){{old('value.header_scripts')}}@else{{ (isset($Settings['header_scripts'])) ? $Settings['header_scripts'] : '' }}@endif</textarea>
                    @error("value.header_scripts")
                        {{$message}}
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="footer_scripts">{{ __('Footer Scripts*') }}</label>
                    <textarea style="height: 150px" name="value[footer_scripts]" id="footer_scripts" class="form-control  @error('value.footer_scripts') is-invalid @enderror" >@if(old('value.footer_scripts')){{old('value.footer_scripts')}}@else{{ (isset($Settings['footer_scripts'])) ? $Settings['footer_scripts'] : '' }}@endif</textarea>
                    @error("value.footer_scripts")
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
