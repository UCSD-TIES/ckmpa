(function () {
  'use strict';
  var app = angular.module('ckmpa.directives', []);

  app.directive('myInput', function ($compile, $http, $templateCache, Datasheets) {
    var getTemplate = function (contentType) {
      var baseUrl = 'partials/';
      var templateMap = {
        checkbox: 'checkbox.html',
        number: 'number.html',
        radio: 'radio.html'
      };

      var templateUrl = baseUrl + templateMap[contentType];
      var templateLoader = $http.get(templateUrl, {
        cache: $templateCache
      });

      return templateLoader;
    };

    var linker = function (scope, element, attrs) {
      var tallies = [];
      var tally = {};
      var t = {};
      var val;
      switch (scope.field.type) {
      case 'number':
        val = 0;
        break;
      case 'radio':
        val = scope.field.options[0].name;
        break;
      case 'checkbox':
        val = 'No';
        break;
      }
      if (!_.isEmpty(scope.category.subcategories)) {
        scope.category.subcategories.forEach(function (sub) {
          tally = {
            field: scope.field,
            subcategory: sub,
            val: val
          };
          if ((t = Datasheets.getTally(tally))) {
            tally = t;
          } else {
            Datasheets.addTally(tally);
          }
          tallies.push(tally);

          scope.$watch('activeTab', function (newValue) {
            scope.tally = tallies[newValue];
          });
        });

        scope.tally = tallies[scope.activeTab];
      } else {
        tally = {
          label: scope.field.name,
          field: scope.field,
          subcategory: null,
          val: val
        };

        if ((t = Datasheets.getTally(tally))) {
          tally = t;
          tally.label = scope.field.name;
        } else {
          Datasheets.addTally(tally);
        }

        scope.tally = tally;
      }
      scope.label = scope.field.name;

      scope.inc = function () {
        scope.tally.val = parseInt(scope.tally.val) + 1;
      };

      scope.dec = function () {
        if (scope.tally.val > 0) {
          scope.tally.val -= 1;
        }
      };

      scope.$on('resetTallies', function () {
        scope.tally.val = 0;
      });
      var loader = getTemplate(scope.field.type);

      loader.success(function (html) {
        element.html(html);
      }).then(function (response) {
        element.replaceWith($compile(element.html())(scope));
      });
    };

    return {
      restrict: "E",
      link: linker
    };
  });

  app.directive('myFav', function ($compile, $http, $templateCache, Datasheets) {
    var getTemplate = function (contentType) {
      var baseUrl = 'partials/';
      var templateMap = {
        checkbox: 'checkbox.html',
        number: 'number.html',
        radio: 'radio.html'
      };

      var templateUrl = baseUrl + templateMap[contentType];
      var templateLoader = $http.get(templateUrl, {
        cache: $templateCache
      });

      return templateLoader;
    };

    var linker = function (scope, element, attrs) {
      var t;
      var tally = {
        field: scope.fav.field,
        subcategory: scope.fav.subcategory,
        val: 0
      };
      if ((t = Datasheets.getTally(tally))) {
        tally = t;
      } else {
        Datasheets.addTally(tally);
      }
      scope.label = scope.fav.name;
      scope.tally = tally;

      scope.inc = function () {
        scope.tally.val = parseInt(scope.tally.val) + 1;
      };

      scope.dec = function () {
        if (scope.tally.val > 0) {
          scope.tally.val -= 1;
        }
      };

      scope.$on('resetTallies', function () {
        scope.tally.val = 0;
      });

      var loader = getTemplate(scope.fav.field.type);

      loader.success(function (html) {
        element.html(html);
      }).then(function (response) {
        element.replaceWith($compile(element.html())(scope));
      });
    };

    return {
      restrict: "E",
      link: linker
    };
  });

  app.directive('equals', function () {
    return {
      restrict: 'A', // only activate on element attribute
      require: '?ngModel', // get a hold of NgModelController
      link: function (scope, elem, attrs, ngModel) {
        if (!ngModel) {
          return;
        } // do nothing if no ng-model

        // watch own value and re-validate on change
        scope.$watch(attrs.ngModel, function () {
          validate();
        });

        // observe the other value and re-validate on change
        attrs.$observe('equals', function () {
          validate();
        });

        var validate = function () {
          // values
          var val1 = ngModel.$viewValue;
          var val2 = attrs.equals;

          // set validity
          ngModel.$setValidity('equals', val1 === val2);
        };
      }
    };
  });

}());
