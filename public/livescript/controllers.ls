app = angular.module 'ckmpa.controllers', []

LoginController = ($scope, $sanitize, $location, Auth, Flash) !->
  $scope.credentials =
    username: ''
    password: ''

  $scope.login = -> Auth.login $scope.credentials .success -> $location.path '/select-mpa'
  $scope.logout = -> Auth.logout!.success -> $location.path '/'

MpaController = ($scope, Mpas, $stateParams) ->
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName

  rightButtons =
    content: 'Logout'
    type:'button-small button-clear'
    ...

  $scope.rightButtons = rightButtons

  mpas = Mpas.query {}, ->
    $scope.transects = mpas |> map (.transects) |> flatten
    $scope.mpas = mpas

DataController = ($scope, $state, $stateParams, $ionicLoading, $ionicModal, Datasheets, Favorites) ->
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName
  $scope.transect_name = $stateParams.transectName
  $scope.comments = Datasheets.comments!
  # $scope.favorites = Favorites.favorites!
  
  $scope.submit = -> $state.go 'summary'
  $scope.getTally = (name) -> Datasheets.getTally(name)
  $scope.getFavorite = (name) -> Favorites.get(name)
  $scope.addFavorite = (name) -> Favorites.add(name)
  $scope.deleteFavorite = (name) -> Favorites.delete(name)
  $scope.resize = -> $scope.$broadcast('scroll.resize')

  $ionicModal.fromTemplateUrl 'partials/modal.html', 
    (modal) -> $scope.modal = modal,
    scope: $scope
    animation: 'slide-in-up'

  $scope.openModal = ->
    $scope.modal.show!

  $scope.closeModal = ->
    $scope.modal.hide!

  $scope.$on '$destroy', ->
    $scope.modal.remove!

  datasheets = Datasheets.datasheets.then (data) ->
    $scope.categories = Datasheets.categories!
    $scope.favorites = Favorites.favorites!
    $scope.loading.hide!

  rightButtons =
    content: 'Logout'
    type:'button-small button-clear'
    ...

  $scope.rightButtons = rightButtons

  $scope.loading = $ionicLoading.show do
    content: "<i class='icon ion-loading-c'></i> Loading"

SummaryController = ($scope, $state, $stateParams, Datasheets) ->
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName
  $scope.transect_name = $stateParams.transectName
  $scope.getTally = (name) -> Datasheets.getTally(name)
  $scope.categories = Datasheets.categories!
  $scope.fields = Datasheets.fields!
  $scope.tallies = Datasheets.tallies!
  $scope.comments = Datasheets.comments!

  $scope.submit = -> $state.go 'finish'

  rightButtons =
    content: 'Logout'
    type:'button-small button-clear'
    ...

  $scope.rightButtons = rightButtons

FinishController = ($scope, $state, $stateParams) ->
  



