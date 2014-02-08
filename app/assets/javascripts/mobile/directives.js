'use strict';
var app;
app = angular.module('ckmpa.directives', []);
app.directive('numberInput', function(){
  var controller;
  controller = function($scope){
    $scope.field.val = 0;
    $scope.inc = function(){
      return $scope.field.val += 1;
    };
    return $scope.dec = function(){
      if (!($scope.field.val <= 0)) {
        return $scope.field.val -= 1;
      }
    };
  };
  return {
    restrict: 'E',
    scope: {
      field: '='
    },
    templateUrl: 'partials/number-input.html',
    controller: controller
  };
});
app.directive('checkbox', function(){
  var controller;
  controller = function($scope){
    return $scope.field.val = 'NO';
  };
  return {
    restrict: "E",
    scope: {
      field: '='
    },
    templateUrl: 'partials/checkbox.html',
    controller: controller
  };
});
app.directive('radio', function(){
  var controller;
  controller = function($scope){
    return $scope.field.val = $scope.field.options[0].name;
  };
  return {
    restrict: "E",
    scope: {
      field: '='
    },
    templateUrl: 'partials/radio.html',
    controller: controller
  };
});