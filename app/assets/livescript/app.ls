{map, filter, find, flatten} = require 'prelude-ls'
app = angular.module 'ckmpa', [
  'ionic'
  'ngResource'
  'ngSanitize'
  'ngAnimate'
  'ckmpa.filters'
  'ckmpa.services'
  'ckmpa.directives'
  'ckmpa.controllers'
]

app.config ($stateProvider, $urlRouterProvider) ->
  $stateProvider
    .state 'login', {
      url: '/'
      templateUrl: 'templates/login.html'
      controller: 'LoginController'
    }
    .state 'select-mpa', {
      url: '/select-mpa'
      templateUrl: 'templates/select-mpa.html'
      controller: 'MpaController'
    }
    .state 'select-transect', {
      url: '/select-transect/:mpaID/:mpaName'
      templateUrl: 'templates/select-transect.html'
      controller: 'MpaController'
    }
    .state 'data-collection', {
      url: '/data-collection/:mpaID/:mpaName/:transectName'
      templateUrl: 'templates/data-collection.html'
      controller: 'DataController'
    }
    .state 'finish', {
      url: '/finish/:mpaID'
      templateUrl: 'templates/finish.html'
      controller: 'DataController'
    }
    .state '/dashboard', {
      templateUrl: 'templates/dashboard.html'
      controller: 'HomeController'
    }
    .state '/volunteers', {
      templateUrl: 'templates/volunteers.html'
      controller: 'VolunteersController'
    }
    .state '/patrols', {
      templateUrl: 'templates/patrols.html'
      controller: 'PatrolsController'
    }
    .state '/mpas', {
      templateUrl: 'templates/mpas.html'
      controller: 'MpasController'
    }
    .state '/graphs', {
      templateUrl: 'templates/graphs.html'
      controller: 'GraphsController'
    }
    .state '/datasheets', {
      templateUrl: 'templates/datasheets.html'
      controller: 'DatasheetsController'
    }
    .state '/demo', {
      templateUrl: 'templates/demo.html'
      controller: 'DemoController'
    }

  $urlRouterProvider.otherwise('/');

app.config ['$httpProvider', ($httpProvider) ->
  $httpProvider.defaults.useXDomain = true;
]

/*
app.run (($rootScope, $http, $location, CSRF_TOKEN, Auth, Flash) ->
  $http.defaults.headers.common.'csrf_token' = CSRF_TOKEN
  routesThatRequireAuth = ['/patrols', '/dashboard']
  $rootScope.$on '$routeChangeStart', (event, next, current) ->
      if ((_ routesThatRequireAuth).contains $location.path!) && not Auth.isLoggedIn!
        $location.path '/login'
        Flash.show 'Please log in to continue.')*/