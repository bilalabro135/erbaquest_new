
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


            @empty($fields)
          <div class="row locationRow">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="heading">{{ __('Location Heading') }}</label>
                        <input id="heading" type="text" class="form-control  " name="fields[0][heading]" 
                         required="" placeholder="{{ __('Location Heading') }}"  value="{{old('fields.heading')}}"
                         value=""   autocomplete="heading" autofocus>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">{{ __('Location Description') }}</label>
                        <textarea style="height: 100px;" id="description" type="text" class="form-control " name="fields[0][description]" 
                         required="" placeholder="{{ __('Location description') }}"  autocomplete="description" autofocus>{{old('fields.description')}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="background_preview">Background Image (<small ><a class="text-danger" href="javascript:void(0)" onclick="removeImage('#background', '#background_preview', 'Background');">Remove</a></small>)</label>
                        <div class="lfm file-upload" id="background_preview" data-input="background" data-preview="background_preview">
                    </div>
                        <input type="hidden" name="fields[0][background]" value="" id="background">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="locationAddRemove">
                        <input class="add" type="button" value="Add" />
                    </div>
                </div>
              </div>
            @else

            @foreach($fields as $i =>  $field)

            <div class="row locationRow">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="heading">{{ __('Location Heading') }}</label>
                        <input id="heading" type="text" class="form-control  @error('fields.heading') is-invalid @enderror" name="fields[{{$i}}][heading]" 
                         required="" placeholder="{{ __('Location Heading') }}" @if(old('fields.heading')) value="{{old('fields.heading')}}"
                        @else value="{{ (isset($field['heading'])) ? $field['heading'] : '' }}"  @endif autocomplete="heading" autofocus>
                        @error("fields.heading")
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">{{ __('Location Description') }}</label>
                        <textarea style="height: 100px;" id="description" type="text" class="form-control  @error('fields.description') is-invalid @enderror" name="fields[{{$i}}][description]" 
                         required="" placeholder="{{ __('Location description') }}"  autocomplete="description" autofocus>@if(old('fields.description')){{old('fields.description')}}@else{{ (isset($field['description'])) ? $field['description'] : '' }}@endif</textarea>
                        @error("fields.description")
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="background_preview">Background Image (<small ><a class="text-danger" href="javascript:void(0)" onclick="removeImage('#background', '#background_preview', 'Background');">Remove</a></small>)</label>
                        <div class="lfm file-upload" id="background_preview" data-input="background" data-preview="background_preview">
                        @if(isset($field['background']))
                        <img src="{{asset($field['background'])}}" style="height: 5rem;">
                        @else
                        Background
                        @endif
                    </div>
                        <input type="hidden" name="fields[{{$i}}][background]" value="{{(isset($field['background'])) ?$field['background'] : '' }}" id="background">
                        @error("fields.background")
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 locationAddRemove">
                    <input  class="remove" onclick="removeRow(this)" type="button" value="remove" />
                </div>
            </div>

            @endforeach
            @endif

            <div class="locationAddRemove">
                <input class="add" type="button" value="Add" />
            </div>
        </div>
    </div>
</form>      

<!--  -->

@section('scripts')

    <script>

        var count = {{ (isset($i)) ? ($i + 1 ) : 1  }} ;
        // function setupHandlers() {
            // $('.add').unbind();
            // $('.remove').unbind();
            $('.add').click(function() {

                 var tableString = `<div class="row locationRow"><div class="col-md-12"><div class="form-group"><label for="heading">{{ __("Location Heading") }}</label><input id="heading" type="text" class="form-control" name="fields[` + count + `][heading]" required="" placeholder="{{ __("Location Heading") }}" autocomplete="heading" autofocus> </div></div><div class="col-md-12"><div class="form-group"><label for="description">{{ __("Location Description") }}</label><textarea style="height: 100px;" id="description" type="text" class="form-control  " name="fields[` + count + `][description]" required="" placeholder="{{ __("Location description") }}"  autocomplete="description" autofocus></textarea></div></div> <div class="col-md-6"><div class="form-group"><label for="background_preview">Background Image (<small ><a class="text-danger" href="javascript:void(0)" onclick="removeImage("#background", "#background_preview", "Background");">Remove</a></small>)</label><div class="lfm file-upload" id="background_preview" data-input="background" data-preview="background_preview">Background </div><input type="hidden" name="fields[` + count + `][background]" value="" id="background"> </div> </div><div class="col-md-6 locationAddRemove"><input  class="remove" onclick="removeRow(this)" type="button" value="remove" /></div></div>`;

                // $('.add').unbind();
                $(".locationRow").last().after(tableString);
              
                count = count + 1;
                console.log(count);
                  // setupHandlers();
            });

            function removeRow(elem){
                $(elem).parents('.locationRow').remove();
            }
            // $('.remove').click(function() {
            //     // $('.remove').unbind();
            //     if($(".locationRow").length > 1) {
            //         $(this).closest('.locationRow').remove();
            //     }
            //     else {
            //         alert("You cannot delete first row");
            //     }
            //      count = count - 1;
            // });
        // }
        // $(document).ready(function(){
        //     setupHandlers();
        // });
    </script>


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

