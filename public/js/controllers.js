var app, LoginController, MpaController, DataController, SummaryController, FinishController;
app = angular.module('ckmpa.controllers', []);
LoginController = function($scope, $sanitize, $location, Auth, Flash){
  $scope.credentials = {
    username: '',
    password: ''
  };
  $scope.login = function(){
    return Auth.login($scope.credentials).success(function(){
      return $location.path('/select-mpa');
    });
  };
  $scope.logout = function(){
    return Auth.logout().success(function(){
      return $location.path('/');
    });
  };
};
MpaController = function($scope, Mpas, $stateParams){
  var rightButtons, mpas;
  $scope.mpa_id = $stateParams.mpaID;
  $scope.mpa_name = $stateParams.mpaName;
  rightButtons = [{
    content: 'Logout',
    type: 'button-small button-clear'
  }];
  $scope.rightButtons = rightButtons;
  return mpas = Mpas.query({}, function(){
    $scope.transects = flatten(
    map(function(it){
      return it.transects;
    })(
    mpas));
    return $scope.mpas = mpas;
  });
};
DataController = function($scope, $state, $stateParams, $ionicLoading, $ionicModal, $timeout, Datasheets, Favorites){
  var time_interval, timer, saveTallies, datasheets, rightButtons;
  $scope.mpa_id = $stateParams.mpaID;
  $scope.mpa_name = $stateParams.mpaName;
  $scope.transect_name = $stateParams.transectName;
  $scope.comments = Datasheets.comments();
  $scope.favorites = [];
  $scope.categories = [];
  time_interval = 100000;
  saveTallies = function(){
    Datasheets.saveTallies();
    return timer = $timeout(saveTallies, time_interval);
  };
  timer = $timeout(saveTallies, time_interval);
  $scope.stop = function(){
    return $timeout.cancel(timer);
  };
  $scope.submit = function(){
    $timeout.cancel(timer);
    return $state.go('summary');
  };
  $scope.addFavorite = function(name){
    $scope.modalError = "";
    if (!Favorites.add(name)) {
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
    type: 'button-small button-clear'
  }];
  $scope.rightButtons = rightButtons;
  return $scope.loading = $ionicLoading.show({
    content: "<i class='icon ion-loading-a'></i> Loading"
  });
};
SummaryController = function($scope, $state, $stateParams, Datasheets){
  var datasheets, rightButtons;
  $scope.mpa_id = $stateParams.mpaID;
  $scope.mpa_name = $stateParams.mpaName;
  $scope.transect_name = $stateParams.transectName;
  $scope.categories = Datasheets.categories();
  $scope.tallies = Datasheets.tallies();
  $scope.comments = Datasheets.comments();
  $scope.getTally = function(name, sub, cat){
    return Datasheets.getTally(name, sub, cat);
  };
  $scope.submit = function(){
    $state.go('finish');
    return Datasheets.resetTallies();
  };
  datasheets = Datasheets.datasheets.then(function(data){
    return $scope.categories = Datasheets.categories();
  });
  rightButtons = [{
    content: 'Logout',
    type: 'button-small button-clear'
  }];
  return $scope.rightButtons = rightButtons;
};
FinishController = function($scope, $state, $stateParams){};