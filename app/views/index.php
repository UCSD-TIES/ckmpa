<!DOCTYPE html>
<html lang="en" ng-app="ckmpa">
<head>
    <meta charset="utf-8">
    <title>Laravel4 AngularJS Authentication and security</title>
    <link href="lib/css/ionic.min.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet" />
</head>
<body>
<div ng-include="'templates/header-mobile.html'" class="navbar navbar-default navbar-fixed-top"></div>
<div class="alert alert-info" ng-show="flash" ng-bind="flash"></div>
<div class="container" ng-view></div>

<script src="lib/js/ionic.min.js"></script>
<script src="lib/js/angular/angular.min.js"></script>
<script src="lib/js/angular/angular-animate.min.js"></script>
<script src="lib/js/angular/angular-sanitize.min.js"></script>
<script src="lib/js/angular/angular-resource.min.js"></script>
<script src="lib/js/angular-ui/angular-ui-router.min.js"></script>
<script src="lib/js/ionic-angular.min.js"></script>

<script src="/js/app.js"></script>
<script src="/js/controllers.js"></script>
<script src="/js/directives.js"></script>
<script src="/js/filters.js"></script>
<script src="/js/services.js"></script>
<script>
    angular.module("ckmpa").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
</script>
</body>
</html>