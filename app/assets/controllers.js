angular.module('ckmpa.controllers', []);
var LoginController = function($scope,$sanitize,$location,Auth,Flash){
	$scope.credentials = { username: "", password: "" };

	$scope.login = function() {
		Auth.login($scope.credentials).success(function() {
			$location.path('/dashboard');
		});
	};

	$scope.logout = function() {
		Auth.logout().success(function(){
			$location.path('/')
		})
	};
};

var HomeController = function($scope,$location){
};

var ModalInstanceCtrl = function ($scope, $modalInstance, items) {

	$scope.items = items;
	$scope.selected = {
		item: $scope.items[0]
	};

	$scope.ok = function () {
		$modalInstance.close($scope.selected.item);
	};

	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	};
};

var VolunteersController = function($scope, $location, $modal, Users){
	var users = Users.query();
	$scope.users = users;

	$scope.edit = function(){
		alert('test');
	}

	$scope.open = function (id) {
		var user;
		users.forEach(function(element, index, array) {
			if(element.id == id)
				user = element;
		})

		var modalInstance = $modal.open({
			templateUrl: 'templates/modal.html',
			controller: ModalInstanceCtrl,
			resolve: {
				type: function(){return 'user'},
				items: function () {return user}
			}
		});

		modalInstance.result.then(function (selectedItem) {
			$scope.selected = selectedItem;
		}, function () {
			//$log.info('Modal dismissed at: ' + new Date());
		});
	};
};

var ModalInstanceCtrl = function ($scope, $modalInstance, type, items) {
	$scope.items = items;
	$scope.type = type;

	$scope.ok = function () {
		$modalInstance.close($scope.selected.item);
	};

	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	};
};

var DemoController = function ($scope) {
	$scope.oneAtATime = true;
	$scope.num = 1;
	$scope.input1 = {label:'test', name:'input1'};

	$scope.groups = [
	{
		title: "Dynamic Group Header - 1",
		content: "Dynamic Group Body - 1"
	},
	{
		title: "Dynamic Group Header - 2",
		content: "Dynamic Group Body - 2"
	}
	];

	$scope.items = ['Item 1', 'Item 2', 'Item 3'];

}