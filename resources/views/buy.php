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

<link rel="stylesheet" href="/css/Semantic-UI/2.2.4/semantic.min.css" />
<link rel="stylesheet" href="/js/angular_material/1.1.1/angular-material.min.css">

<script>
var app = angular.module('app', ['ngSanitize', 'ngCookies', 'ngMaterial']);

app.config(function ($compileProvider, $mdIconProvider, $mdThemingProvider) {
    $compileProvider.debugInfoEnabled(true);
    $mdIconProvider.defaultIconSet('/js/angular_material/core-icons.svg', 24);
})

.controller('ordersController', function($scope, $http, $filter, $timeout) {

    $scope.items = [{}];

    $http({method: 'GET', url: 'products', data: {}})
    .success(function(data) {
        console.log(data);
        $scope.products = data.products;
    }).error(function(e) {
        console.log(e);
    });

    $scope.addProduct = function(item) {
        item.finish = true;
        $scope.items.push({});
        console.log($scope.items);
    };

    $scope.order = function() {

        console.log($filter);
        return ;
        $http({method: 'POST', url: 'order', data: {product_id: $scope.product.id}})
        .success(function(data) {
            console.log(data);
            //$scope.products = data.products;
            //document.write(data);
        }).error(function(e) {
            document.write(e);
            console.log(e);
        });
    };

});
</script>
</head>
<body ng-controller="ordersController" layout="column">
    <md-content flex>

        <md-select ng-model="item.product" ng-repeat="item in items" ng-change="addProduct(item)">
            <md-option ng-repeat="product in products" ng-value="product">{{product.title}}</md-option>
        </md-select>

        <md-button class="md-primary" ng-click="order()">確定</md-button>

    </md-content>
</body>
</html>