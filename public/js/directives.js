'use strict';
var app;
app = angular.module('ckmpa.directives', []);
app.directive('numberInput', function(){
  var controller;
  controller = function($scope, Datasheets){
    var tally;
    if (tally = Datasheets.getTally($scope.field.name, $scope.sub, $scope.field.category_id)) {
      $scope.tally = tally;
    } else {
      $scope.tally = {
        category: $scope.field.category_id,
        name: $scope.field.name,
        sub: $scope.sub,
        val: 0
      };
      Datasheets.addTally($scope.tally);
    }
    $scope.inc = function(){
      return $scope.tally['val'] += 1;
    };
    return $scope.dec = function(){
      if (!($scope.tally['val'] <= 0)) {
        return $scope.tally['val'] -= 1;
      }
    };
  };
  return {
    templateUrl: 'partials/number-input.html',
    restrict: 'E',
    scope: {
      field: "=",
      sub: "="
    },
    controller: controller
  };
});
app.directive('checkbox', function(){
  var controller;
  controller = function($scope, Datasheets){
    $scope.tally = {
      name: $scope.field.name,
      sub: $scope.sub,
      val: 'No',
      category: $scope.field.category_id
    };
    return Datasheets.addTally($scope.tally);
  };
  return {
    restrict: 'E',
    templateUrl: 'partials/checkbox.html',
    scope: {
      field: "=",
      sub: "="
    },
    controller: controller
  };
});
app.directive('radio', function(){
  var controller;
  controller = function($scope, Datasheets){
    $scope.tally = {
      name: $scope.field.name,
      sub: $scope.sub,
      val: $scope.field.options[0].name,
      category: $scope.field.category_id
    };
    return Datasheets.addTally($scope.tally);
  };
  return {
    restrict: 'E',
    templateUrl: 'partials/radio.html',
    scope: {
      field: "=",
      sub: "="
    },
    controller: controller
  };
});