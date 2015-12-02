'use strict';

/* Services */

var patheServices = angular.module('patheServices', []);
var urlBase = 'http://localhost/Patheplanner/app';


patheServices.factory('patheService', ['$http', function ($http) {

    var patheService = {};

    patheService.getDays = function() {
    	return $http.get(urlBase + '/getDays');
    };

    patheService.getTheaters = function() {
      return $http.get(urlBase + '/getTheaters');
    };

    patheService.getMovies = function(theater, date) {
      return $http.get(urlBase + '/getMovies/'+ theater +'/' + date);
    };

    patheService.makePlanning = function(data) {
      return $http.post(urlBase + '/makePlanning', data);
    }

    return patheService;

}]);
