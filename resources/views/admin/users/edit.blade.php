@extends('layouts.admin.app', ['title' => 'Edit User'])

@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

        <form action="{{route('users.update')}}" method="POST" autocomplete="off">
               @csrf
               <input type="hidden" name="id" value="{{$user->id}}">
               <input type="hidden" name="old_email" value="{{$user->email}}">
               <input type="hidden" name="old_username" value="{{$user->username}}">
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>                           
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                            <label for="site_name">{{ __('Full Name*') }}</label>
                            <input type="text"  id="name" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Enter Full Name*" required="" value="{{ (old('name')) ? old('name') : $user->name }}">        
                                @error('name')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                            <label for="email">Email address*</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" required="" placeholder="Enter Email" name="email" value="{{ (old('email')) ? old('email') : $user->email }}">
                            @error('email')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>
                            <div class="form-group">
                            <label for="username">Username*</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="emailHelp" required="" placeholder="Enter Username" name="username" value="{{ (old('username')) ? old('username') : $user->username }}">
                            @error('username')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>
                            <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text"  class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Address" name="address" value="{{ (old('address')) ? old('address') : $user->address }}">
                            @error('address')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>
                            <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text"  class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" name="phone" value="{{ (old('phone')) ? old('phone') : $user->phone }}">
                            @error('phone')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Password*</label>
                            <input type="password"  class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" name="password" value="">
                            @error('password')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow profile_image mb-4">
                        <div class="card-header  py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Profile Image</h6>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="profile_image" value="{{$user->profile_image}}" name="profile_image">
                            <div class="file-upload" id="lfm" data-input="profile_image" data-preview="lfm" >
                                @empty($user->profile_image)
                                    Upload Image
                                @else
                                     <img src="{{$user->profile_image}}" style="height: 5rem;">
                                @endif
                               
                            </div>
                            @error('profile_image')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            <a href="javascript:void(0)" class="text-danger mt-2 d-inline-block" onclick="removeImage()">Remove Image</a>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            @if((Bouncer::can('addRoles') || Bouncer::can('viewRoles')) &&  Bouncer::can('changeUserRole'))
                            <div class="form-group">
                                <label for="role">Select Role*</label>
                                <select name="role" id="role" required="" class="form-control">
                                    <option value="">Select Role*</option>
                                    @if(!empty($roles))
                                    @foreach ($roles as $role)
                                        @if(!empty($user->getRoles()[0]) && $user->getRoles()[0] == $role)
                                                <option value="{{$role}}" selected>{{$role}}</option>
                                        @else
                                                <option value="{{$role}}" >{{$role}}</option>
                                        @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            @else
                            <input type="hidden" name="role" value="{{(!empty($user->getRoles()[0])) ? $user->getRoles()[0] : $Settings['default_role']}}">
                            @endif
                            
                            <div class="form-group">
                                <label for="role">Select Verfication Options*</label>
                                <select class="form-control  @error('email_verified_at') is-invalid @enderror" name="email_verified_at" required="">
                                    <option value="">Verfication Options*</option>
                                    @if($user->email_verified_at == null)
                                        <option value="send">Send Verification Email</option>
                                        <option value="verified">Email Aleady Verified</option>
                                    @else
                                        <option value="" selected="selected">Verified</option>
                                        <option value="null" >Not Verified</option>
                                    @endif

                                </select>
                                @error('email_verified_at')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="role">Featured</label>
                                <input type="checkbox" name="featured" value="1" @if( $user->featured ) checked="checked" @endif >
                                @error('email_verified_at')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block px-5">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            @if($sendReviews) 
                <div class="col-md-12">
                    <div class="alert-success success review_sucess">
                        Review has been removed!
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Reviews On Vendors</h6>                           
                        </div>
                            <div class="card-body">
                            @foreach($sendReviews as $sendReview)
                                <div class="card_reviews" id="comment_{{ $sendReview['id'] }}">
                                    <div class="profilePicture">
                                        @if(!empty($sendReview['profile_image']))
                                            <img src="{{ $sendReview['profile_image'] }}" >
                                          @else
                                            <img src="{{asset('images/avatar.png')}}">
                                          @endif
                                    </div>
                                    <div class="profile_info">
                                        <div class="profile_name">{{ $sendReview['name'] }}</div>
                                        <div class="date">{{ $sendReview['date'] }}</div>
                                        <div class="rating_Set">
                                            <div class="rating_speed">
                                                <h5>Speed</h5> 
                                               <ul>
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if($i >= $sendReview['speed_rating'])
                                                        <li><i class="far fa-star"></i></li> <!-- kali -->
                                                    @else
                                                        <li><i class="fas fa-star"></i></li> 
                                                    @endif
                                                @endfor
                                                   <div style="clear: both;"></div>
                                               </ul> 
                                               <div style="clear: both;"></div>
                                           </div>
                                           <div class="rating_speed">
                                                <h5>Quality:</h5> 
                                               <ul>
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if($i >= $sendReview['quality_rating'])
                                                        <li><i class="far fa-star"></i></li> <!-- kali -->
                                                    @else
                                                        <li><i class="fas fa-star"></i></li> 
                                                    @endif
                                                @endfor
                                                   <div style="clear: both;"></div>
                                               </ul> 
                                               <div style="clear: both;"></div>
                                           </div>
                                           <div class="rating_speed">
                                                <h5>Price:</h5> 
                                               <ul>
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if($i >= $sendReview['price_rating'])
                                                        <li><i class="far fa-star"></i></li> <!-- kali -->
                                                    @else
                                                        <li><i class="fas fa-star"></i></li> 
                                                    @endif
                                                @endfor
                                                   <div style="clear: both;"></div>
                                               </ul> 
                                               <div style="clear: both;"></div>
                                           </div>
                                           <div style="clear: both;"></div>
                                        </div>
                                        
                                        <div style="clear: both;"></div>
                                        <div class="person_desc">
                                            <p id="parah_comment_{{ $sendReview['id'] }}" class="ondelete">{{ $sendReview['comment'] }}</p>
                                            <textarea id="textarea_{{ $sendReview['id'] }}" class="onsubmit">{{ $sendReview['comment'] }}</textarea>

                                        </div>
                                        <div class="action_set">
                                            <ul>
                                                <li class="ondelete">
                                                    <a class="edittextarea" href="javascript:void(0);">Edit</a>
                                                </li>
                                                <li class="onsubmit">
                                                    <a class="submit_func"  data-vendorid="{{ $sendReview['id'] }}" href="javascript:void(0);">Submit</a>
                                                </li>
                                                <li class="ondelete">
                                                    <a data-vendorid="{{ $sendReview['id'] }}" class="delete_func" href="javascript:void(0);">Delete</a>
                                                </li>
                                                <li class="onsubmit">
                                                    <a class="cancelButton" href="javascript:void(0);">Cancel</a>
                                                </li>
                                                <div style="clear: both;"></div>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                            @endforeach    
                        </div>
                    </div>
                </div>   
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script type="text/javascript">
    var route_prefix = "{{route('unisharp.lfm.show')}}";
    $('#lfm').filemanager('image', {prefix: route_prefix});
    function removeImage() {
        $('#profile_image').val('');
        $('#lfm').html('Upload Image')
    }
</script>
<script type="text/javascript">
    $(".delete_func").click(function() {
        if (confirm('Are you sure?')) {
            var comment_id = $(this).data("vendorid"); 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
               type:'POST',
               url: '{{route("comment.delete")}}',
               data:'comment_id='+comment_id,
               success:function() {
                  $("#comment_"+comment_id).remove();
                  $(".review_sucess").show();
                  $(".review_sucess").delay("slow").fadeOut();
               }
            });
        }
    });

    $(".submit_func").click(function(){
        var comment_id = $(this).data("vendorid");
        var comment = $("#textarea_"+comment_id).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
           type:'POST',
           url: '{{route("comment.submit")}}',
           data:'comment_id='+comment_id+"&comment="+comment,
           success:function() {
              $(".onsubmit").hide();
              $(".ondelete").show();
              $("#parah_comment_"+comment_id).text(comment);
           }
        });
    });
    $(".edittextarea").click(function() {
        var thisfolder = $(this).parent("li").parent("ul").parent(".action_set").parent(".profile_info");
        thisfolder.find(".person_desc p").hide();
        thisfolder.find(".person_desc textarea").show();
        thisfolder.find(".onsubmit").show();
        thisfolder.find(".ondelete").hide();
    });
    $(".cancelButton").click(function() {
        var thisfolder = $(this).parent("li").parent("ul").parent(".action_set").parent(".profile_info");
        thisfolder.find(".onsubmit").hide();
        thisfolder.find(".ondelete").show();
    });
</script>
@endsection




