'use strict';

var BASE_URL = "http://localhost/Patheplanner/";
var MAX_MOVIE_AMOUNT = 5;
var DEFAULT_THEATERS = [{ id: 11, name: "Pathé Spuimarkt", alias: "spuimarkt", city: "Den Haag", city_alias: "denhaag", selected : true}];

/* Controllers */
var patheControllers = angular.module('patheControllers', []);

patheControllers.controller('HomeCtrl', ['$scope', '$location', '$cookies', 'patheService',
  function($scope, $location, $cookies, patheService)
  {
    $scope.selectedDate = getSelectedDate($cookies.get('day'));
    $scope.selectedTheaters = $cookies.get('theaters') ? JSON.parse($cookies.get('theaters')) : DEFAULT_THEATERS;
    $scope.selectedMovies = [];

    // Retrieve data
    patheService.getDays().success(function (response) {
      $scope.days = response;
    });

    patheService.getTheaters().success(function (response) {
      var theaters = $scope.setSelectedTheaters(response);
      $scope.theaters = theaters;
    });

    $scope.setSelectedTheaters = function(response)
    {
      $.each(response, function(city, theaters) {
        $.each(theaters, function(key, theater) {
          var index = getIndexByAlias($scope.selectedTheaters, theater.alias);
          if(index > -1) {
            theater.selected = true;
          }
        });
      });
      return response;
    };

    $scope.getMovies = function()
    {
      if($scope.selectedTheaters.length > 0) {
        // set loader
        $scope.loading = true;
        $scope.movies = [];
        $scope.selectedMovies = [];

        // get movies by theaters and date
        var data = {
          date : $scope.selectedDate,
          theaters : $scope.selectedTheaters
        };
        patheService.getMovies(data).success(function (response) {
          $scope.movies = response;
          $scope.loading = false;
        });
      }
    };

    $scope.selectDate = function(date)
    {
      $scope.selectedDate = date;
      $cookies.put('day', date);
    };

    $scope.selectTheater = function(theater)
    {
      var index = getIndexByAlias($scope.selectedTheaters, theater.alias);

      if(index == -1) {
        // check if city is the same
        if($scope.selectedTheaters.length > 0) {
          if($scope.selectedTheaters[0].city_alias != theater.city_alias) {
            $(".ui.checkbox input:checked."+ $scope.selectedTheaters[0].city_alias).click();
            $scope.selectedTheaters = [];
          }
        }
        // add theater to selected
        $scope.selectedTheaters.push(theater);

      } else {
        // remove deselected theater
        $scope.selectedTheaters.splice(index, 1);
      }
    };

    $scope.saveSelectedTheaters = function()
    {
      if($scope.selectedTheaters.length > 0) {
        $cookies.put('theaters', JSON.stringify($scope.selectedTheaters));
        $('.theater-modal').modal('hide');
        $scope.getMovies();
      }
    }

    $scope.selectMovie = function(movie)
    {
      var index = $scope.selectedMovies.indexOf(movie);
      var size = $scope.selectedMovies.length;

        if(index == -1) {
          // max 6 movies selected
          if(size < MAX_MOVIE_AMOUNT) {
            $scope.selectedMovies.push(movie);
            $(".item-"+ movie.id).addClass("selected");
          }
        } else {
          $scope.selectedMovies.splice(index, 1);
          $(".item-"+ movie.id).removeClass("selected");
        }
    };

    $scope.makePlanning = function()
    {
      $('.planning-modal').modal('setting', 'closable', false).modal('show');

      var data = {
        theaters : $scope.selectedTheaters,
        date : $scope.selectedDate,
        movies : $scope.selectedMovies
      };

      patheService.makePlanning(data).success(function (response) {
        var id = response;
        $location.path('planning/' + id);
        $('.planning-modal').modal('hide');
      });
    }

    $scope.$watch('selectedDate', function()
    {
      $scope.getMovies();
    });

    // delete modals on load
    $(".page.modals").remove();
  }]);


  patheControllers.controller('ResultCtrl', ['$scope', '$routeParams', '$timeout', 'patheService',
    function($scope, $routeParams, $timeout, patheService)
    {
      $scope.id = $routeParams.id;
      $scope.index = $routeParams.index ? $routeParams.index - 1 : 0;
      $scope.baseUrl = BASE_URL;
      $scope.loading = true;

      patheService.getResult($scope.id).success(function (response) {
        // set data
        $scope.loading = false;
        if(response.data) {
          $scope.items = JSON.parse(response.data);
          $scope.selectedItem = $scope.items[$scope.index];

          // set dropdown list
          $('.planning.dropdown').dropdown();
          $timeout(function() {
            angular.element('.planning.dropdown #planning-'+ $scope.index).trigger('click');
          }, 0);
        }
      });

      $scope.setPlanning = function(index) {
        $scope.selectedItem = $scope.items[index];
        $scope.index = index;
      };

    }]);
