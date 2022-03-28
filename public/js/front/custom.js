// Event Map Create
function initMap() {
  const map = new google.maps.Map(document.getElementById("googlemap"), {
    center: { lat: 40.749933, lng: -73.98633 },
    zoom: 13,
    mapTypeControl: false,
});
const input = document.getElementById("pac-input");
const options = {
  fields: ["formatted_address", "geometry", "name"],
  strictBounds: false,
  types: [],
};

const autocomplete = new google.maps.places.Autocomplete(input, options);
autocomplete.bindTo("bounds", map);
const infowindow = new google.maps.InfoWindow();
const infowindowContent = document.getElementById("infowindow-content");
infowindow.setContent(infowindowContent);
const marker = new google.maps.Marker({
  map,
  anchorPoint: new google.maps.Point(0, -29),
});
autocomplete.addListener("place_changed", () => {
infowindow.close();
marker.setVisible(false);
const place = autocomplete.getPlace();
if (!place.geometry || !place.geometry.location) {
  window.alert("No details available for input: '" + place.name + "'");
  return;
}
var address = place.formatted_address;
var latitude = place.geometry.location.lat();
var longitude = place.geometry.location.lng();
$('#latitude').val(latitude);
$('#longitude').val(longitude);
if (place.geometry.viewport) {
  map.fitBounds(place.geometry.viewport);
} else {
  map.setCenter(place.geometry.location);
  map.setZoom(17);
}
  marker.setPosition(place.geometry.location);
  marker.setVisible(true);
  infowindowContent.children["place-name"].textContent = place.name;
  infowindowContent.children["place-address"].textContent =
  place.formatted_address;
  infowindow.open(map, marker);
});
  google.maps.event.addDomListener(input, 'keydown', function(event) { 
    if (event.keyCode === 13) { 
        event.preventDefault(); 
    }
  });
}

// Edit Map 
function editMap() {
  const map = new google.maps.Map(document.getElementById("edit_googlemap"), {
    center: { lat: 40.749933, lng: -73.98633 },
    zoom: 13,
    mapTypeControl: false,
});
const input = document.getElementById("edit_pac-input");
const options = {
  fields: ["formatted_address", "geometry", "name"],
  strictBounds: false,
  types: [],
};

const autocomplete = new google.maps.places.Autocomplete(input, options);
autocomplete.bindTo("bounds", map);
const infowindow = new google.maps.InfoWindow();
const infowindowContent = document.getElementById("edit_infowindow-content");
infowindow.setContent(infowindowContent);
const marker = new google.maps.Marker({
  map,
  anchorPoint: new google.maps.Point(0, -29),
});
autocomplete.addListener("place_changed", () => {
infowindow.close();
marker.setVisible(false);
const place = autocomplete.getPlace();
if (!place.geometry || !place.geometry.location) {
  window.alert("No details available for input: '" + place.name + "'");
  return;
}
var address = place.formatted_address;
var latitude = place.geometry.location.lat();
var longitude = place.geometry.location.lng();
$('#edit_latitude').val(latitude);
$('#edit_longitude').val(longitude);
if (place.geometry.viewport) {
  map.fitBounds(place.geometry.viewport);
} else {
  map.setCenter(place.geometry.location);
  map.setZoom(17);
}
  marker.setPosition(place.geometry.location);
  marker.setVisible(true);
  infowindowContent.children["edit_place-name"].textContent = place.name;
  infowindowContent.children["edit_place-address"].textContent =
  place.formatted_address;
  infowindow.open(map, marker);
});
  google.maps.event.addDomListener(input, 'keydown', function(event) { 
    if (event.keyCode === 13) { 
        event.preventDefault(); 
    }
  });
}



// Create Event Validation

$.validator.addMethod("extension", function(value, element, param) {
  param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpg|jpeg";
  return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
}, "Please enter a value Like (png|jpg|jpeg) a valid extension.");

$.validator.addMethod('maxfilesize', function(value, element, param) {
  var length = ( element.files.length );
  var fileSize = 0;
  if (length > 0) {
      for (var i = 0; i < length; i++) {
        fileSize = element.files[i].size; // get file size
        // console.log("if" +length);
        fileSize = fileSize / 1024; //file size in Kb
        fileSize = fileSize / 1024; //file size in Mb
        $('html, body').animate({
		   scrollTop: $('html, body').offset().top,
		});
        return this.optional( element ) || fileSize <= param;
      }
    }
    else{
  //   	$('html, body').animate({
		//    scrollTop: $('html, body').offset().top,
		// });
      	return this.optional( element ) || fileSize <= param;
      	//console.log("else" +length);
    }

});

// File Dimention Method





$(function() {
  $(".front_event_create").validate({
    rules: {
      name: "required",
      featured_image: {
        required: true,
        extension: "png|jpg|jpeg",
        maxfilesize: 2,
      },
      'gallery[]': {
        required: true,
        extension: "png|jpg|jpeg",
        maxfilesize: 2,
      },
      event_date: {
        required: true,
        date: true
      },
      address: "required",
      type: "required",
      door_dontation: "required",
      vip_dontation: "required",
      vip_perk: "required",
      charity: "required",
      cost_of_vendor: "required",
      // vendor_list: "required",
      // vendor_space_available: "required",
      // amenities: "required",
      area: "required",
      height: "required",
      capacity: "required",
      ATM_on_site: "required",
      tickiting_number: {
        required: true,
        phoneUS: true
      },
      vendor_number: {
        required: true,
        phoneUS: true
      },
      // user_number: "required",
      // website_link: {
      //   required: true,
      //   url: true
      // },
      // facebook: {
      //   required: true,
      //   url: true
      // },
      // twitter: {
      //   required: true,
      //   url: true
      // },
      // linkedin: {
      //   required: true,
      //   url: true
      // },
      // instagram: {
      //   required: true,
      //   url: true
      // },
      // youtube: {
      //   required: true,
      //   url: true
      // },
    },
    messages: {
      name: "The name field is required.",
      featured_image: {
        required:"The FEATURED PICTURE field is required.",
        extension:"Please use .PNG .JPG .JPEG format",
        maxfilesize:"File size must be less than 2MB",
      },
      'gallery[]': {
        required:"The PICTURE field is required.",
        extension:"Please use .PNG .JPG .JPEG format",
        maxfilesize:"File size must be less than 2MB",
      },
      event_date: "The Date field is required.",
      map_address: "The ADDRESS field is required.",
      type: "The TYPE OF EVENT field is required.",
      door_dontation: "The EXPECTED DOOR DONATION field is required.",
      vip_dontation: "The Date field is required.",
      vip_perk: "The VIP PERKS field is required.",
      charity: "The CHARITY field is required.",
      cost_of_vendor: "The COST TO VEND field is required.",
      // vendor_list: "The VENDOR field is required.",
      vendor_space_available: "The VENDOR SPACES AVAILABLE field is required.",
      // amenities: "The AMENTIES field is required.",
      area: "The AREA field is required.",
      height: "The height field is required.",
      capacity: "The capacity field is required.",
      ATM_on_site: "The ATM ON SITE field is required.",
      tickiting_number: "US Based NUMBER is required.",
      vendor_number: "US Based NUMBER is required.",
      // user_number: "The USER NUMBER field is required.",
      // website_link: {
      //   required:"The website link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
      // facebook: {
      //   required:"The facebook link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
      // twitter: {
      //   required:"The twitter link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
      // linkedin: {
      //   required:"The linkedin link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
      // instagram: {
      //   required:"The instagram link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
      // youtube: {
      //   required:"The youtube link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

// Edit Event Validation
$(function() {
  $(".front_event_update").validate({
    rules: {
      name: "required",
      event_date: {
        required: true,
        date: true
      },
      map_address: "required",
      type: "required",
      door_dontation: "required",
      vip_dontation: "required",
      vip_perk: "required",
      charity: "required",
      cost_of_vendor: "required",
      // vendor_list: "required",
      // vendor_space_available: "required",
      // amenities: "required",
      area: "required",
      height: "required",
      capacity: "required",
      ATM_on_site: "required",
      tickiting_number: {
        required: true,
        phoneUS: true
      },
      vendor_number: {
        required: true,
        phoneUS: true
      },
      // user_number: "required",
      // website_link: {
      //   required: true,
      //   url: true
      // },
      // facebook: {
      //   required: true,
      //   url: true
      // },
      // twitter: {
      //   required: true,
      //   url: true
      // },
      // linkedin: {
      //   required: true,
      //   url: true
      // },
      // instagram: {
      //   required: true,
      //   url: true
      // },
      // youtube: {
      //   required: true,
      //   url: true
      // },
    },
    messages: {
      name: "The name field is required.",
      event_date: "The Date field is required.",
      map_address: "The ADDRESS field is required.",
      type: "The TYPE OF EVENT field is required.",
      door_dontation: "The EXPECTED DOOR DONATION field is required.",
      vip_dontation: "The Date field is required.",
      vip_perk: "The VIP PERKS field is required.",
      charity: "The CHARITY field is required.",
      cost_of_vendor: "The COST TO VEND field is required.",
      // vendor_list: "The VENDOR field is required.",
      vendor_space_available: "The VENDOR SPACES AVAILABLE field is required.",
      // amenities: "The AMENTIES field is required.",
      area: "The AREA field is required.",
      height: "The height field is required.",
      capacity: "The capacity field is required.",
      ATM_on_site: "The ATM ON SITE field is required.",
      tickiting_number: "US Based NUMBER is required.",
      vendor_number: "US Based NUMBER is required.",
      // user_number: "The User NUMBER is required.",
      // website_link: {
      //   required:"The website link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
      // facebook: {
      //   required:"The facebook link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
      // twitter: {
      //   required:"The twitter link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
      // linkedin: {
      //   required:"The linkedin link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
      // instagram: {
      //   required:"The instagram link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
      // youtube: {
      //   required:"The youtube link field is required.",
      //   url:"Please use the complete link with https:// or http://",
      // },
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

//account
$(function() {
  $(".account_form_val").validate({
    rules: {
      name: "required",
      email: {
        required: true,
        email: true
      },
      phone: 'required',
      password : {
        minlength : 6
      },
      password1 : {
        minlength : 6,
        equalTo : "#password"
      },
    },
    messages: {
      name: "The name field is required.",
      phone: "The phone field is required.",
      email: {
        required:"The email field is required.",
        email:"Please enter correct email.",
      },
      password: "The password field is required.",
      password_confirmation: {
        required:"The password field is required.",
        equalTo:"Please enter the same value again.",
      },
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

// Register
$(function(){
  $(".register_form_valid").validate({
    rules: {
      name: "required",
      email: {
        required: true,
        email: true
      },
      password : {
        minlength : 6
      },
      password_confirmation : {
        minlength : 6,
        equalTo : "#password"
      },
    },
    messages: {
      name: "The name field is required.",
      email: {
        required:"The email field is required.",
        email:"Please enter correct email.",
      },
      password: "The password field is required.",
      password_confirmation: {
        required:"The password field is required.",
        equalTo:"Please enter the same value again.",
      },
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

// handle links with @href started with '#' only
$(document).on('click', 'a[href^="#"]', function(e) {
    // target element id
    var id = $(this).attr('href');
    
    // target element
    var $id = $(id);
    if ($id.length === 0) {
        return;
    }
    
    // prevent standard hash navigation (avoid blinking in IE)
    e.preventDefault();
    
    // top position relative to the document
    var pos = $id.offset().top;
    
    // animated top scrolling
    $('body, html').animate({scrollTop: pos});
});

// Contact Form
$(function(){
  $(".form_contact").validate({
    rules: {
      first_name: "required",
      last_name: "required",
      subject: "required",
      email: {
        required: true,
        email: true
      },
      
    },
    messages: {
      first_name: "The name first name is required.",
      last_name: "The name last name is required.",
      subject: "The name subject is required.",
      email: {
        required:"The email field is required.",
        email:"Please enter correct email.",
      },
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

