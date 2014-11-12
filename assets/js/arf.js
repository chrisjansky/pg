$(document).on("ready", function() {

  // Random number from 1 to 4.
  $("[data-random]").each(function() {
    var
      randomNum = Math.floor((Math.random() * 4) + 1),
      $this = $(this),
      $thisAttr = $this.attr("data-random");
    $this.addClass($thisAttr + "--" + randomNum);
  });

  $("a[href*='http']")
    .attr("target", "_blank");

});