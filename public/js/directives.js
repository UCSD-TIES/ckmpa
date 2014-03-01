'use strict';
var app;
app = angular.module('ckmpa.directives', []);
app.directive('numberInput', function(){
  var controller;
  controller = function($scope, Datasheets){
    var tally, t;
    tally = {
      name: $scope.name,
      field: $scope.field,
      subcategory: $scope.subcategory,
      val: 0
    };
    if (t = Datasheets.getTally(tally)) {
      $scope.tally = t;
    } else {
      $scope.tally = tally;
      Datasheets.addTally(tally);
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
      subcategory: "=",
      name: "="
    },
    controller: controller
  };
});
app.directive('checkbox', function(){
  var controller;
  controller = function($scope, Datasheets){
    var tally, t;
    tally = {
      field: $scope.field,
      subcategory: $scope.subcategory,
      val: 'No'
    };
    if (t = Datasheets.getTally(tally)) {
      return $scope.tally = t;
    } else {
      $scope.tally = tally;
      return Datasheets.addTally(tally);
    }
  };
  return {
    restrict: 'E',
    templateUrl: 'partials/checkbox.html',
    scope: {
      field: "=",
      subcategory: "="
    },
    controller: controller
  };
});
app.directive('radio', function(){
  var controller;
  controller = function($scope, Datasheets){
    var tally, t;
    tally = {
      field: $scope.field,
      subcategory: $scope.subcategory,
      val: $scope.field.options[0].name
    };
    if (t = Datasheets.getTally(tally)) {
      return $scope.tally = t;
    } else {
      $scope.tally = tally;
      return Datasheets.addTally(tally);
    }
  };
  return {
    restrict: 'E',
    templateUrl: 'partials/radio.html',
    scope: {
      field: "=",
      subcategory: "="
    },
    controller: controller
  };
});