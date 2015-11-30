'use strict';

/* Controllers */

var patheControllers = angular.module('patheControllers', []);
var MAX_MOVIE_AMOUNT = 6;

patheControllers.controller('HomeCtrl', ['$scope', '$cookies', 'patheService',
  function($scope, $cookies, patheService)
  {
  	$scope.movies;
    $scope.theaters;
    $scope.days;
    $scope.loading;

    $scope.selectedDate = getCurrentDay();
    $scope.selectedTheater = $cookies.get('theater') ? JSON.parse($cookies.get('theater')) : { name: "Pathé Spuimarkt", alias: "spuimarkt"};
    $scope.selectedMovies = [];

    patheService.getDays().success(function (response) {
      $scope.days = response;
    });

    patheService.getTheaters().success(function (response) {
      $scope.theaters = response;
    });


    $scope.openModal = function() {
      $('.theater-modal').modal('show');
    }

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

    $scope.selectDate = function(date) {
      $scope.selectedDate = date;
    };

    $scope.selectTheater = function(theater) {
      $scope.selectedTheater = theater;

      // save theater in cookie
      $cookies.put('theater', JSON.stringify(theater));
      $scope.theaterButton = theater.name;

      $('.theater-modal').modal('hide');

      $scope.getMovies();
    };

    $scope.selectMovie = function(movie) {
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

    $scope.makePlanning = function() {
      $('.planning-modal').modal('setting', 'closable', false).modal('show');

      var data = {
        theaterId : $scope.selectedTheater.id,
        date : $scope.selectedDate,
        movies : $scope.selectedMovies
      };

      patheService.makePlanning(data).success(function (response) {
        console.dir(response);
      });
    }

    $scope.$watch('selectedDate', function() {
      $scope.getMovies();
    });

  }]);
