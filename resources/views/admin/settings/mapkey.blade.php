
<form class="user" method="POST" action="{{ route('settings.save') }}">
    @csrf
    <input type="hidden" name="name" value="{{$type}}">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Map Keys</h6>
            <button type="submit" class="btn btn-primary btn-md px-5">
                {{ __('Save') }}
            </button>
        </div>
        <div class="card-body">

            <div class="row social-media">
                <div class="col-md-12 d-flex">
                    <h5>Map Key:</h5>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="value[map_key]" id="sm-link" placeholder="Map Key" class="form-control" @if(old('value.map_key')) value="{{old('value.map_key')}}"
                    @else value="{{ (isset($Settings['map_key'])) ? $Settings['map_key'] : '' }}" @endif >
                        @error("value.map_key")
                            {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
