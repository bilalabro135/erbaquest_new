@extends('layouts.admin.app', ['title' => 'Add Vendor Category'])

@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Add Category</h1>

        <form action="{{route('admin.vendor.category.store')}}" method="POST" autocomplete="off">
            @csrf
            <div class="row">
                <input type="hidden" name="action" value="edit">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Add Vendor Category</h6>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="site_name">{{ __('Category Name*') }}</label>
                                <input type="text"  id="name" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Enter Full Name*" required="" value="{{ (old('name'))}}">        
                                @error('name')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
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
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script type="text/javascript">
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
</script>
@endsection




