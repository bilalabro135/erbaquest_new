
<form class="user" method="POST" action="{{ route('settings.save') }}">
    @csrf
    <input type="hidden" name="name" value="{{$type}}">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Social Media</h6>
            <button type="submit" class="btn btn-primary btn-md px-5">
                {{ __('Save') }}
            </button>
        </div>
        <div class="card-body">

            <div class="row social-media">
                <div class="col-md-2 d-flex justify-content-end align-items-center">
                    <i class="fab fa-facebook"></i>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="url" name="value[facebook]" id="sm-link" placeholder="Social Media Link" class="form-control"  @if(old('value.facebook')) value="{{old('value.facebook')}}"
                    @else value="{{ (isset($Settings['facebook'])) ? $Settings['facebook'] : '' }}" @endif >
                        @error("value.facebook")
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 d-flex justify-content-end align-items-center">
                    <i class="fab fa-linkedin"></i>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="url" name="value[linkedin]" id="sm-link" placeholder="Social Media Link" class="form-control"  @if(old('value.linkedin')) value="{{old('value.linkedin')}}"
                    @else value="{{ (isset($Settings['linkedin'])) ? $Settings['linkedin'] : '' }}" @endif >
                        @error("value.linkedin")
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 d-flex justify-content-end align-items-center">
                    <i class="fab fa-youtube"></i>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="url" name="value[youtube]" id="sm-link" placeholder="Social Media Link" class="form-control" @if(old('value.youtube')) value="{{old('value.youtube')}}"
                    @else value="{{ (isset($Settings['youtube'])) ? $Settings['youtube'] : '' }}" @endif >
                        @error("value.youtube")
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 d-flex justify-content-end align-items-center">
                    <i class="fab fa-vimeo"></i>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="url" name="value[vimeo]" id="sm-link" placeholder="Social Media Link" class="form-control" @if(old('value.vimeo')) value="{{old('value.vimeo')}}"
                    @else value="{{ (isset($Settings['vimeo'])) ? $Settings['vimeo'] : '' }}" @endif >
                        @error("value.vimeo")
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 d-flex justify-content-end align-items-center">
                    <i class="fab fa-instagram"></i>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="url" name="value[instagram]" id="sm-link" placeholder="Social Media Link" class="form-control" @if(old('value.instagram')) value="{{old('value.instagram')}}"
                    @else value="{{ (isset($Settings['instagram'])) ? $Settings['instagram'] : '' }}" @endif >
                        @error("value.instagram")
                            {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 d-flex justify-content-end align-items-center">
                    <i class="fab fa-twitter"></i>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="url" name="value[twitter]" id="sm-link" placeholder="Social Media Link" class="form-control" @if(old('value.twitter')) value="{{old('value.twitter')}}"
                    @else value="{{ (isset($Settings['twitter'])) ? $Settings['twitter'] : '' }}" @endif >
                        @error("value.twitter")
                            {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
