'use strict';

var MAX_MOVIE_AMOUNT = 5;
var DEFAULT_THEATER = { id: 11, name: "Pathé Spuimarkt", alias: "spuimarkt"};

/* Controllers */
var patheControllers = angular.module('patheControllers', []);

patheControllers.controller('HomeCtrl', ['$scope', '$location', '$cookies', 'patheService',
  function($scope, $location, $cookies, patheService)
  {
  	$scope.movies;
    $scope.theaters;
    $scope.days;
    $scope.loading;

    $scope.selectedDate = getCurrentDay();
    $scope.selectedTheater = $cookies.get('theater') ? JSON.parse($cookies.get('theater')) : DEFAULT_THEATER;
    $scope.selectedMovies = [];

    // Retrieve data
    patheService.getDays().success(function (response) {
      $scope.days = response;
    });

    patheService.getTheaters().success(function (response) {
      $scope.theaters = response;
    });


    $scope.getMovies = function()
    {
      if($scope.selectedTheater) {
        // set loader
        $scope.loading = true;
        $scope.movies = [];
        $scope.selectedMovies = [];

        // get movies by theater and date
        patheService.getMovies($scope.selectedTheater.alias, $scope.selectedDate).success(function (response) {
          $scope.movies = response;
          $scope.loading = false;
        });
      }
    };

    $scope.selectDate = function(date)
    {
      $scope.selectedDate = date;
    };

    $scope.selectTheater = function(theater)
    {
      $scope.selectedTheater = theater;

      // save theater in cookie
      $cookies.put('theater', JSON.stringify(theater));
      $scope.theaterButton = theater.name;

      $('.theater-modal').modal('hide');

      $scope.getMovies();
    };

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
        theaterId : $scope.selectedTheater.id,
        date : $scope.selectedDate,
        movies : $scope.selectedMovies
      };

      patheService.makePlanning(data).success(function (response) {
        var id = response;
        $location.path('planning/' + id);
        $('.planning-modal').modal('hide');
      });
    }

    $scope.openModal = function() {
      $('.theater-modal').modal('show');
    }

    $scope.$watch('selectedDate', function()
    {
      $scope.getMovies();
    });

  }]);


  patheControllers.controller('ResultCtrl', ['$scope', '$routeParams', '$timeout', 'patheService',
    function($scope, $routeParams, $timeout, patheService)
    {
      $scope.id = $routeParams.id;
      $scope.items;
      $scope.selectedItem;

      patheService.getResult($scope.id).success(function (response) {
        // set data
        $scope.items = JSON.parse(response.data);
        $scope.selectedItem = $scope.items[0];

        // set dropdown list
        $('.planning.dropdown').dropdown();
        $timeout(function() {
          angular.element('.planning.dropdown .item:first').trigger('click');
        }, 0);
      });

      $scope.setPlanning = function(index) {
        $scope.selectedItem = $scope.items[index];
      };

    }]);
