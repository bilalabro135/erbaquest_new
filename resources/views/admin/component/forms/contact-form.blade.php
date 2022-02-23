
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
                         required="" placeholder="{{ __('Heading') }}" @if(old('fields.heading')) value="{{old('fields.heading')}}"
                        @else value="{{ (isset($fields['heading'])) ? $fields['heading'] : '' }}"  @endif autocomplete="heading" autofocus>
                        @error("fields.heading")
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">                    
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        
                        <textarea style="height: 100px;" id="description" type="text" class="form-control  @error('fields.description') is-invalid @enderror" name="fields[description]" 
                         required="" placeholder="{{ __('description') }}"  autocomplete="description" autofocus>@if(old('fields.description')){{old('fields.description')}}@else{{ (isset($fields['description'])) ? $fields['description'] : '' }}@endif</textarea>
                        @error("fields.description")
                            {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

