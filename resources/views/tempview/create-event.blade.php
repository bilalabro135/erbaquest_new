@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
    <section class="inner-banner">
      <div class="container">
        <h1 class="ft-blanka">
          CREATE EVENT
        </h1>
      </div>
    </section>

    <section class="event-inner createEvent pt-100 pb-100">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="createEventForm margin-tb">
              <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>NAME OF QUEST:</label>
                    <input type="text" name="quest_name" placeholder="NAME:" required="required">
                  </div>
                  <div class="col-sm-12 col-md-6 input-field input-file">
                    <label>FEATURED PICTURE: <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span></label>
                    <input type="file" id="myFile" name="filename">
                    <div class="preview"></div>
                    <button type="button" id="uploadImg">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                      <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                    </button>
                  </div>
                  <div class="col-sm-12 input-field">
                    <label>DESCRIPTION:</label>
                    <textarea name="comment" placeholder="DESCRIPTION.."></textarea>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field input-file">
                    <label>PICTURE: <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span></label>
                    <input type="file" id="myFile1" name="filename">
                    <div class="preview1"></div>
                    <button type="button" id="uploadImg1">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                      <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                    </button>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field input-date">
                    <label>DATE:</label>
                    <input type="date" name="date">
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>ADDRESS:</label>
                    <input type="text" name="address" placeholder="Search Address:" required="required">
                    <div class="mapFrame">
                      <img src="{{asset('images/map.jpg')}}">
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 customDropdown input-field">
                    <label>TYPE OF EVENT:</label>
                    <select name="type">
                      <option selected="selected">Type:</option>
                      <option>Event</option>
                      <option>Event</option>
                      <option>Event</option>
                      <option>Event</option>
                    </select>
                    <div class="donation">
                      <div class="input-field input-full">
                        <label>EXPECTED DOOR DONATION:</label>
                        <input type="text" name="door_donation" placeholder="$10.0" required="required">
                      </div>
                      <div class="input-field input-half">
                        <label>EXPECTED DOOR:</label>
                        <input type="text" name="door_donation" placeholder="$10.0" required="required">
                      </div>
                      <div class="input-field input-half">
                        <label>EXPECTED DOOR:</label>
                        <input type="text" name="door_donation" placeholder="$10.0" required="required">
                      </div>
                      <div class="input-field input-half">
                        <label>EXPECTED DOOR:</label>
                        <input type="text" name="door_donation" placeholder="$10.0" required="required">
                      </div>
                      <div class="input-field input-half">
                        <label>EXPECTED DOOR:</label>
                        <input type="text" name="door_donation" placeholder="$10.0" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>VENDOR:</label>
                    <input type="text" class="vendor_list" name="vendor_list" placeholder="VENDOR:" readonly="readonly">
                    <div class="VendorList">
                      <ul>
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{asset('images/tst-author.p')}}ng"></span>LOREM IPSUM
                              <input type="checkbox" name="vendor" required="required">
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{asset('images/tst-author.p')}}ng"></span>LOREM IPSUM
                              <input type="checkbox" name="vendor" required="required">
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{asset('images/tst-author.p')}}ng"></span>LOREM IPSUM
                              <input type="checkbox" name="vendor" required="required">
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{asset('images/tst-author.p')}}ng"></span>LOREM IPSUM
                              <input type="checkbox" name="vendor" required="required">
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{asset('images/tst-author.p')}}ng"></span>LOREM IPSUM
                              <input type="checkbox" name="vendor" required="required">
                            </label>
                          </div>
                        </li>
                      </ul>
                      <p>Can’t find vendor? <a href="javascript:;">ASK to join</a> </p>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field inputTags">
                    <ul class="vendorTags">
                      <li>
                        Lorem Ipsum <i class="fas fa-times"></i>
                      </li>
                      <li>
                        Lorem Ipsum <i class="fas fa-times"></i>
                      </li>
                      <li>
                        Lorem Ipsum <i class="fas fa-times"></i>
                      </li>
                      <li>
                        Lorem Ipsum <i class="fas fa-times"></i>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>VENDOR SPACES AVAILABLE:</label>
                    <input type="number" name="spaces" value="1">
                  </div>
                  <div class="col-sm-12">
                    <h4>AMENTIES:</h4>
                    <div class="AmentieList">
                      <ul>
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{asset('images/tst-author.p')}}ng"></span>LOREM IPSUM
                              <input type="checkbox" name="vendor" required="required">
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{asset('images/tst-author.p')}}ng"></span>LOREM IPSUM
                              <input type="checkbox" name="vendor" required="required">
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{asset('images/tst-author.p')}}ng"></span>LOREM IPSUM
                              <input type="checkbox" name="vendor" required="required">
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{asset('images/tst-author.p')}}ng"></span>LOREM IPSUM
                              <input type="checkbox" name="vendor" required="required">
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{asset('images/tst-author.p')}}ng"></span>LOREM IPSUM
                              <input type="checkbox" name="vendor" required="required">
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{asset('images/tst-author.p')}}ng"></span>LOREM IPSUM
                              <input type="checkbox" name="vendor" required="required">
                            </label>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>AREA:</label>
                    <select name="area">
                      <option selected="selected">Area:</option>
                      <option>Area1</option>
                      <option>Area2</option>
                    </select>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>HEIGHT:</label>
                    <select name="Height">
                      <option selected="selected">Height:</option>
                      <option>Height1</option>
                      <option>Height2</option>
                    </select>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>CAPACITY:</label>
                    <select name="Capacity">
                      <option selected="selected">Capacity:</option>
                      <option>Capacity1</option>
                      <option>Capacity2</option>
                    </select>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>ATM ON SITE:</label>
                    <select name="ATM ON SITE">
                      <option selected="selected">ATM ON SITE:</option>
                      <option>Yes</option>
                      <option>No</option>
                    </select>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TICKETING NUMBER:</label>
                    <input type="text" name="ticket" placeholder="Ticket Number:">
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>VENDOR NUMBER:</label>
                    <input type="text" name="ticket" placeholder="Vendor Number:">
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>USER NUMBER:</label>
                    <input type="text" name="user_number" placeholder="User Number:">
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>WEBSITE LINK:</label>
                    <input type="url" name="website_link" placeholder="http://">
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>FACEBOOK LINK:</label>
                    <input type="url" name="facebook_link" placeholder="http://">
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TWITTER LINK:</label>
                    <input type="url" name="twitter_link" placeholder="http://">
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>LINKEDIN LINK:</label>
                    <input type="url" name="linkedin_link" placeholder="http://">
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>INSTAGRAM LINK:</label>
                    <input type="url" name="instagram_link" placeholder="http://">
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>YOUTUBE LINK:</label>
                    <input type="url" name="youtube_link" placeholder="http://">
                  </div>
                  <div class="input-field input-submit">
                    <button class="btn-custom" type="button">PREVIEW</button>
                    <button class="btn-custom" type="submit">SUBMIT</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection