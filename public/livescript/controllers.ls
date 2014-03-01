app = angular.module 'ckmpa.controllers', []

LoginController = ($scope, $sanitize, $location, Auth, Flash) !->
  $scope.credentials =
    username: ''
    password: ''

  $scope.login = -> Auth.login $scope.credentials .success ->
    $location.path '/select-mpa'
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

DataController = ($scope, $state, $stateParams, $ionicLoading, $ionicModal, $timeout, Datasheets, Favorites) ->
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName
  $scope.transect_name = $stateParams.transectName
  $scope.comments = Datasheets.comments!
  $scope.favorites = []
  $scope.categories = []
  time_interval = 100000
  var timer

  saveTallies = ->
    Datasheets.saveTallies!
    timer := $timeout saveTallies, time_interval

  timer = $timeout saveTallies, time_interval

  $scope.stop = -> $timeout.cancel timer
  
  $scope.submit = ->
    $timeout.cancel timer
    $state.go 'summary'

  $scope.addFavorite = (name) ->
    $scope.modalError = ""
    if not Favorites.add(name)
      $scope.modalError = "Already Added to Favorites"

  $scope.deleteFavorite = (name) -> 
    $scope.modalError = ""
    Favorites.delete(name)

  $scope.resize = -> $scope.$broadcast('scroll.resize')

  datasheets = Datasheets.datasheets.then (data) ->
    $scope.categories = Datasheets.categories!
    $scope.favorites = Favorites.favorites!
    $scope.loading.hide!

  $ionicModal.fromTemplateUrl 'partials/modal.html', 
    (modal) -> $scope.modal = modal,
    scope: $scope
    animation: 'slide-in-up'

  $scope.openModal = ->
    $scope.modal.show!

  $scope.closeModal = ->
    $scope.modal.hide!
    Favorites.save!

  $scope.$on '$destroy', ->
    $scope.modal.remove!

  rightButtons =
    content: 'Logout'
    type:'button-small button-clear'
    ...

  $scope.rightButtons = rightButtons

  $scope.loading = $ionicLoading.show do
    content: "<i class='icon ion-loading-a'></i> Loading"

SummaryController = ($scope, $state, $stateParams, Datasheets) ->
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName
  $scope.transect_name = $stateParams.transectName
  $scope.categories = Datasheets.categories!
  $scope.tallies = Datasheets.tallies!
  $scope.comments = Datasheets.comments!

  $scope.getTally = (name,sub,cat) -> Datasheets.getTally(name,sub,cat)
  $scope.submit = -> 
    $state.go 'finish'
    Datasheets.resetTallies!

  datasheets = Datasheets.datasheets.then (data) ->
    $scope.categories = Datasheets.categories!

  rightButtons =
    content: 'Logout'
    type:'button-small button-clear'
    ...

  $scope.rightButtons = rightButtons

FinishController = ($scope, $state, $stateParams) ->
  



