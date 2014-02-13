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

MpaController = ($scope, Mpas, $stateParams) ->
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName

  mpas = Mpas.query {}, ->
    $scope.transects = mpas |> map (.transects) |> flatten
    $scope.mpas = mpas

DataController = ($scope, $state, $stateParams, Datasheets, $ionicSlideBoxDelegate) ->
  $scope.confirm = false
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName
  $scope.transect_name = $stateParams.transectName
  $scope.tallies = [];

  next = ->
    $state.go 'summary'

  $scope.submit = ->
    $state.go 'finish'

  datasheets = Datasheets.query {}, ->
    $scope.categories = datasheets |> map (.categories)  |> flatten
    $scope.fields = $scope.categories |> map (.fields) |> flatten
    $ionicSlideBoxDelegate.update!

  rightButtons = [
    {
      content: 'Next'
      type:'button-small button-clear'
      tap: next
    }
  ]

  $scope.rightButtons = rightButtons




