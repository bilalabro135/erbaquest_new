<section class="secEventsList pb-65">
      <div class="container">
        @if(isset($fields['heading']))
           <h3 class="ft-blanka ftw-bold_36 text-center mb-40">{!! $fields['heading'] !!}</h3>
        @endif
        <div class="amenties_filter">
          <ul>
            @foreach($amenities as $amenity)
            <li>
              <label class="clcikalert @if(in_array($amenity->name, $selectedParameter)) selected @endif">              
                <figure>
                  <img src="{{$amenity->icon}}" alt="{{$amenity->name}}">
                </figure>

                <span class="text">{{$amenity->name}}</span>
                <input type="checkbox" name="amenties[]" value="{{$amenity->name}}" @if(in_array($amenity->name, $selectedParameter)) checked="checked"  @endif>
              </label>
            </li>
            @endforeach
          </ul>
        </div>
    </div>
</section>
@push('scripts')
    <script type="text/javascript">
        $('.amenties_filter li input').change(function(){
            if($(this).is(':checked')){
                $(this).parent('label').addClass('selected');
            }
            else{
                $(this).parent('label').removeClass('selected');                
            }
        })
    </script>
@endpush