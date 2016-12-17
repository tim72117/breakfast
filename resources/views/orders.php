<!DOCTYPE html>
<html xmlns:ng="http://angularjs.org" ng-app="app" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title></title>

<!--[if lt IE 9]><script src="/js/html5shiv.js"></script><![endif]-->
<script src="/js/angular/1.5.8/angular.min.js"></script>
<script src="/js/angular/1.5.8/angular-sanitize.min.js"></script>
<script src="/js/angular/1.5.8/angular-cookies.min.js"></script>
<script src="/js/angular/1.5.8/angular-animate.min.js"></script>
<script src="/js/angular/1.5.8/angular-aria.min.js"></script>
<script src="/js/angular/1.5.8/angular-messages.min.js"></script>
<script src="/js/angular_material/1.1.1/angular-material.min.js"></script>
<script src="/js/dist/orders.js"></script>

<!--<link rel="stylesheet" href="/css/Semantic-UI/2.2.4/semantic.min.css" />-->
<link rel="stylesheet" href="/js/angular_material/1.1.1/angular-material.min.css">

<script>
var app = angular.module('app', ['ngSanitize', 'ngCookies', 'ngMaterial', 'breakfast']);

app.config(function ($compileProvider, $mdIconProvider, $mdThemingProvider) {
    $compileProvider.debugInfoEnabled(true);
    $mdIconProvider.defaultIconSet('/js/angular_material/core-icons.svg', 24);
})

.controller('ordersController', function($scope, $http, $timeout) {



});
</script>
<style>
md-grid-tile-footer figcaption {
    width: 100%;
}
md-grid-tile-footer figcaption h1 {
    text-align: center;
}
</style>
</head>
<body ng-controller="ordersController" layout="column">
    <md-content flex>
        <md-tabs md-dynamic-height md-border-bottom md-selected="area">
            <md-tab label="訂單">
                <orders ng-if="area==0"></orders>
            </md-tab>
            <md-tab label="調理區">
                <materials ng-if="area==1"></materials>
            </md-tab>
        </md-tabs>
    </md-content>
</body>
</html>