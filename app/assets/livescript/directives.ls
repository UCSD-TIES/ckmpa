'use strict'

app = angular.module 'ckmpa.directives', []
app.directive 'numberInput', ->
  controller = ($scope) ->
    $scope.field.val = 0
    $scope.inc = -> $scope.field.val += 1
    $scope.dec = -> $scope.field.val -= 1 unless $scope.field.val <= 0
  {
    restrict: 'E'
    scope: {field: '='}
    templateUrl: 'partials/number-input.html'
    controller: controller
  }

app.directive 'checkbox', ->
  controller = ($scope) ->
    $scope.field.val = 'NO'
  {
    restrict: "E"
    scope: {field: '='}
    templateUrl: 'partials/checkbox.html'
    controller: controller
  }

app.directive 'radio', ->
  controller = ($scope) ->
    $scope.field.val = $scope.field.options[0].name
  {
    restrict: "E"
    scope: {field: '='}
    templateUrl: 'partials/radio.html'
    controller: controller
  }
