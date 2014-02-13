'use strict'

app = angular.module 'ckmpa.directives', []
app.directive 'numberInput', ->
  controller = ($scope) ->
    $scope.field.val = [0,0]
    $scope.inc = (i) -> $scope.field.val[i] += 1
    $scope.dec = (i) -> $scope.field.val[i] -= 1 unless $scope.field.val[i] <= 0
  {
    templateUrl: 'partials/number-input.html'
    controller: controller
  }

app.directive 'checkbox', ->
  controller = ($scope) ->
    $scope.field.val = 'NO'
  {
    templateUrl: 'partials/checkbox.html'
    controller: controller
  }

app.directive 'radio', ->
  controller = ($scope) ->
    $scope.field.val = $scope.field.options[0].name
  {
    templateUrl: 'partials/radio.html'
    controller: controller
  }
