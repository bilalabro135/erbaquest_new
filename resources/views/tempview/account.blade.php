@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
	    <section class="inner-banner">
      <div class="container">
        <h1 class="ft-blanka">
          ACCOUNT
        </h1>
      </div>
    </section>

    <section class="secAccount pt-100 pb-100">
      <div class="container">
        <div class="row">
          @include( 'tempview/sidebar' )
          <div class="col-sm-12 col-md-8">
            <div class="profile_info">
              <figure>
                <img src="{{asset('images/profilePic.png')}}">
              </figure>
              <div class="dt">
                <!-- <h3>LOREM IPSUM</h3> -->
                <h3>{{ $users->name }}</h3>
                <p>{{ $users->user_name }}</p>
              </div>
              <a href="javascript:;" class="edit_btn"><span class="figure"><img src="{{asset('images/edit-icon.png')}}"></span></a>
            </div>
            <div class="account_editForm">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              @if(session('msg'))
              <div class="alert alert-{{session('msg_type')}}">
                  {{session('msg')}}                                            
              </div>
              @endif
              <form class="" method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data">
                 @csrf
                 <input type="hidden" name="username" value="{{ $users->user_name }}">
                 <input type="hidden" name="id" value="{{ $users->id }}">
                <div class="input-field">
                  <label>NAME:</label>
                  <input type="text" name="name" placeholder="NAME:" required="required" value="{{ $users->name }}">
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field">
                  <label>EMAIL:</label>
                  <input type="email" name="email" placeholder="EMAIL:" required="required" value="{{ $users->email }}">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field">
                  <label>PHONE:</label>
                  <input type="tel" name="phone" placeholder="PHONE:" value="{{ $users->phone }}">
                  @error('phone')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field input-file">
                  <label>UPLOAD PICTURE: </label>
                  <input type="file" id="myFile123" name="filename">
                  <div class="preview"></div>
                  <button type="button" id="uploadImg">
                    <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                    <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                  </button>
                  @error('filename')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field">
                  <label>ADDRESS:</label>
                  <input type="text" name="address" placeholder="ADDRESS:" required="required" value="{{ $users->address }}">
                  @error('address')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field">
                  <label>DESCRIPTION:</label>
                  <textarea name="description" placeholder="DESCRIPTION.."></textarea>
                  @error('description')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field">
                  <label>PASSWORD:</label>
                  <input type="text" name="password" placeholder="PASSWORD:" >
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field">
                  <label>Confirm PASSWORD:</label>
                  <input type="text" name="password1" placeholder="CONFIRM PASSWORD:" >
                  @error('password1')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field input-checkbox">
                  <label>
                    <input type="checkbox" name="agreement" >
                    I agree Terms & Conditions
                  </label>
                  @error('agreement')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field input-submit">
                  <input type="submit" name="submit" value="UPDATE">
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>
    </section>

@endsection

@push('scripts')
<script type="text/javascript">
	
        $('ul.menu_list li .down-icon').on('click',function(){
          $(this).parent('li').toggleClass('current');
          $(this).parent('li').find('ul.sub-menu').slideToggle();
        })
</script>

@endpush