(function () {
  "use strict";
  var app = angular.module('ckmpa.controllers', []);

  app.controller('LoginController', function ($scope, $state, $ionicLoading, $ionicPopup, Auth) {
    $scope.credentials = {
      username: '',
      password: ''
    };

    $scope.login = function () {
      $ionicLoading.show({
        template: "<i class='icon ion-loading-a'></i> Signing In",
        showDelay: 500
      });

      Auth.login($scope.credentials).success(function () {
        $ionicLoading.hide();
        $state.go('select-transect');
      }).error(function (response) {
        $ionicLoading.hide();
        $ionicPopup.alert({
          title: 'Error',
          template: response.error.message
        });
      });
    };

  });

  app.controller('RegisterController', function ($scope, $state, $ionicPopup, Users) {
    $scope.credentials = {
      first_name: "",
      last_name: "",
      email: "",
      username: "",
      password: "",
      password_confirmation: ""
    };

    $scope.emailRegex = /\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b/;

    $scope.register = function () {
      Users.post($scope.credentials).success(function () {
        $state.go('login');
        $ionicPopup.alert({
          title: 'Successfully Registered!',
          template: 'Please wait for an adminstrator to confirm you.'
        });
      });
    };
  });

  app.controller('MpaController', function ($scope, $state, $stateParams, $ionicLoading, $ionicScrollDelegate, Mpas, Auth) {
    $scope.collect_data = function (mpa, transect) {
      $state.go('data-collection', {
        mpaId: mpa.id,
        mpaName: mpa.name,
        transectId: transect.id,
        transectName: encodeURIComponent(transect.name)
      });
    };

    $scope.logout = function () {
      Auth.logout().then(function () {
        $state.go('login');
      });
    };

    var mpas = Mpas.query({}, function () {
      $scope.mpas = mpas;
      $ionicLoading.hide();
    });

    $scope.resize = function () {
      $ionicScrollDelegate.resize();
    };

    $ionicLoading.show({
      template: "<i class='icon ion-loading-a'></i> Loading",
      showDelay: 500
    });
  });

  app.controller('DataController', function ($scope, $state, $stateParams, $ionicLoading, $ionicModal, $ionicScrollDelegate, $timeout, toastr, Datasheets, Favorites, Auth) {
    var time_interval, timer, datasheets;
    $scope.mpa_id = $stateParams.mpaID;
    $scope.mpa_name = $stateParams.mpaName;
    $scope.transect_name = decodeURIComponent($stateParams.transectName);
    $scope.comments = Datasheets.comments();
    $scope.favorites = [];
    $scope.categories = [];
    $scope.activeFavGroup = {};
    time_interval = 100000;

    (function saveTallies() {
      Datasheets.saveTallies();
      timer = $timeout(saveTallies, time_interval);
    })();

    $scope.stop = function () {
      $timeout.cancel(timer);
    };

    $scope.submit = function () {
      $timeout.cancel(timer);
      $state.go('summary');
    };

    $scope.addFavorite = function (field, sub) {
      var fav = Favorites.add(field, sub);
      toastr.success(fav.name, 'Added to Favorites', {
        positionClass: "toast-bottom-full-width",
        timeOut: 3000
      });
    };

    $scope.deleteFavorite = function (fav) {
      Favorites['delete'](fav);
      toastr.info(fav.name, 'Deleted from Favorites', {
        positionClass: "toast-bottom-full-width",
        timeOut: 3000
      });
    };

    $scope.alreadyAdded = function (sub) {
      return function (item) {
        if (!sub) {
          return !_.some($scope.favorites, function (fav) {
            return fav.field.name === item.name;
          });
        } else {
          return !_.some($scope.favorites, function (fav) {
            return fav.field.name === item.name && fav.subcategory.name === sub.name;
          });
        }
      };
    };

    $scope.resetTallies = function () {
      $state.reload();
      $scope.$broadcast("resetTallies");
      $scope.comments = {};
      Datasheets.resetTallies();
    };

    $scope.resize = function () {
      $ionicScrollDelegate.resize();
    };

    datasheets = Datasheets.datasheets.then(function () {
      $scope.categories = Datasheets.categories();
      $scope.favorites = Favorites.favorites();
      $ionicLoading.hide();
    });

    $ionicModal.fromTemplateUrl('partials/modal.html', function (modal) {
      $scope.modal = modal;
    }, {
      scope: $scope,
      animation: 'slide-in-up'
    });

    $scope.openModal = function () {
      $scope.modal.show();
    };

    $scope.$on('modal.hidden', function () {
      $scope.activeFavGroup = {};
      Favorites.save();
    });

    $scope.closeModal = function () {
      $scope.modal.hide();
    };

    $scope.$on('$destroy', function () {
      $scope.modal.remove();
    });

    $ionicLoading.show({
      template: "<i class='icon ion-loading-a'></i> Loading"
    });

    $scope.logout = function () {
      Auth.logout().then(function () {
        $state.go('login');
      });
    };
  });

  app.controller('SummaryController', function ($scope, $state, $stateParams, $ionicLoading, $ionicPopup, Datasheets, Patrols, Auth) {
    var datasheets;
    $scope.mpa_id = $stateParams.mpaId;
    $scope.mpa_name = $stateParams.mpaName;
    $scope.transect_name = $stateParams.transectName;
    $scope.categories = Datasheets.categories();
    $scope.tallies = Datasheets.tallies();
    $scope.comments = Datasheets.comments();

    $scope.getTally = function (field, subcategory) {
      return Datasheets.getTally({
        field: field,
        subcategory: subcategory
      });
    };

    $scope.submit = function () {
      var emptyTallies = _.every($scope.tallies, function (t) {
        if (t.field.type === "number") {
          return t.val === 0;
        } else {
          return true;
        }
      });

      if (emptyTallies) {
        $ionicPopup.confirm({
          title: 'The tallies seem to be empty.',
          template: "Are you sure you want to submit?",
          okType: 'button-energized'
        }).then(function (res) {
          if (res) {
            submit();
          }
        });
      } else {
        submit();
      }

      function submit() {
        $ionicLoading.show({
          template: "<i class='icon ion-loading-a'></i> Submitting",
          showDelay: 500
        });

        Patrols.post($stateParams.transectId, $scope.comments, $scope.tallies).success(function () {
          $ionicLoading.hide();
          $state.go('finish');
          Datasheets.resetTallies();
        }).error(function (response) {
          $ionicLoading.hide();
          $ionicPopup.alert({
            title: 'Error',
            template: response.error.message
          });
          $state.go('login');
        });
      }
    };

    datasheets = Datasheets.datasheets.then(function () {
      $scope.categories = Datasheets.categories();
    });

    $scope.logout = function () {
      Auth.logout().then(function () {
        $state.go('login');
      });
    };
  });

  app.controller('FinishController', function ($scope, $state, $stateParams, Auth) {
    $scope.mpa_id = $stateParams.mpaId;
    $scope.mpa_name = $stateParams.mpaName;

    $scope.logout = function () {
      Auth.logout().then(function () {
        $state.go('login');
      });
    };
  });

}());
