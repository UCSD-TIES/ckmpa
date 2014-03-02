var app, mode, host;
app = angular.module('ckmpa.services', []);
mode = 'production';
host = mode === 'production' ? 'http://ckmpa.gopagoda.com/' : 'http://localhost:8000/';
app.factory('Auth', function($http, $sanitize, Flash){
  var user, token, sanitizeCredentials, loginSuccess, loginError, logoutSuccess;
  sanitizeCredentials = function(credentials){
    return {
      username: $sanitize(credentials.username),
      password: $sanitize(credentials.password)
    };
  };
  loginSuccess = function(data, status, headers, config){
    user = data.user;
    token = data.token;
    sessionStorage.setItem('user', data.user);
    return sessionStorage.setItem('token', data.token);
  };
  loginError = function(response){
    return Flash.show(response.flash);
  };
  logoutSuccess = function(){
    user = null;
    return token = null;
  };
  return {
    login: function(credentials){
      var login;
      return login = $http.post(host + 'auth', sanitizeCredentials(credentials)).success(loginSuccess).error(loginError);
    },
    logout: function(){
      var logout;
      return logout = $http({
        method: 'delete',
        url: host + 'auth'
      }).success(logoutSuccess);
    },
    user: function(){
      return user || sessionStorage.getItem('user');
    },
    token: function(){
      return token || sessionStorage.getItem('token');
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
app.factory('Mpas', function($resource, Auth){
  return $resource(host + 'api/mpas/');
});
app.factory('Datasheets', function($resource, localStorageService){
  var res, categories, fields, comments, tallies, datasheets;
  res = $resource(host + 'api/datasheets', {});
  categories = [];
  fields = [];
  comments = [];
  if (!(tallies = localStorageService.get("tallies"))) {
    tallies = [];
  }
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
    getTally: function(tally){
      return _.find(tallies, function(x){
        if (x.subcategory && tally.subcategory) {
          return x.field.id === tally.field.id && x.subcategory.id === tally.subcategory.id;
        } else {
          return x.field.id === tally.field.id;
        }
      });
    },
    addTally: function(tally){
      return tallies.push(tally);
    },
    saveTallies: function(){
      return localStorageService.set('tallies', tallies);
    },
    resetTallies: function(){
      return localStorageService.remove('tallies');
    }
  };
});
app.factory('Favorites', function(Datasheets, localStorageService){
  var favorites, datasheets;
  if (!(favorites = localStorageService.get("favorites"))) {
    favorites = [];
    datasheets = Datasheets.datasheets.then(function(data){
      favorites.push({
        field: _(Datasheets.fields()).find({
          'name': "Recreation"
        }),
        subcategory: _.find(Datasheets.categories(), function(x){
          return _(x.fields).flatten().any({
            'name': 'Recreation'
          });
        }).subcategories[1],
        name: "Recreation (Sandy)"
      });
      favorites.push({
        field: _(Datasheets.fields()).find({
          'name': "Offshore Recreation"
        }),
        subcategory: _.find(Datasheets.categories(), function(x){
          return _(x.fields).flatten().any({
            'name': 'Offshore Recreation'
          });
        }).subcategories[0],
        name: "Offshore Recreation"
      });
      return localStorageService.set('favorites', favorites);
    });
  }
  return {
    favorites: function(){
      return favorites;
    },
    save: function(){
      return localStorageService.set('favorites', favorites);
    },
    add: function(field, sub){
      var fav;
      fav = {
        field: field,
        subcategory: sub,
        name: field.name + (sub ? " (" + sub.name + ")" : "")
      };
      if (!_.any(favorites, {
        name: fav.name
      })) {
        return favorites.push(fav);
      }
    },
    get: function(field){
      return find(function(x){
        return x === field;
      })(
      favorites);
    },
    'delete': function(fav){
      return _.pull(favorites, fav);
    }
  };
});
app.factory('Patrols', function($http){
  return {
    post: function(transect, comments, tallies){
      var data;
      data = {
        transect: transect,
        comments: comments.val != null || '',
        tallies: tallies
      };
      return $http.post(host + 'api/patrols', data);
    }
  };
});