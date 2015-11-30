;(function($) {
  'use strict';
  var $body = $('html, body'),
      content = $('.movies').smoothState();
})(jQuery);

// DAY SELECTOR
$(document).on("click", ".days td", function() {
	$(this).parent().find("td").removeClass("active");
	$(this).addClass("active");
});


function getCurrentDay() {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();

  if(dd<10) {
      dd='0'+dd
  }

  if(mm<10) {
      mm='0'+mm
  }

  today = dd+'-'+mm+'-'+yyyy;
  return today;
}
