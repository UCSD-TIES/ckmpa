<!DOCTYPE html>
<html lang="en" ng-app="ckmpa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MPA Watch</title>
    <link href="lib/css/ionic.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
<nav-bar type="bar-positive" 
         ></nav-bar>
<nav-view animation="slide-left-right"></nav-view>

<script src="lib/js/ionic.min.js"></script>
<script src="lib/js/angular/angular.min.js"></script>
<script src="lib/js/angular/angular-animate.min.js"></script>
<script src="lib/js/angular/angular-sanitize.min.js"></script>
<script src="lib/js/angular/angular-resource.min.js"></script>
<script src="lib/js/angular-ui/angular-ui-router.min.js"></script>
<script src="lib/js/ionic-angular.min.js"></script>
<script src="http://preludels.com/prelude-browser-min.js"></script>

<script src="js/app.js"></script>
<script src="js/controllers.js"></script>
<script src="js/directives.js"></script>
<script src="js/filters.js"></script>
<script src="js/services.js"></script>
<script>
    angular.module("ckmpa").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
</script>
</body>
</html>