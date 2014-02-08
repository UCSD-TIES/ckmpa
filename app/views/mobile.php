<!DOCTYPE html>
<html lang="en" ng-app="ckmpa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel4 AngularJS Authentication and security</title>
    <?= stylesheet_link_tag('mobile/application') ?>
</head>
<body>
<div ng-include="'templates/header-mobile.html'" class="navbar navbar-default navbar-fixed-top"></div>
<div class="alert alert-info" ng-show="flash" ng-bind="flash"></div>
<div class="container" ng-view ng-cloak></div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.12/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.12/angular-route.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.12/angular-resource.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.12/angular-sanitize.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.12/angular-animate.min.js"></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js'></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
<script src="http://preludels.com/prelude-browser-min.js"></script>
<?= javascript_include_tag('mobile/application') ?>
<script>
    angular.module("ckmpa").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
</script>
</body>
</html>