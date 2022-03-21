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
$(function() {
  $(".front_event_create").validate({
    rules: {
      name: "required",
      featured_image: "required",
      gallery: "required",
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
      vendor_list: "required",
      vendor_space_available: "required",
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
      user_number: "required",
      website_link: {
        required: true,
        url: true
      },
      facebook: {
        required: true,
        url: true
      },
      twitter: {
        required: true,
        url: true
      },
      linkedin: {
        required: true,
        url: true
      },
      instagram: {
        required: true,
        url: true
      },
      youtube: {
        required: true,
        url: true
      },
    },
    messages: {
      name: "The name field is required.",
      featured_image: "The FEATURED PICTURE field is required.",
      gallery: "The PICTURE field is required.",
      event_date: "The Date field is required.",
      map_address: "The ADDRESS field is required.",
      type: "The TYPE OF EVENT field is required.",
      door_dontation: "The EXPECTED DOOR DONATION field is required.",
      vip_dontation: "The Date field is required.",
      vip_perk: "The VIP PERKS field is required.",
      charity: "The CHARITY field is required.",
      cost_of_vendor: "The COST TO VEND field is required.",
      vendor_list: "The VENDOR field is required.",
      vendor_space_available: "The VENDOR SPACES AVAILABLE field is required.",
      // amenities: "The AMENTIES field is required.",
      area: "The AREA field is required.",
      height: "The height field is required.",
      capacity: "The capacity field is required.",
      ATM_on_site: "The ATM ON SITE field is required.",
      tickiting_number: "US Based NUMBER is required.",
      vendor_number: "US Based NUMBER is required.",
      user_number: "The USER NUMBER field is required.",
      website_link: "The WEBSITE LINK field is required.",
      facebook: "The FACEBOOK LINK DONATION field is required.",
      twitter: "The TWITTER LINK field is required.",
      linkedin: "The LINKEDIN LINK field is required.",
      instagram: "The INSTAGRAM LINK field is required.",
      youtube: "The YOUTUBE LINK field is required.",
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
      vendor_list: "required",
      vendor_space_available: "required",
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
      user_number: "required",
      website_link: {
        required: true,
        url: true
      },
      facebook: {
        required: true,
        url: true
      },
      twitter: {
        required: true,
        url: true
      },
      linkedin: {
        required: true,
        url: true
      },
      instagram: {
        required: true,
        url: true
      },
      youtube: {
        required: true,
        url: true
      },
    },
    messages: {
      name: "The name field is required.",
      featured_image: "The FEATURED PICTURE field is required.",
      gallery: "The PICTURE field is required.",
      event_date: "The Date field is required.",
      map_address: "The ADDRESS field is required.",
      type: "The TYPE OF EVENT field is required.",
      door_dontation: "The EXPECTED DOOR DONATION field is required.",
      vip_dontation: "The Date field is required.",
      vip_perk: "The VIP PERKS field is required.",
      charity: "The CHARITY field is required.",
      cost_of_vendor: "The COST TO VEND field is required.",
      vendor_list: "The VENDOR field is required.",
      vendor_space_available: "The VENDOR SPACES AVAILABLE field is required.",
      // amenities: "The AMENTIES field is required.",
      area: "The AREA field is required.",
      height: "The height field is required.",
      capacity: "The capacity field is required.",
      ATM_on_site: "The ATM ON SITE field is required.",
      tickiting_number: "US Based NUMBER is required.",
      vendor_number: "US Based NUMBER is required.",
      user_number: "The User NUMBER is required.",
      website_link: "The WEBSITE LINK field is required.",
      facebook: "The FACEBOOK LINK DONATION field is required.",
      twitter: "The TWITTER LINK field is required.",
      linkedin: "The LINKEDIN LINK field is required.",
      instagram: "The INSTAGRAM LINK field is required.",
      youtube: "The YOUTUBE LINK field is required.",
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
      field: {
        required: true,
        email: true
      },
      phone: 'required',
      address: "required",
    },
    messages: {
      name: "The name field is required.",
      phone: "The phone field is required.",
      address: "The Address field is required.",
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});