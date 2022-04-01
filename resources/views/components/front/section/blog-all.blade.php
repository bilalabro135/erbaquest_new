
<section class="secMedia pt-100 pb-100">
 	<div class="container">
		<h3 class="ft-blanka ftw-bold_36 text-center mb-40">MEDIA</h3>
        <div class="row">
          @if($blogs)
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
                <h5 class="cat">{{$blog['catName']}}</h5>
                <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $blog['id']])}}"><h3>{{$blog['podcast_name']}}</h3></a>
                <p>{{$blog['short_description']}}</p>
                <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $blog['id']])}}" class="md-link">READ MORE</a>
              </div>
            </div>
            @endforeach
          @endif
          <div class="col-sm-12">
            <div class="pagination">
              {!! $blogs->render() !!}
            </div>
          </div>
        </div>
  	</div>
</section>
