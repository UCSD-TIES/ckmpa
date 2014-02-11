var app, LoginController, HomeController, ModalInstanceCtrl, VolunteersController, MpaController, DataController;
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
  return $scope.logout = function(){
    return Auth.logout().success(function(){
      return $location.path('/');
    });
  };
};
HomeController = function($scope, $location){};
ModalInstanceCtrl = function($scope, $modalInstance, items){
  $scope.items = items;
  $scope.selected = {
    item: $scope.items[0]
  };
  $scope.ok = function(){
    return $modalInstance.close($scope.selected.item);
  };
  return $scope.cancel = function(){
    return $modalInstance.dismiss('cancel');
  };
};
VolunteersController = function($scope, $location, $modal, Users){
  var users;
  users = Users.query();
  $scope.users = users;
  $scope.edit = function(){
    return alert('test');
  };
  return $scope.open = function(id){
    var user, modalInstance;
    user = void 8;
    users.forEach(function(element, index, array){
      if (element.id === id) {
        return user = element;
      }
    });
    modalInstance = $modal.open({
      templateUrl: 'templates/modal.html',
      controller: ModalInstanceCtrl,
      resolve: {
        type: function(){
          return 'user';
        },
        items: function(){
          return user;
        }
      }
    });
    return modalInstance.result.then(function(selectedItem){
      return $scope.selected = selectedItem;
    }, function(){});
  };
};
ModalInstanceCtrl = function($scope, $modalInstance, type, items){
  $scope.items = items;
  $scope.type = type;
  $scope.ok = function(){
    return $modalInstance.close($scope.selected.item);
  };
  return $scope.cancel = function(){
    return $modalInstance.dismiss('cancel');
  };
};
MpaController = function($scope, Mpas, $routeParams){
  var mpas;
  $scope.mpa_id = $routeParams.mpaID;
  $scope.mpa_name = $routeParams.mpaName;
  return mpas = Mpas.query({}, function(){
    $scope.transects = flatten(
    map(function(it){
      return it.transects;
    })(
    mpas));
    return $scope.mpas = mpas;
  });
};
DataController = function($scope, $location, $routeParams, Datasheets){
  var datasheets;
  $scope.confirm = false;
  $scope.mpa_id = $routeParams.mpaID;
  $scope.mpa_name = $routeParams.mpaName;
  $scope.transect_name = $routeParams.transectName;
  $scope.submit = function(){
    return $location.path('/finish/' + $routeParams.mpaID);
  };
  return datasheets = Datasheets.query({}, function(){
    return $scope.categories = flatten(
    map(function(it){
      return it.categories;
    })(
    datasheets));
  });
};