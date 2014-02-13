var app, LoginController, MpaController, DataController;
app = angular.module('ckmpa.controllers', []);
LoginController = function($scope, $sanitize, $location, Auth, Flash){
  var rightButtons;
  $scope.credentials = {
    username: '',
    password: ''
  };
  rightButtons = [{
    content: 'Logout',
    type: 'button-small button-clear'
  }];
  $scope.rightButtons = rightButtons;
  $scope.login = function(){
    return Auth.login($scope.credentials).success(function(){
      return $location.path('/select-mpa');
    });
  };
  return $scope.logout = function(){
    return Auth.logout().success(function(){
      return $location.path('/');
    });
  };
};
MpaController = function($scope, Mpas, $stateParams){
  var mpas;
  $scope.mpa_id = $stateParams.mpaID;
  $scope.mpa_name = $stateParams.mpaName;
  return mpas = Mpas.query({}, function(){
    $scope.transects = flatten(
    map(function(it){
      return it.transects;
    })(
    mpas));
    return $scope.mpas = mpas;
  });
};
DataController = function($scope, $state, $stateParams, Datasheets, $ionicSlideBoxDelegate){
  var next, datasheets, rightButtons;
  $scope.confirm = false;
  $scope.mpa_id = $stateParams.mpaID;
  $scope.mpa_name = $stateParams.mpaName;
  $scope.transect_name = $stateParams.transectName;
  $scope.tallies = [];
  next = function(){
    return $state.go('summary');
  };
  $scope.submit = function(){
    return $state.go('finish');
  };
  datasheets = Datasheets.query({}, function(){
    $scope.categories = flatten(
    map(function(it){
      return it.categories;
    })(
    datasheets));
    $scope.fields = flatten(
    map(function(it){
      return it.fields;
    })(
    $scope.categories));
    return $ionicSlideBoxDelegate.update();
  });
  rightButtons = [{
    content: 'Next',
    type: 'button-small button-clear',
    tap: next
  }];
  return $scope.rightButtons = rightButtons;
};