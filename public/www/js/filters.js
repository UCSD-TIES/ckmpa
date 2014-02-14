'use strict';
angular.module('ckmpa.filters', []).filter('interpolate', [
  'version', function(version){
    return function(text){
      return String(text).replace(/\%VERSION\%/g, version);
    };
  }
]);