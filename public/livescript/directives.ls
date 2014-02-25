'use strict'

app = angular.module 'ckmpa.directives', []
app.directive 'numberInput', ->
  controller = ($scope, Datasheets) ->
    if tally = Datasheets.getTally $scope.field.name, $scope.sub, $scope.field.category_id
      $scope.tally = tally
    else
      $scope.tally = 
        category: $scope.field.category_id
        name: $scope.field.name
        sub: $scope.sub
        val: 0

      Datasheets.addTally($scope.tally)

    $scope.inc = -> $scope.tally['val'] += 1
    $scope.dec = -> $scope.tally['val'] -= 1 unless $scope.tally['val'] <= 0
  
  templateUrl: 'partials/number-input.html'
  restrict: 'E'
  scope:
    field: "="
    sub: "="
  controller: controller

app.directive 'checkbox', ->
  controller = ($scope, Datasheets) ->
    $scope.tally = 
      name: $scope.field.name
      sub: $scope.sub
      val: 'No'
      category: $scope.field.category_id

    Datasheets.addTally($scope.tally)

  restrict: 'E'
  templateUrl: 'partials/checkbox.html'
  scope:
    field: "="
    sub: "="
  controller: controller

app.directive 'radio', ->
  controller = ($scope, Datasheets) ->
    $scope.tally = 
      name: $scope.field.name
      sub: $scope.sub
      val: $scope.field.options[0].name
      category: $scope.field.category_id

    Datasheets.addTally($scope.tally)

  restrict: 'E'
  templateUrl: 'partials/radio.html'
  scope:
    field: "="
    sub: "="
  controller: controller
