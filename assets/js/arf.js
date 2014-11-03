$(document).on("ready pjax:success", function() {

  var
    swiperActive = false,
    mapIframe = document.getElementById("js-google_maps");

  // Set-up pjax.
  if ($.support.pjax) {
    $(document).on("click", "a", function(event) {
      $.pjax.click(event, {
        container: "#js-pjax",
        fragment: "#js-pjax"
      });
    });
  }

  // Randomize.
  $("[data-random]").each(function() {
    var
      randomNum = Math.floor((Math.random() * 5) + 1),
      $this = $(this),
      $thisAttr = $this.attr("data-random");
    $this.addClass($thisAttr + "--" + randomNum);
  });

  // Google Maps.
  if (mapIframe !== null) {
    function initMaps() {
      var mapOptions = {
        center: {lat: 49.221254, lng: 17.655977},
        zoom: 15,
        scrollwheel: false
      };
      var 
        map = new google.maps.Map(mapIframe, mapOptions),
        infoWindow = new google.maps.InfoWindow(),
        mapMarker = new google.maps.Marker({
          position: mapOptions.center,
          map: map,
          title: "Photogether Gallery"
        })
      google.maps.event.addListener(mapMarker, "click", function() {
        infoWindow.setContent("Health Center Bunker, Tr. Tomáše Bati 3705, 760 01 Zlín, Czech Republic");
        infoWindow.open(map, mapMarker);
      });
    }
    initMaps();
  }

  // Trigger Featherlight lightbox on click.
  $("[data-lightbox]").on("click", function(event) {
    event.preventDefault();
    if (!swiperActive) {
      $.featherlight(this.href, {
        closeOnClick: "anywhere",
        type: {image: true}
      });
    }
  });

  // Initialize Swiper.
  var
    pgSwiper = new Swiper(".swiper-container", {
      slideElement: "li",
      slidesPerView: "auto",
      calculateHeight: true,
      keyboardControl: true,
      visibilityFullFit: true,
    onTouchMove: function() {
      swiperActive = true;
    },
    onTouchEnd: function() {
      setTimeout(function() {
        swiperActive = false;
      }, 250);
    }
  });

  $("[data-swiper--prev]").on("click", function(e) {
    e.preventDefault();
    pgSwiper.swipePrev();
  });

  $("[data-swiper--next]").on("click", function(e) {
    e.preventDefault();
    pgSwiper.swipeNext();
  });

});