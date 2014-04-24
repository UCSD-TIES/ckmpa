(function () {
  'use strict';
  var app = angular.module('ckmpa.filters', []);

  app.filter("hasNumericField", function () {
    return function (categories, search) {
      var searchFunc = function (x) {
        var searchString = search.toLowerCase();
        var name = x.name.toLowerCase();
        
        return x.type === "number" && name.substring(0, search.length) === searchString;
      };
      if (!search) {
        return _.filter(categories, function (x) {
          return _.any(x.fields, function (it) {
            return it.type === "number";
          });
        });
      } else {
        return _.filter(categories, function (x) {
          return _.any(x.fields, searchFunc);
        });
      }
    };
  });
}());