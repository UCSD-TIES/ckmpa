'use strict'

app = angular.module 'ckmpa.directives', []
app.directive 'numberInput', ->
  controller = ($scope, Datasheets) ->
    Datasheets.getTally($scope.field.name)['val1'] = 0

    $scope.tally = Datasheets.getTally($scope.field.name)

    $scope.inc = (x) -> $scope.tally[x] += 1
    $scope.dec = (x) -> $scope.tally[x] -= 1 unless $scope.tally[x] <= 0
  
  templateUrl: 'partials/number-input.html'
  controller: controller

app.directive 'checkbox', ->
  templateUrl: 'partials/checkbox.html'

app.directive 'radio', ->
  templateUrl: 'partials/radio.html'
