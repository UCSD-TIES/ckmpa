"use strict";
var app, LoginController, RegisterController, MpaController, DataController, SummaryController, FinishController;
app = angular.module('ckmpa.controllers', []);
LoginController = function($scope, $state, Auth, Flash){
  $scope.credentials = {
    username: '',
    password: ''
  };
  $scope.login = function(){
    return Auth.login($scope.credentials).success(function(){
      return $state.go('select-mpa');
    });
  };
  $scope.logout = function(){
    return Auth.logout().success(function(){
      return $state.go('login');
    });
  };
};
RegisterController = function($scope, $state, Users){
  $scope.credentials = {
    first_name: "",
    last_name: "",
    email: "",
    username: "",
    password: "",
    password_confirmation: ""
  };
  $scope.emailRegex = /\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b/;
  return $scope.register = function(){
    if ($scope.credentials.password === $scope.credentials.password_confirmation) {
      return Users.post($scope.credentials).success(function(){
        return $state.go('login');
      });
    } else {
      return console.log("NO");
    }
  };
};
MpaController = function($scope, $state, $stateParams, $ionicLoading, Mpas, Auth){
  var rightButtons, mpas;
  $scope.mpa_id = $stateParams.mpaId;
  $scope.mpa_name = $stateParams.mpaName;
  $scope.select_transect = function(mpa){
    return $state.go('select-transect', {
      mpaId: mpa.id,
      mpaName: mpa.name
    });
  };
  $scope.collect_data = function(transect){
    return $state.go('data-collection', {
      transectId: transect.id,
      transectName: encodeURIComponent(transect.name)
    });
  };
  rightButtons = [{
    content: 'Logout',
    type: 'button-small button-clear',
    tap: function(){
      return Auth.logout().success(function(){
        return $state.go('login');
      });
    }
  }];
  $scope.rightButtons = rightButtons;
  mpas = Mpas.query({}, function(){
    $scope.transects = _(mpas).pluck('transects').flatten().value();
    $scope.mpas = mpas;
    return $scope.loading.hide();
  });
  return $scope.loading = $ionicLoading.show({
    content: "<i class='icon ion-loading-a'></i> Loading",
    showDelay: 400
  });
};
DataController = function($scope, $state, $stateParams, $ionicLoading, $ionicModal, $timeout, Datasheets, Favorites, Auth){
  var time_interval, timer, saveTallies, datasheets, rightButtons;
  $scope.mpa_id = $stateParams.mpaID;
  $scope.mpa_name = $stateParams.mpaName;
  $scope.transect_name = decodeURIComponent($stateParams.transectName);
  $scope.comments = Datasheets.comments();
  $scope.favorites = [];
  $scope.categories = [];
  time_interval = 100000;
  saveTallies = function(){
    Datasheets.saveTallies();
    return timer = $timeout(saveTallies, time_interval);
  };
  saveTallies();
  $scope.stop = function(){
    return $timeout.cancel(timer);
  };
  $scope.submit = function(){
    $timeout.cancel(timer);
    return $state.go('summary');
  };
  $scope.addFavorite = function(field, sub){
    $scope.modalError = "";
    if (!Favorites.add(field, sub)) {
      return $scope.modalError = "Already Added to Favorites";
    }
  };
  $scope.deleteFavorite = function(name){
    $scope.modalError = "";
    return Favorites['delete'](name);
  };
  $scope.resize = function(){
    return $scope.$broadcast('scroll.resize');
  };
  datasheets = Datasheets.datasheets.then(function(data){
    $scope.categories = Datasheets.categories();
    $scope.favorites = Favorites.favorites();
    return $scope.loading.hide();
  });
  $ionicModal.fromTemplateUrl('partials/modal.html', function(modal){
    return $scope.modal = modal;
  }, {
    scope: $scope,
    animation: 'slide-in-up'
  });
  $scope.openModal = function(){
    return $scope.modal.show();
  };
  $scope.closeModal = function(){
    $scope.modal.hide();
    return Favorites.save();
  };
  $scope.$on('$destroy', function(){
    return $scope.modal.remove();
  });
  rightButtons = [{
    content: 'Logout',
    type: 'button-small button-clear',
    tap: function(){
      return Auth.logout().success(function(){
        return $state.go('login');
      });
    }
  }];
  $scope.rightButtons = rightButtons;
  return $scope.loading = $ionicLoading.show({
    content: "<i class='icon ion-loading-a'></i> Loading"
  });
};
SummaryController = function($scope, $state, $stateParams, $ionicLoading, Datasheets, Patrols, Auth){
  var datasheets, rightButtons;
  $scope.mpa_id = $stateParams.mpaID;
  $scope.mpa_name = $stateParams.mpaName;
  $scope.transect_name = $stateParams.transectName;
  $scope.categories = Datasheets.categories();
  $scope.tallies = Datasheets.tallies();
  $scope.comments = Datasheets.comments();
  $scope.getTally = function(field, subcategory){
    return Datasheets.getTally({
      field: field,
      subcategory: subcategory
    });
  };
  $scope.submit = function(){
    $scope.loading = $ionicLoading.show({
      content: "<i class='icon ion-loading-a'></i> Submitting"
    });
    return Patrols.post($stateParams.transectId, $scope.comments, $scope.tallies).success(function(data){
      $scope.loading.hide();
      $state.go('finish');
      return Datasheets.resetTallies();
    }).error(function(data, status, headers, config){
      return console.log(data);
    });
  };
  datasheets = Datasheets.datasheets.then(function(data){
    return $scope.categories = Datasheets.categories();
  });
  rightButtons = [{
    content: 'Logout',
    type: 'button-small button-clear',
    tap: function(){
      return Auth.logout().success(function(){
        return $state.go('login');
      });
    }
  }];
  return $scope.rightButtons = rightButtons;
};
FinishController = function($scope, $state, $stateParams, Auth){
  $scope.mpa_id = $stateParams.mpaID;
  $scope.mpa_name = $stateParams.mpaName;
  return $scope.logout = function(){
    return Auth.logout().success(function(){
      return $state.go('login');
    });
  };
};