'use strict';
var app;
app = angular.module('ckmpa.directives', []);
app.directive('numberInput', function(){
  var controller;
  controller = function($scope, Datasheets){
    Datasheets.getTally($scope.field.name)['val1'] = 0;
    $scope.tally = Datasheets.getTally($scope.field.name);
    $scope.inc = function(x){
      return $scope.tally[x] += 1;
    };
    return $scope.dec = function(x){
      if (!($scope.tally[x] <= 0)) {
        return $scope.tally[x] -= 1;
      }
    };
  };
  return {
    templateUrl: 'partials/number-input.html',
    controller: controller
  };
});
app.directive('checkbox', function(){
  return {
    templateUrl: 'partials/checkbox.html'
  };
});
app.directive('radio', function(){
  return {
    templateUrl: 'partials/radio.html'
  };
});