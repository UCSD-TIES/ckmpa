app = angular.module 'ckmpa.controllers', []

LoginController = ($scope, $sanitize, $location, Auth, Flash) ->
  $scope.credentials = {
    username: ''
    password: ''
  }
  rightButtons = [
    {
      content: 'Logout'
      type:'button-small button-clear'
    }
  ]

  $scope.rightButtons = rightButtons

  $scope.login = -> (Auth.login $scope.credentials).success (-> $location.path '/select-mpa')
  $scope.logout = -> Auth.logout!.success (-> $location.path '/')

HomeController = ($scope, $location) ->

ModalInstanceCtrl = ($scope, $modalInstance, items) ->
  $scope.items = items
  $scope.selected = {item: $scope.items.0}
  $scope.ok = -> $modalInstance.close $scope.selected.item
  $scope.cancel = -> $modalInstance.dismiss 'cancel'

VolunteersController = ($scope, $location, $modal, Users) ->
  users = Users.query!
  $scope.users = users
  $scope.edit = -> alert 'test'
  $scope.open = (id) ->
    user = void
    users.forEach ((element, index, array) -> user := element if element.id is id)
    modalInstance = $modal.open {
      templateUrl: 'templates/modal.html'
      controller: ModalInstanceCtrl
      resolve: {
        type: -> 'user'
        items: -> user
      }
    }
    modalInstance.result.then ((selectedItem) -> $scope.selected = selectedItem), ->

ModalInstanceCtrl = ($scope, $modalInstance, type, items) ->
  $scope.items = items
  $scope.type = type
  $scope.ok = -> $modalInstance.close $scope.selected.item
  $scope.cancel = -> $modalInstance.dismiss 'cancel'

MpaController = ($scope, Mpas, $stateParams) ->
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName

  mpas = Mpas.query {}, ->
    $scope.transects = mpas |> map (.transects) |> flatten
    $scope.mpas = mpas
    

DataController = ($scope, $location, $stateParams, Datasheets, $ionicSlideBoxDelegate) ->
  $scope.confirm = false
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName
  $scope.transect_name = $stateParams.transectName


  $scope.submit = ->
    $location.path '/finish/'+$stateParams.mpaID
  datasheets = Datasheets.query {}, ->
    $scope.categories = datasheets |> map (.categories)  |> flatten
    $ionicSlideBoxDelegate.update!