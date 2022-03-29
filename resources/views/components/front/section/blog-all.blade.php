@if($blogs)
<section class="secMedia pt-100 pb-100">
 	<div class="container">
		<h3 class="ft-blanka ftw-bold_36 text-center mb-40">MEDIA</h3>
        <div class="row">
          @foreach($blogs as $blog)
          <div class="col-sm-12 col-md-4">
            <div class="media-box">
              <figure>
                @if ($blog['featured_image'])
                <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $blog['id']])}}">
                	<img src="{{ asset($blog['featured_image']) }}" alt="{{$blog['name']}}" />
                </a>
                @else 
                <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $blog['id']])}}">
                	<img src="{{ asset('images/avatar.png') }}" alt="{{$blog['name']}}" />
                </a>
                @endif
              </figure>
              <h5 class="cat">{{$blog['cat']}}</h5>
              <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $blog['id']])}}"><h3>{{$blog['name']}}</h3></a>
              <p>{{$blog['short_description']}}</p>
              <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $blog['id']])}}" class="md-link">READ MORE</a>
            </div>
          </div>
          @endforeach
          <div class="col-sm-12">
            <div class="pagination">
              <ul>
                <li class="pg-nav"><i class="fas fa-chevron-left" aria-hidden="true"></i> PREV</li>
                <li>1</li>
                <li class="active">2</li>
                <li>3</li>
                <li>4</li>
                <li>5</li>
                <li>6</li>
                <li class="pg-nav">NEXT <i class="fas fa-chevron-right" aria-hidden="true"></i></li>
              </ul>
            </div>
            <div class="pagination">
              {!! $blogs->render()  !!}
            </div>
          </div>
        </div>
  	</div>
</section>
@endif