var app, mode, host;
app = angular.module('ckmpa.services', []);
mode = 'mobile';
host = mode === 'mobile' ? 'http://ckmpa.gopagoda.com/' : 'localhost';
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
      login = $http.post(host + 'api/auth', sanitizeCredentials(credentials));
      login.success(cacheSession);
      login.success(Flash.clear);
      login.error(loginError);
      return login;
    },
    logout: function(){
      var logout;
      logout = $http.get(host + 'api/auth');
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
  return $resource(host + 'api/users/');
});
app.factory('Mpas', function($resource){
  return $resource(host + 'api/mpas/');
});
app.factory('Datasheets', function($resource){
  var res, categories, fields, tallies, datasheets;
  res = $resource(host + 'api/datasheets');
  categories = [];
  fields = [];
  tallies = [];
  datasheets = res.query({}, function(){
    var f;
    categories = flatten(
    map(function(it){
      return it.categories;
    })(
    datasheets));
    fields = flatten(
    map(function(it){
      return it.fields;
    })(
    categories));
    return tallies = (function(){
      var i$, ref$, len$, results$ = [];
      for (i$ = 0, len$ = (ref$ = fields).length; i$ < len$; ++i$) {
        f = ref$[i$];
        results$.push({
          "name": f.name,
          "val": (fn$())
        });
      }
      return results$;
      function fn$(){
        switch (f.type) {
        case 'number':
          return 0;
        case 'checkbox':
          return 'No';
        case 'radio':
          return f.options[0].name;
        }
      }
    }());
  });
  return {
    datasheets: datasheets.$promise,
    categories: function(){
      return categories;
    },
    fields: function(){
      return fields;
    },
    tallies: function(){
      return tallies;
    },
    getTally: function(name){
      return find(function(it){
        return it.name === name;
      })(
      tallies);
    }
  };
});