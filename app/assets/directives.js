'use strict';

/* Directives */
angular.module('ckmpa.directives', []).
	directive('numberInput', function() {
		function controller($scope) {
			$scope.num = 0;
			$scope.inc = function () {
				$scope.num = $scope.num + 1;
			}
			$scope.dec = function () {
				$scope.num = $scope.num - 1;
			}
		}
		return {
			restrict: 'E',
			scope: {
				input: '='
			},
			templateUrl: 'partials/number-input.html',
			controller: controller
		};
  });