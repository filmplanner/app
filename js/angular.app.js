'use strict';

/* App Module */

var patheApp = angular.module('patheApp', [
  'ngRoute',
  'ngCookies',
  'patheControllers',
  'patheServices',
  'angular-owl-carousel'
]);

patheApp.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
    $routeProvider.
      when('/home', {
        templateUrl: 'pages/home.html',
        controller: 'HomeCtrl'
      }).
      when('/planning/:id', {
        templateUrl: 'pages/result.html',
        controller: 'ResultCtrl'
      }).
      otherwise({
        redirectTo: '/home'
      });
      $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
      });
  }]);
