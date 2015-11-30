'use strict';

/* App Module */

var patheApp = angular.module('patheApp', [
  'ngRoute',
  'ngCookies',
  'patheControllers',
  'patheServices',
  'angular-owl-carousel'
]);

patheApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/home', {
        templateUrl: 'pages/home.html',
        controller: 'HomeCtrl'
      }).
      otherwise({
        redirectTo: '/home'
      });
  }]);
