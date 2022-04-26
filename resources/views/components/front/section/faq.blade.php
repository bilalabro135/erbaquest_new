<div class="accordion" id="accordionExample">
	@if($fields)
	<?php $count = 1; ?>
    	@foreach($fields as $faq)
	    <div class="accordion-item">
	        <h2 class="accordion-header" id="heading<?php echo $count; ?>">
	          	@if(isset($faq['heading']))
		        	<button class="accordion-button @if($count != 1) collapsed @endif " type="button" data-bs-target="#collapse<?php echo $count; ?>" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse<?php echo $count; ?>">
		            	{!! $faq['heading'] !!}
		          	</button>
	          	@endif
	        </h2>
	        <div id="collapse<?php echo $count; ?>" class="accordion-collapse @if($count != 1) collapse @endif" aria-labelledby="heading<?php echo $count; ?>" data-bs-parent="#accordionExample">
	        	<div class="accordion-body">
	            	@if(isset($faq['description']))
	            		<p>{!! $faq['description'] !!}</p>
	          		@endif
	          	</div>
	        </div>
	    </div>
	    <?php $count ++; ?>
    	@endforeach
    @else
      <p>NO Info Found!</p>
	@endif 

<!--<div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Getting Started with Flowers?
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p>Nulla porttitor accumsan tincidunt. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor <br> risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
          </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Do i have the latest version?
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p>Nulla porttitor accumsan tincidunt. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor <br> risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
          </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            How many times can I use Flowers?
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p>Nulla porttitor accumsan tincidunt. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor <br> risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
          </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            How to migrate my website?
          </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p>Nulla porttitor accumsan tincidunt. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor <br> risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
          </div>
        </div>
    </div> -->
</div>