angular.module("ckmpa",[
	'ngRoute',
	'ngResource',
	'ngSanitize',
	'ui.bootstrap',
	'ckmpa.filters',
	'ckmpa.services',
	'ckmpa.directives',
	'ckmpa.controllers'
])
.config(['$routeProvider',function($routeProvider){
	$routeProvider.when('/',{templateUrl:'templates/login.html', controller: 'LoginController'})
	$routeProvider.when('/dashboard',{templateUrl:'templates/dashboard.html', controller: 'HomeController'})
	$routeProvider.when('/volunteers',{templateUrl:'templates/volunteers.html', controller: 'VolunteersController'})
	$routeProvider.when('/patrols',{templateUrl:'templates/patrols.html', controller: 'PatrolsController'})
	$routeProvider.when('/mpas',{templateUrl:'templates/mpas.html', controller: 'MpasController'})
	$routeProvider.when('/graphs',{templateUrl:'templates/graphs.html', controller: 'GraphsController'})
	$routeProvider.when('/datasheets',{templateUrl:'templates/datasheets.html', controller: 'DatasheetsController'})

	$routeProvider.otherwise({redirectTo :'/'})
}]).config(function($httpProvider){

	var interceptor = function($rootScope,$location,$q,Flash){

	var success = function(response){
		return response
	}

	var error = function(response){
		if (response.status = 401){
			delete sessionStorage.authenticated
			$location.path('/')
			Flash.show(response.data.flash)

		}
		return $q.reject(response)

	}
		return function(promise){
			return promise.then(success, error)
		}
	}
	$httpProvider.responseInterceptors.push(interceptor)
}).run(function($rootScope,$http,$location, CSRF_TOKEN, Auth, Flash){
	$http.defaults.headers.common['csrf_token'] = CSRF_TOKEN;

	var routesThatRequireAuth = ['/patrols', '/dashboard'];

	$rootScope.$on('$routeChangeStart', function(event, next, current) {
	    if(_(routesThatRequireAuth).contains($location.path()) && !Auth.isLoggedIn()) {
	      $location.path('/login');
	      Flash.show("Please log in to continue.");
	    }
	  });
})