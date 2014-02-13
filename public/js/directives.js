'use strict';
var app;
app = angular.module('ckmpa.directives', []);
app.directive('numberInput', function(){
  var controller;
  controller = function($scope){
    $scope.field.val = [0, 0];
    $scope.inc = function(i){
      return $scope.field.val[i] += 1;
    };
    return $scope.dec = function(i){
      if (!($scope.field.val[i] <= 0)) {
        return $scope.field.val[i] -= 1;
      }
    };
  };
  return {
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
    templateUrl: 'partials/radio.html',
    controller: controller
  };
});