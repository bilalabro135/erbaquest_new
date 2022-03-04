<form class="user" method="POST" action="{{ route('components.save') }}">
    @csrf
    <input type="hidden" name="name" value="{{$type}}">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary text-capitalize">{{$type}}</h6>
            <button type="submit" class="btn btn-primary btn-md px-5">
                {{ __('Save') }}
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label for="heading">{{ __('Heading') }}</label>
                        
                        <input id="heading" type="text" class="form-control  @error('fields.heading') is-invalid @enderror" name="fields[heading]" 
                         required="" placeholder="{{ __('Banner Heading') }}" @if(old('fields.heading')) value="{{old('fields.heading')}}"
                        @else value="{{ (isset($fields['heading'])) ? $fields['heading'] : '' }}"  @endif autocomplete="heading" autofocus>
                        @error("fields.heading")
                            {{$message}}
                        @enderror
                    </div>
                </div>
            <div class="col-md-6">                    
                <div class="form-group">
                    <label for="background_preview">Background Image (<small ><a class="text-danger" href="javascript:void(0)" onclick="removeImage('#background', '#background_preview', 'Background');">Remove</a></small>)</label>
                    <div class="lfm file-upload" id="background_preview" data-input="background" data-preview="background_preview">
                    @if(isset($fields['background']))
                    <img src="{{asset($fields['background'])}}" style="height: 5rem;">
                    @else
                    Background
                    @endif
                </div>
                    <input type="hidden" name="fields[background]" value="{{(isset($fields['background'])) ?$fields['background'] : '' }}" id="background">
                    @error("fields.background")
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
    function removeImage(input, placeholder, text = 'Background') {
        $(input).val('');
        $(placeholder).html(text)
    }
    </script>
@endsection