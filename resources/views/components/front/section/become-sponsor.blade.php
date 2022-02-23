<section class="becomeSponsor">
  <div  class="container">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        @if(isset($fields['heading']))
           <h3 class="ft-blanka vc_heading vc_heading-green">{!! $fields['heading'] !!}</h3>
        @endif
      @if(isset($fields['description']))
      <p>{!! $fields['description'] !!}</p>
      @endif
       @if(isset($fields['cta_action']))
      <a class="btn-custom" href="{{$fields['cta_action']}}">{{ (isset($fields['cta_text'])) ? $fields['cta_text'] : $fields['cta_action'] }}</a>
      @endif
      </div>
      @if(isset($fields['background']) )
      <div class="col-sm-12 col-md-6">
        <figure class="m-0">
          <img src="{{$fields['background']}}">
        </figure>
      </div>
      @endif
    </div>
  </div>
</section>