document.addEventListener("DOMContentLoaded", function () {
  var country = getCookieValue("country");
  // var currency = getCookieValue("currency");

  // console.log(country, currency);
  // Code to be executed when the DOM is ready
  if (country === null) {
    checkLocation();
  }

  removeExpiredCookie("currency");
  removeExpiredCookie("country");
});

function isCookieExpired(cookieName) {
  var cookie = document.cookie.match(
    "(^|;)\\s*" + cookieName + "\\s*=\\s*([^;]+)"
  );
  if (cookie) {
    var cookieValue = decodeURIComponent(cookie[2]);
    var expirationDate = new Date(cookieValue);
    var currentDate = new Date();

    return currentDate > expirationDate;
  }

  return true; // Cookie not found or expired by default
}

function removeExpiredCookie(cookieName) {
  if (isCookieExpired(cookieName)) {
    document.cookie =
      cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    // console.log("Expired cookie has been removed.");
  }
}

function getCookieValue(name) {
  return (
    document.cookie.match("(^|;)\\s*" + name + "\\s*=\\s*([^;]+)")?.pop() ||
    null
  );
}

function expireMonth(month) {
  var now = new Date();
  now.setMonth(now.getMonth() + month);
  now.setTime(now);
  return now;
}

function checkLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showCountry);
  } else {
    console.log("Geolocation is not supported by this browser.");
  }
}

function setLocation(country) {
  if (country == "Bangladesh") {
    document.cookie =
      "country=Bangladesh;expires=" + expireMonth(1).toUTCString() + ";path=/";
    document.cookie =
      "currency=BDT;expires=" + expireMonth(1).toUTCString() + ";path=/";
  } else {
    document.cookie =
      "country=" +
      country +
      ";expires=" +
      expireMonth(1).toUTCString() +
      ";path=/";
    document.cookie =
      "currency=USD;expires=" + expireMonth(1).toUTCString() + ";path=/";
  }

  location.reload();
}

function showCountry(position) {
  var latitude = position.coords.latitude;
  var longitude = position.coords.longitude;

  var geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(latitude, longitude);

  geocoder.geocode(
    {
      latLng: latlng,
    },
    function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          for (var i = 0; i < results[0].address_components.length; i++) {
            for (
              var j = 0;
              j < results[0].address_components[i].types.length;
              j++
            ) {
              if (results[0].address_components[i].types[j] == "country") {
                var country = results[0].address_components[i].long_name;
                // console.log("Current Country: " + country);
                setLocation(country);
                return;
              }
            }
          }
        } else {
          console.log("No results found");
        }
      } else {
        console.log("Geocoder failed due to: " + status);
      }
    }
  );
}
