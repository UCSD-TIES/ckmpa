(function () {
  "use strict";

  var app = angular.module('ckmpa.services', []);
  var host = "http://mpawatchsd.com/";

  app.factory('Auth', function ($http, $sanitize, Flash) {
    var user, token, sanitizeCredentials, loginSuccess, loginError, logoutSuccess;
    sanitizeCredentials = function (credentials) {
      return {
        username: $sanitize(credentials.username),
        password: $sanitize(credentials.password)
      };
    };

    loginSuccess = function (data) {
      user = data.user;
      token = data.token;
      sessionStorage.setItem('user', data.user);
      sessionStorage.setItem('token', data.token);
    };

    loginError = function (response) {
      Flash.show(response.flash);
    };

    logoutSuccess = function () {
      user = null;
      token = null;
    };

    return {
      login: function (credentials) {
        return $http.post(host + 'api/auth', sanitizeCredentials(credentials))
          .success(loginSuccess)
          .error(loginError);
      },

      logout: function () {
        return $http({
          method: 'delete',
          url: host + 'api/auth'
        }).success(logoutSuccess);
      },

      user: function () {
        return user || sessionStorage.getItem('user');
      },

      token: function () {
        return token || sessionStorage.getItem('token');
      }
    };
  });

  app.factory('Flash', function ($rootScope) {
    return {
      show: function (message) {
        $rootScope.flash = message;
      },

      clear: function () {
        $rootScope.flash = '';
      }
    };
  });

  app.factory('Users', function ($http, $sanitize) {
    function sanitizeCredentials (credentials) {
      return {
        first_name: $sanitize(credentials.first_name),
        last_name: $sanitize(credentials.last_name),
        email: $sanitize(credentials.email),
        username: $sanitize(credentials.username),
        password: $sanitize(credentials.password),
        password_confirmation: $sanitize(credentials.password_confirmation)
      };
    }

    return {
      post: function (credentials) {
        var clean_credentials = sanitizeCredentials(credentials);
        return $http.post(host + 'api/users', clean_credentials).success(function (data) {
          console.log(data);
        }).error(function (data) {
          console.log(data);
        });
      }
    };
  });
  
  app.factory('Mpas', function ($resource) {
    return $resource(host + 'api/mpas/');
  });
  
  app.factory('Datasheets', function ($resource, localStorageService) {
    var res, categories, fields, comments, tallies, datasheets;
    res = $resource(host + 'api/datasheets', {});
    categories = [];
    fields = [];
    comments = [];
    
    if (!(tallies = localStorageService.get("tallies"))) {
      tallies = [];
    }
    
    datasheets = res.query({}, function () {
      categories = _(datasheets).pluck('categories').flatten().value();
      fields = _(categories).pluck('fields').flatten().value();
    });
    
    return {
      datasheets: datasheets.$promise,
      res: res,
      categories: function () {
        return categories;
      },
      
      fields: function () {
        return fields;
      },
      
      tallies: function () {
        return tallies;
      },
      
      comments: function () {
        return comments;
      },
      
      getTally: function (tally) {
        return _.find(tallies, function (x) {
          if (x.subcategory && tally.subcategory) {
            return x.field.id === tally.field.id && x.subcategory.id === tally.subcategory.id;
          } else {
            return x.field.id === tally.field.id;
          }
        });
      },
      
      addTally: function (tally) {
        return tallies.push(tally);
      },
      
      saveTallies: function () {
        return localStorageService.set('tallies', tallies);
      },
      
      resetTallies: function () {
        return localStorageService.remove('tallies');
      }
    };
  });
  
  app.factory('Favorites', function (Datasheets, localStorageService) {
    var favorites, datasheets;
    
    if (!(favorites = localStorageService.get("favorites"))) {
      favorites = [];
      
      datasheets = Datasheets.datasheets.then(function () {
        favorites.push({
          field: _(Datasheets.fields()).find({
            'name': "On-Shore Recreation"
          }),
          
          subcategory: _.find(Datasheets.categories(), function (x) {
            return _(x.fields).flatten().any({
              'name': 'On-Shore Recreation'
            });
          }).subcategories[1],
          
          name: "On-Shore Recreation (Sandy)"
        });
        
        favorites.push({
          field: _(Datasheets.fields()).find({
            'name': "Off-Shore Recreation"
          }),
          
          subcategory: _.find(Datasheets.categories(), function (x) {
            return _(x.fields).flatten().any({
              'name': 'Off-Shore Recreation'
            });
          }).subcategories[0],
          
          name: "Off-Shore Recreation"
        });
        localStorageService.set('favorites', favorites);
      });
    }
    
    return {
      favorites: function () {
        return favorites;
      },
      
      save: function () {
        return localStorageService.set('favorites', favorites);
      },
      
      add: function (field, sub) {
        var fav = {
          field: field,
          subcategory: sub,
          name: field.name + (sub ? " (" + sub.name + ")" : "")
        };
        if (!_.any(favorites, {
          name: fav.name
        })) {
          favorites.push(fav);
        }
      },
      'delete': function (fav) {
        _.pull(favorites, fav);
      }
    };
  });
  
  app.factory('Patrols', function ($http) {
    return {
      post: function (transect, comments, tallies) {
        var data = {
          transect: transect,
          comments: comments.val !== null || '',
          tallies: tallies
        };
        
        return $http.post(host + 'api/patrols', data);
      }
    };
  });
  
}());