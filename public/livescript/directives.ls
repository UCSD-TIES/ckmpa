'use strict'

app = angular.module 'ckmpa.directives', []
app.directive 'numberInput', ->
  controller = ($scope, Datasheets) ->
    tally =
      name: $scope.name
      field: $scope.field
      subcategory: $scope.subcategory
      val: 0

    if t = Datasheets.getTally tally
      $scope.tally = t
    else
      $scope.tally = tally
      Datasheets.addTally tally

    $scope.inc = -> $scope.tally['val'] += 1
    $scope.dec = -> $scope.tally['val'] -= 1 unless $scope.tally['val'] <= 0
  
  templateUrl: 'partials/number-input.html'
  restrict: 'E'
  scope:
    field: "="
    subcategory: "="
    name: "="
  controller: controller

app.directive 'checkbox', ->
  controller = ($scope, Datasheets) ->
    tally = 
      field: $scope.field
      subcategory: $scope.subcategory
      val: 'No'

    if t = Datasheets.getTally tally
      $scope.tally = t
    else
      $scope.tally = tally
      Datasheets.addTally tally

  restrict: 'E'
  templateUrl: 'partials/checkbox.html'
  scope:
    field: "="
    subcategory: "="
  controller: controller

app.directive 'radio', ->
  controller = ($scope, Datasheets) ->
    tally = 
      field: $scope.field
      subcategory: $scope.subcategory
      val: $scope.field.options[0].name

    if t = Datasheets.getTally tally
      $scope.tally = t
    else
      $scope.tally = tally
      Datasheets.addTally tally

  restrict: 'E'
  templateUrl: 'partials/radio.html'
  scope:
    field: "="
    subcategory: "="
  controller: controller
