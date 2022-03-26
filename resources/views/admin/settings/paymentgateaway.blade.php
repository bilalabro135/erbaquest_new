
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
                    <h5>LOGIN ID:</h5>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="value[login_key]" id="sm-link" placeholder="LOGIN ID" class="form-control" @if(old('value.login_key')) value="{{old('value.login_key')}}"
                    @else value="{{ (isset($Settings['login_key'])) ? $Settings['login_key'] : '' }}" @endif >
                        @error("value.login_key")
                            {{$message}}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row social-media">
                <div class="col-md-12 d-flex">
                    <h5>CLIENT KEY:</h5>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" name="value[client_key]" id="sm-link" placeholder="CLIENT KEY" class="form-control" @if(old('value.client_key')) value="{{old('value.client_key')}}"
                    @else value="{{ (isset($Settings['client_key'])) ? $Settings['client_key'] : '' }}" @endif >
                        @error("value.client_key")
                            {{$message}}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row social-media">
                <div class="col-md-12 d-flex">
                    <h5>TRANSACTION KEY:</h5>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="value[transaction_key]" id="sm-link" placeholder="TRANSACTION KEY" class="form-control" @if(old('value.transaction_key')) value="{{old('value.transaction_key')}}"
                    @else value="{{ (isset($Settings['transaction_key'])) ? $Settings['transaction_key'] : '' }}" @endif >
                        @error("value.transaction_key")
                            {{$message}}
                        @enderror
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
