var ref$, map, filter, find, flatten, app;
ref$ = require('prelude-ls'), map = ref$.map, filter = ref$.filter, find = ref$.find, flatten = ref$.flatten;
app = angular.module('ckmpa', ['ionic', 'ngResource', 'ngSanitize', 'ngAnimate', 'ckmpa.filters', 'ckmpa.services', 'ckmpa.directives', 'ckmpa.controllers']);
app.config(function($stateProvider, $urlRouterProvider){
  $stateProvider.state('login', {
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
  }).state('summary', {
    url: '/summary/:mpaID',
    templateUrl: 'templates/summary.html',
    controller: 'DataController'
  }).state('finish', {
    url: '/finish/:mpaID',
    templateUrl: 'templates/finish.html',
    controller: 'DataController'
  });
  return $urlRouterProvider.otherwise('/');
});
app.config([
  '$httpProvider', function($httpProvider){
    return $httpProvider.defaults.useXDomain = true;
  }
]);
/*
app.run (($rootScope, $http, $location, CSRF_TOKEN, Auth, Flash) ->
  $http.defaults.headers.common.'csrf_token' = CSRF_TOKEN
  routesThatRequireAuth = ['/patrols', '/dashboard']
  $rootScope.$on '$routeChangeStart', (event, next, current) ->
      if ((_ routesThatRequireAuth).contains $location.path!) && not Auth.isLoggedIn!
        $location.path '/login'
        Flash.show 'Please log in to continue.')*/