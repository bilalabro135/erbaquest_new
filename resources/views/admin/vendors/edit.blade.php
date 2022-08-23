@extends('layouts.admin.app', ['title' => 'Edit Vendors'])

@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Edit Vendor</h1>

        <form action="{{route('admin.vendor.update.id', [$vendor->id])}}" method="POST" autocomplete="off">
            @csrf
            @method('POST')
            <div class="row">
                <input type="hidden" name="action" value="edit">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Vendor</h6>                           
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                            <label for="site_name">{{ __('Public profile Name*') }}</label>
                            <input type="text"  id="name" class="form-control  @error('name') is-invalid @enderror" name="public_profile_name" placeholder="Enter Full Name*" required="" value="{{ (old('public_profile_name')) ? old('public_profile_name') : $vendor->public_profile_name }}">        
                                @error('public_profile_name')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                            <label for="email">Email address*</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" required="" placeholder="Enter Email" name="email" value="{{ (old('email')) ? old('email') : $vendor->email }}">
                            @error('email')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" class="form-control @error('website') is-invalid @enderror" id="username" aria-describedby="emailHelp" placeholder="Website" name="website" value="{{ (old('website')) ? old('website') : $vendor->website }}">
                                @error('website')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="username" aria-describedby="emailHelp" placeholder="Instagram" name="instagram" value="{{ (old('instagram')) ? old('instagram') : $vendor->instagram }}">
                                @error('instagram')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="username" aria-describedby="emailHelp" placeholder="Facebook" name="facebook" value="{{ (old('facebook')) ? old('facebook') : $vendor->facebook }}">
                                @error('facebook')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="twitter">Twitter</label>
                                <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="username" aria-describedby="emailHelp" placeholder="Twitter" name="twitter" value="{{ (old('twitter')) ? old('twitter') : $vendor->twitter }}">
                                @error('twitter')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="youtube">Youtube</label>
                                <input type="text" class="form-control @error('youtube') is-invalid @enderror" id="username" aria-describedby="emailHelp" placeholder="Youtube" name="youtube" value="{{ (old('youtube')) ? old('youtube') : $vendor->youtube }}">
                                @error('youtube')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="linkedin">Linkedin</label>
                                <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="username" aria-describedby="emailHelp" placeholder="linkedin" name="linkedin" value="{{ (old('linkedin')) ? old('linkedin') : $vendor->linkedin }}">
                                @error('linkedin')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="telegram">Telegram</label>
                                <input type="text" class="form-control @error('telegram') is-invalid @enderror" id="username" aria-describedby="emailHelp" placeholder="telegram" name="telegram" value="{{ (old('telegram')) ? old('telegram') : $vendor->telegram }}">
                                @error('telegram')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="discord">discord</label>
                                <input type="text" class="form-control @error('discord') is-invalid @enderror" id="username" aria-describedby="emailHelp" placeholder="discord" name="discord" value="{{ (old('discord')) ? old('discord') : $vendor->discord }}">
                                @error('discord')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="username" aria-describedby="emailHelp" required="" placeholder="phone" name="phone" value="{{ (old('phone')) ? old('phone') : $vendor->phone }}">
                                @error('phone')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                            <label for="descreption">Description</label>
                            <textarea type="text"  class="form-control @error('descreption') is-invalid @enderror" required="" id="descreption" placeholder="Description" name="descreption">{{$vendor->descreption }}</textarea>
                            @error('descreption')
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
                            <h6 class="m-0 font-weight-bold text-primary">Featured Image</h6>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="profile_image" name="featured" value="{{$vendor->featured_picture}}">
                            <div class="file-upload" id="lfm" data-input="profile_image" data-preview="lfm">
                                @empty($vendor->featured_picture)
                                    Upload Image
                                @else
                                    <img src="{{asset($vendor->featured_picture)}}" style="height: 5rem;">
                                @endif

                            </div>
                            @error('featured')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endif
                            <a href="javascript:void(0)" class="text-danger mt-2 d-inline-block" onclick="removeImage()">Remove Image</a>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <label for="user_id">Select User*</label>
                            <div class="form-group">
                                <select name="user_id" id="user_id" required="" class="form-control">
                                    <option selected disabled>--Please select--</option>
                                    @foreach($users as $key => $value)
                                        @if($key == $vendor->user_id)
                                            <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('user_id')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endif

                            <label for="category_id">Select Category*</label>
                            <div class="form-group">
                                <select class="selectpicker js-com form-control" required="" id="category_id" name="category_id[]" multiple data-live-search="true">
                                    @foreach($category as $key => $value)
                                        @if(isset($vendor->category_id) && is_array($vendor->category_id) && in_array($key,$vendor->category_id))
                                            <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endif

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block px-5">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script type="text/javascript">
    // $(document).ready(function() {
    //   $('.selectpicker').selectpicker();
    // });

    var route_prefix = "{{route('unisharp.lfm.show')}}";
    $('#lfm').filemanager('image', {prefix: route_prefix});

    var route_prefix1 = "{{route('unisharp.lfm.show')}}";
    $('#lfm1').filemanager('image', {prefix: route_prefix1});

    function removeImage() {
        $('#profile_image').val('');
        $('#lfm').html('Upload Image')
    }

    function removePic() {
        $('#profile_pic').val('');
        $('#lfm1').html('Upload Image')
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
    $(document).ready(function() {
      $('.selectpicker').select2();
    });
</script>
@endsection