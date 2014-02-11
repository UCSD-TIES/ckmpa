var app;
app = angular.module('ckmpa.services', []);
app.factory('Auth', function($http, $sanitize, Flash){
  var sanitizeCredentials, loginError, cacheSession, uncacheSession;
  sanitizeCredentials = function(credentials){
    return {
      username: $sanitize(credentials.username),
      password: $sanitize(credentials.password)
    };
  };
  loginError = function(response){
    return Flash.show(response.flash);
  };
  cacheSession = function(){
    return sessionStorage.setItem('authenticated', true);
  };
  uncacheSession = function(){
    return sessionStorage.removeItem('authenticated');
  };
  return {
    login: function(credentials){
      var login;
      login = $http.post('/api/auth', sanitizeCredentials(credentials));
      login.success(cacheSession);
      login.success(Flash.clear);
      login.error(loginError);
      return login;
    },
    logout: function(){
      var logout;
      logout = $http.get('/api/auth');
      logout.success(uncacheSession);
      return logout;
    },
    isLoggedIn: function(){
      return sessionStorage.getItem('authenticated');
    }
  };
});
app.factory('Flash', function($rootScope){
  return {
    show: function(message){
      return $rootScope.flash = message;
    },
    clear: function(){
      return $rootScope.flash = '';
    }
  };
});
app.factory('Users', function($resource){
  return $resource('/api/users/');
});
app.factory('Mpas', function($resource){
  return $resource('/api/mpas/');
});
app.factory('Datasheets', function($resource){
  return $resource('/api/datasheets');
});