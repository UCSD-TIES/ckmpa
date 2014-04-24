(function () {
  'use strict';
  var app = angular.module('ckmpa.directives', []);

  app.directive('numberInput', function () {
    var controller = function ($scope, Datasheets) {
      var tally, t;
      tally = {
        name: $scope.name,
        field: $scope.field,
        subcategory: $scope.subcategory,
        val: 0
      };

      if ((t = Datasheets.getTally(tally))) {
        $scope.tally = t;
      } else {
        $scope.tally = tally;
        Datasheets.addTally(tally);
      }

      $scope.inc = function () {
        $scope.tally.val += 1;
      };

      $scope.dec = function () {
        if ($scope.tally.val > 0) {
          $scope.tally.val -= 1;
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

  app.directive('checkbox', function () {
    var controller = function ($scope, Datasheets) {
      var tally, t;
      tally = {
        field: $scope.field,
        subcategory: $scope.subcategory,
        val: 'No'
      };

      if ((t = Datasheets.getTally(tally))) {
        $scope.tally = t;
      } else {
        $scope.tally = tally;
        Datasheets.addTally(tally);
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

  app.directive('radio', function () {
    var controller = function ($scope, Datasheets) {
      var tally, t;
      tally = {
        field: $scope.field,
        subcategory: $scope.subcategory,
        val: $scope.field.options[0].name
      };
      if ((t = Datasheets.getTally(tally))) {
        $scope.tally = t;
      } else {
        $scope.tally = tally;
        Datasheets.addTally(tally);
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