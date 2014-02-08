var ref$, map, filter, find, flatten, app;
ref$ = require('prelude-ls'), map = ref$.map, filter = ref$.filter, find = ref$.find, flatten = ref$.flatten;
app = angular.module('ckmpa', ['ngRoute', 'ngResource', 'ngSanitize', 'ngAnimate', 'ui.bootstrap', 'ckmpa.filters', 'ckmpa.services', 'ckmpa.directives', 'ckmpa.controllers']);
app.config([
  '$routeProvider', '$locationProvider', function($routeProvider, $locationProvider){
    $routeProvider.when('/', {
      templateUrl: 'templates/login.html',
      controller: 'LoginController'
    });
    $routeProvider.when('/select-mpa', {
      templateUrl: 'templates/select-mpa.html',
      controller: 'MpaController'
    });
    $routeProvider.when('/select-transect/:mpaID/:mpaName', {
      templateUrl: 'templates/select-transect.html',
      controller: 'MpaController'
    });
    $routeProvider.when('/data-collection/:mpaID/:transectName', {
      templateUrl: 'templates/data-collection.html',
      controller: 'DataController'
    });
    $routeProvider.when('/finish/:mpaID', {
      templateUrl: 'templates/finish.html',
      controller: 'DataController'
    });
    $routeProvider.when('/dashboard', {
      templateUrl: 'templates/dashboard.html',
      controller: 'HomeController'
    });
    $routeProvider.when('/volunteers', {
      templateUrl: 'templates/volunteers.html',
      controller: 'VolunteersController'
    });
    $routeProvider.when('/patrols', {
      templateUrl: 'templates/patrols.html',
      controller: 'PatrolsController'
    });
    $routeProvider.when('/mpas', {
      templateUrl: 'templates/mpas.html',
      controller: 'MpasController'
    });
    $routeProvider.when('/graphs', {
      templateUrl: 'templates/graphs.html',
      controller: 'GraphsController'
    });
    $routeProvider.when('/datasheets', {
      templateUrl: 'templates/datasheets.html',
      controller: 'DatasheetsController'
    });
    return $routeProvider.when('/demo', {
      templateUrl: 'templates/demo.html',
      controller: 'DemoController'
    });
  }
]);
app.run(function($rootScope, $http, $location, CSRF_TOKEN, Auth, Flash){
  var routesThatRequireAuth;
  $http.defaults.headers.common['csrf_token'] = CSRF_TOKEN;
  routesThatRequireAuth = ['/patrols', '/dashboard'];
  return $rootScope.$on('$routeChangeStart', function(event, next, current){
    if (_(routesThatRequireAuth).contains($location.path()) && !Auth.isLoggedIn()) {
      $location.path('/login');
      return Flash.show('Please log in to continue.');
    }
  });
});