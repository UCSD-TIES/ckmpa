"use strict"

app = angular.module 'ckmpa', [
  'ionic'
  'LocalStorageModule'
  'ngResource'
  'ckmpa.filters'
  'ckmpa.services'
  'ckmpa.directives'
  'ckmpa.controllers'
]

app.run ($http, Auth) ->
  $http.defaults.headers.common["X-Auth-Token"] = Auth.token

app.config ($httpProvider, $stateProvider, $urlRouterProvider) ->
  $httpProvider.defaults.cache = true
  $httpProvider.defaults.useXDomain = true

  $stateProvider
    .state 'login', 
      url: '/'
      templateUrl: 'templates/login.html'
      controller: 'LoginController'
    
    .state 'select-mpa',
      url: '/select-mpa'
      templateUrl: 'templates/select-mpa.html'
      controller: 'MpaController'
    
    .state 'select-transect',
      url: '/select-transect/:mpaId/:mpaName'
      templateUrl: 'templates/select-transect.html'
      controller: 'MpaController'
    
    .state 'data-collection',
      url: '/data-collection/:mpaName/:transectId/:transectName'
      templateUrl: 'templates/data-collection.html'
      controller: 'DataController'
    
    .state 'summary',
      url: '/summary/:mpaID/:mpaName/:transectId/:transectName'
      templateUrl: 'templates/summary.html'
      controller: 'SummaryController'
    
    .state 'finish', 
      url: '/finish/:mpaID/:mpaName/:transectId/'
      templateUrl: 'templates/finish.html'
      controller: 'FinishController'
    

  $urlRouterProvider.otherwise '/'

/*
app.run (($rootScope, $http, $location, CSRF_TOKEN, Auth, Flash) ->
  $http.defaults.headers.common.'csrf_token' = CSRF_TOKEN
  routesThatRequireAuth = ['/patrols', '/dashboard']
  $rootScope.$on '$routeChangeStart', (event, next, current) ->
      if ((_ routesThatRequireAuth).contains $location.path!) && not Auth.isLoggedIn!
        $location.path '/login'
        Flash.show 'Please log in to continue.')*/