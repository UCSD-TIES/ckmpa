var ref$, map, filter, find, flatten, app;
ref$ = require('prelude-ls'), map = ref$.map, filter = ref$.filter, find = ref$.find, flatten = ref$.flatten;
app = angular.module('ckmpa', ['ionic', 'ngResource', 'ngSanitize', 'ngAnimate', 'ckmpa.filters', 'ckmpa.services', 'ckmpa.directives', 'ckmpa.controllers']);
app.config(function($stateProvider, $urlRouterProvider){
  return $stateProvider.state('login', {
    url: '/',
    templateUrl: 'templates/login.html',
    controller: 'LoginController'
  }).state('select-mpa', {
    url: '/select-mpa',
    templateUrl: 'templates/select-mpa.html',
    controller: 'MpaController'
  }).state('select-transect', {
    url: '/select-transect/:mpaID/:mpaName',
    templateUrl: 'templates/select-transect.html',
    controller: 'MpaController'
  }).state('data-collection', {
    url: '/data-collection/:mpaID/:mpaName/:transectName',
    templateUrl: 'templates/data-collection.html',
    controller: 'DataController'
  }).state('finish', {
    url: '/finish/:mpaID',
    templateUrl: 'templates/finish.html',
    controller: 'DataController'
  }).state('/dashboard', {
    templateUrl: 'templates/dashboard.html',
    controller: 'HomeController'
  }).state('/volunteers', {
    templateUrl: 'templates/volunteers.html',
    controller: 'VolunteersController'
  }).state('/patrols', {
    templateUrl: 'templates/patrols.html',
    controller: 'PatrolsController'
  }).state('/mpas', {
    templateUrl: 'templates/mpas.html',
    controller: 'MpasController'
  }).state('/graphs', {
    templateUrl: 'templates/graphs.html',
    controller: 'GraphsController'
  }).state('/datasheets', {
    templateUrl: 'templates/datasheets.html',
    controller: 'DatasheetsController'
  }).state('/demo', {
    templateUrl: 'templates/demo.html',
    controller: 'DemoController'
  });
});
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