;(function($) {
  'use strict';
  var $body = $('html, body'),
      content = $('.movies').smoothState();
})(jQuery);

function openModal() {
  $('.theater-modal').modal('show');
}

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
};

function copyToClipboard() {
  var $temp = $("<input>")
   $("body").append($temp);
   console.log();
   $temp.val($("#copy").val()).select();
   document.execCommand("copy");
   $temp.remove();
};

function getSelectedDate(cookie)
{
  if(cookie)
  {
    var date = cookie;
    var parts = date.split("-");
    var dateCheck = new Date(Number(parts[2]), Number(parts[1]) - 1, Number(parts[0]));
    if(new Date(dateCheck) > new Date()) {
      return date;
    }
  }
  return getCurrentDay();
};

function getIndexByAlias(obj, value) {
    var returnKey = -1;

    $.each(obj, function(key, info) {
        if (info.alias == value) {
           returnKey = key;
           return false;
        };
    });

    return returnKey;
};
