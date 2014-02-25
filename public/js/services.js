var app, mode, host;
app = angular.module('ckmpa.services', []);
mode = 'production';
host = mode === 'production' ? 'http://ckmpa.gopagoda.com/' : 'http://localhost/';
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
  var res, categories, fields, tallies, comments, datasheets;
  res = $resource(host + 'api/datasheets');
  categories = [];
  fields = [];
  tallies = [];
  comments = [];
  datasheets = res.query({}, function(){
    categories = flatten(
    map(function(it){
      return it.categories;
    })(
    datasheets));
    return fields = flatten(
    map(function(it){
      return it.fields;
    })(
    categories));
  });
  return {
    datasheets: datasheets.$promise,
    res: res,
    categories: function(){
      return categories;
    },
    fields: function(){
      return fields;
    },
    tallies: function(){
      return tallies;
    },
    comments: function(){
      return comments;
    },
    getTally: function(name, sub, cat){
      return find(function(x){
        return x.name === name && x.sub === sub && x.category === cat;
      })(
      tallies);
    },
    addTally: function(tally){
      return tallies.push(tally);
    }
  };
});
app.factory('Favorites', function(Datasheets){
  var favorites, datasheets;
  favorites = [];
  datasheets = Datasheets.datasheets.then(function(data){
    favorites.push(find(function(it){
      return it.name === "Recreation";
    })(
    Datasheets.fields()));
    return favorites.push(find(function(it){
      return it.name === "Offshore Recreation";
    })(
    Datasheets.fields()));
  });
  return {
    favorites: function(){
      return favorites;
    },
    add: function(field){
      if (!this.get(field) && favorites.length < 5) {
        return favorites.push(field);
      }
    },
    get: function(field){
      return find(function(x){
        return x === field;
      })(
      favorites);
    },
    'delete': function(name){
      var i;
      i = favorites.map(function(e){
        return e.name;
      }).indexOf(name);
      if (!(i < 0)) {
        return favorites.splice(i, 1);
      }
    }
  };
});