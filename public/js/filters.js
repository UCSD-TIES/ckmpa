'use strict';
var app;
app = angular.module('ckmpa.filters', []);
app.filter("hasNumericField", function(){
  return function(categories, search){
    var searchFunc;
    searchFunc = function(x){
      var searchString, name;
      searchString = search.toLowerCase();
      name = x.name.toLowerCase();
      return x.type === "number" && name.substring(0, search.length) === searchString;
    };
    if (!search) {
      return filter(function(it){
        return any(function(it){
          return it.type === "number";
        })(
        it.fields);
      })(
      categories);
    } else {
      return filter(function(it){
        return any(searchFunc)(
        it.fields);
      })(
      categories);
    }
  };
});
app.filter('encodeUri', function(){
  return function(x){
    return encodeURIComponent(x);
  };
});