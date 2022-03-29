<section class="secNewsletter" style="background-image: url('{{(isset($fields['background']) ) ? asset($fields['background']) : '' }}');">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        @if(isset($fields['heading']))
          <h3 class="ft-blanka vc_heading clr-white">{!! $fields['heading'] !!}</h3>
        @else
          <h3 class="ft-blanka vc_heading clr-white">Newsletter</h3>
        @endif
      @if(isset($fields['description']))
      <p class="clr-white m-0">{!! $fields['description'] !!}</p>
      @endif      
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="NewsletterForm">
          <form class="" action="" method="post">
            <div class="input-field">
              <input id="newsletterEmail" class="input-email" type="email" name="email" placeholder="ENTER YOUR EMAIL:" required="required">
              <input class="input-submit newsletterSubmit" type="submit" name="submit" value="SIGNUP">
            </div>
          </form>
          <p class="newslettermsg"></p>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  
  $(".newsletterSubmit").click(function() {
    event.preventDefault();
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var email = $("#newsletterEmail").val(); 
      $.ajax({
         url:'{{route("newsletter.store")}}',
         type:'POST',
         data:'email='+email,
         success:function(data) {
            if(data.errors){
              $(".newslettermsg").text(data.message);
              setTimeout(function() {
                  $(".newslettermsg").hide();
              }, 3000);
            }else{
              $(".newslettermsg").text(data.msg);
              $(".newslettermsg").show();
              setTimeout(function() {
                  $(".newslettermsg").hide();
                  $("#newsletterEmail").val("");
              }, 3000);
            }
        }
      });
  });

</script>