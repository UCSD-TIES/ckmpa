<!DOCTYPE html>
<html lang="en" ng-app="ckmpa">
<head>
    <meta charset="utf-8">
    <title>Laravel4 AngularJS Authentication and security</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet" />
</head>
<body>
<div ng-include="'templates/header.html'" class="navbar navbar-default navbar-fixed-top"></div>
<div class="alert alert-info" ng-show="flash" ng-bind="flash"></div>
<div class="container" ng-view></div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular-route.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular-resource.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular-sanitize.min.js"></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js'></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
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