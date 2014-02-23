'use strict';
var app;
app = angular.module('ckmpa.filters', []);
app.filter("hasNumericField", function(){
  return function(categories){
    return filter(function(it){
      return any(function(it){
        return it.type === "number";
      })(
      it.fields);
    })(
    categories);
  };
});