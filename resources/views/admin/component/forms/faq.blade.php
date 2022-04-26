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
            <div class="ContactInfoMain">
                @empty($fields)
                    <div class="row contactInfoRow">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="heading">{{ __('Faq Heading') }}</label>
                                <input id="heading" type="text" class="form-control  " name="fields[0][heading]" 
                                 required="" placeholder="{{ __('Faq Heading') }}"  value="{{old('fields.heading')}}"
                                 value=""   autocomplete="heading" autofocus>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">{{ __('Faq Description') }}</label>
                                <textarea style="height: 100px;" id="description" type="text" class="form-control " name="fields[0][description]" 
                                 required="" placeholder="{{ __('Faq description') }}"  autocomplete="description" autofocus>{{old('fields.description')}}</textarea>
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
                    <div class="row contactInfoRow">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="heading">{{ __('Faq Heading') }}</label>
                                <input id="heading" type="text" class="form-control  @error('fields.heading') is-invalid @enderror" name="fields[{{$i}}][heading]" 
                                 required="" placeholder="{{ __('Faq Heading') }}" @if(old('fields.heading')) value="{{old('fields.heading')}}"
                                @else value="{{ (isset($field['heading'])) ? $field['heading'] : '' }}"  @endif autocomplete="heading" autofocus>
                                @error("fields.heading")
                                    {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">{{ __('Faq Description') }}</label>
                                <textarea style="height: 100px;" id="description" type="text" class="form-control  @error('fields.description') is-invalid @enderror" name="fields[{{$i}}][description]" 
                                 required="" placeholder="{{ __('Faq description') }}"  autocomplete="description" autofocus>@if(old('fields.description')){{old('fields.description')}}@else{{ (isset($field['description'])) ? $field['description'] : '' }}@endif</textarea>
                                @error("fields.description")
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
    </div>
</form>      

<!--  -->

@section('scripts')

    <script>
        var count = {{ (isset($i)) ? ($i + 1 ) : 1  }} ;
            $('.add').click(function() {

                var tableString = `<div class="row contactInfoRow"><div class="col-md-12"><div class="form-group"><label for="heading">{{ __("Faq Heading") }}</label><input id="heading" type="text" class="form-control" name="fields[` + count + `][heading]" required="" placeholder="{{ __("Faq Heading") }}" autocomplete="heading" autofocus> </div></div><div class="col-md-12"><div class="form-group"><label for="description">{{ __("Faq Description") }}</label><textarea style="height: 100px;" id="description" type="text" class="form-control  " name="fields[` + count + `][description]" required="" placeholder="{{ __("Faq description") }}"  autocomplete="description" autofocus></textarea></div></div> <div class="col-md-6 locationAddRemove"><input  class="remove" onclick="removeRow(this)" type="button" value="remove" /></div></div>`;


                // $('.add').unbind();
                $(".contactInfoRow").last().after(tableString);
              
                count = count + 1;
                // setupHandlers();
            });

            function removeRow(elem){
                $(elem).parents('.contactInfoRow').remove();
            }
    </script>

@endsection

