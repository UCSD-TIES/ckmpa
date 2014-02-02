angular.module('ckmpa.services',[])
.factory('Auth', function($http, $sanitize, CSRF_TOKEN, Flash){
	var sanitizeCredentials = function(credentials) {
		return {
			username: $sanitize(credentials.username),
			password: $sanitize(credentials.password),
			csrf_token: CSRF_TOKEN
		};
	};

	var loginError = function(response) {
		Flash.show(response.flash);
	};

	var cacheSession = function() {
		sessionStorage.setItem('authenticated', true);
	};

	var uncacheSession = function() {
		sessionStorage.removeItem('authenticated')
	};

	return {
		login: function(credentials) {
			var login = $http.post("/api/auth", sanitizeCredentials(credentials));
			login.success(cacheSession);
			login.success(Flash.clear);
			login.error(loginError);
			return login;
		},
		logout: function() {
			var logout = $http.get("/api/auth");
			logout.success(uncacheSession);
			return logout;
		},
		isLoggedIn: function() {
			return sessionStorage.getItem('authenticated');
		}
	}
})
.factory('Users', function($resource){
	return $resource("/api/users/")
})
.factory('Flash', function($rootScope){
	return {
		show: function(message){
			$rootScope.flash = message
		},
		clear: function(){
			$rootScope.flash = ""
		}
	}
})