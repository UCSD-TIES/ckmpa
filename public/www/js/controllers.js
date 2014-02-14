var app, LoginController, MpaController, DataController, SummaryController, FinishController;
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
  $scope.logout = function(){
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
DataController = function($scope, $state, $stateParams, Datasheets, $ionicSlideBoxDelegate, $ionicLoading){
  $scope.mpa_id = $stateParams.mpaID;
  $scope.mpa_name = $stateParams.mpaName;
  $scope.transect_name = $stateParams.transectName;
  $scope.getTally = function(name){
    return Datasheets.getTally(name);
  };
  $scope.categories = Datasheets.categories();
  $scope.fields = Datasheets.fields();
  $scope.tallies = Datasheets.tallies();
  $ionicSlideBoxDelegate.update();
  return $scope.rightButtons = [{
    content: 'Next',
    type: 'button-small button-clear',
    tap: function(){
      return $state.go('summary');
    }
  }];
};
SummaryController = function($scope, $state, $stateParams, Datasheets){
  $scope.mpa_id = $stateParams.mpaID;
  $scope.mpa_name = $stateParams.mpaName;
  $scope.transect_name = $stateParams.transectName;
  $scope.getTally = function(name){
    return Datasheets.getTally(name);
  };
  $scope.categories = Datasheets.categories();
  $scope.fields = Datasheets.fields();
  $scope.tallies = Datasheets.tallies();
  return $scope.submit = function(){
    return $state.go('finish');
  };
};
FinishController = function($scope, $state, $stateParams){};