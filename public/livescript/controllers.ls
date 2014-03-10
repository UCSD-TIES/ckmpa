"use strict"

app = angular.module 'ckmpa.controllers', []

LoginController = ($scope, $state, Auth, Flash) !->
  $scope.credentials =
    username: ''
    password: ''

  $scope.login = -> Auth.login $scope.credentials .success -> $state.go 'select-mpa'
  $scope.logout = -> Auth.logout!.success -> $state.go 'login'

RegisterController = ($scope, $state, Users) ->
  $scope.credentials =
    first_name: ""
    last_name: ""
    email: ""
    username: ""
    password: ""
    password_confirmation: ""

  $scope.emailRegex = /\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b/

  $scope.register = ->
    if $scope.credentials.password is $scope.credentials.password_confirmation
      Users.post $scope.credentials .success -> $state.go 'login'
    else
      console.log "NO"

MpaController = ($scope, $state,  $stateParams, $ionicLoading, Mpas, Auth) ->
  $scope.mpa_id = $stateParams.mpaId
  $scope.mpa_name = $stateParams.mpaName

  $scope.select_transect = (mpa) ->
    $state.go 'select-transect',
      mpaId: mpa.id
      mpaName: mpa.name

  $scope.collect_data = (transect) ->
    $state.go 'data-collection',
      transectId: transect.id
      transectName: encodeURIComponent transect.name

  rightButtons =
    content: 'Logout'
    type: 'button-small button-clear'
    tap: -> Auth.logout!.success -> $state.go 'login'
    ...

  $scope.rightButtons = rightButtons

  mpas = Mpas.query {}, ->
    $scope.transects = _(mpas).pluck \transects .flatten! .value!
    $scope.mpas = mpas
    $scope.loading.hide!

  $scope.loading = $ionicLoading.show do
    content: "<i class='icon ion-loading-a'></i> Loading"
    showDelay: 400

DataController = ($scope, $state, $stateParams, $ionicLoading, $ionicModal, $timeout, Datasheets, Favorites, Auth) ->
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName
  $scope.transect_name = decodeURIComponent $stateParams.transectName
  $scope.comments = Datasheets.comments!
  $scope.favorites = []
  $scope.categories = []
  time_interval = 100000
  var timer

  saveTallies = ->
    Datasheets.saveTallies!
    timer := $timeout saveTallies, time_interval

  saveTallies!

  $scope.stop = -> $timeout.cancel timer
  
  $scope.submit = ->
    $timeout.cancel timer
    $state.go 'summary'

  $scope.addFavorite = (field, sub) ->
    $scope.modalError = ""
    if not Favorites.add(field,sub)
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
    tap: -> Auth.logout!.success -> $state.go 'login'
    ...

  $scope.rightButtons = rightButtons

  $scope.loading = $ionicLoading.show do
    content: "<i class='icon ion-loading-a'></i> Loading"

SummaryController = ($scope, $state, $stateParams, $ionicLoading, Datasheets, Patrols, Auth) ->
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName
  $scope.transect_name = $stateParams.transectName
  $scope.categories = Datasheets.categories!
  $scope.tallies = Datasheets.tallies!
  $scope.comments = Datasheets.comments!

  $scope.getTally = (field, subcategory) ->
    Datasheets.getTally do
      field: field
      subcategory: subcategory

  $scope.submit = ->
    $scope.loading = $ionicLoading.show do
      content: "<i class='icon ion-loading-a'></i> Submitting"

    Patrols.post $stateParams.transectId,$scope.comments,$scope.tallies 
      .success (data) ->
        # console.log data
        $scope.loading.hide!
        $state.go 'finish'
        Datasheets.resetTallies!
      .error (data, status, headers, config) ->
        console.log data

  datasheets = Datasheets.datasheets.then (data) ->
    $scope.categories = Datasheets.categories!

  rightButtons =
    content: 'Logout'
    type:'button-small button-clear'
    tap: -> Auth.logout!.success -> $state.go 'login'
    ...

  $scope.rightButtons = rightButtons

FinishController = ($scope, $state, $stateParams, Auth) ->
  $scope.mpa_id = $stateParams.mpaID
  $scope.mpa_name = $stateParams.mpaName

  $scope.logout = ->
    Auth.logout!.success -> $state.go 'login'
  



