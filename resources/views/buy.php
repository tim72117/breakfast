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

    $scope.cart = {items: []};
    $scope.amount = 1;

    $http({method: 'GET', url: 'products', data: {}})
    .success(function(data) {
        console.log(data);
        $scope.products = data.products;
    }).error(function(e) {
        console.log(e);
    });

    $scope.addProduct = function() {
        var index = $scope.cart.items.indexOf($scope.product);
        if (index > -1) {
            $scope.cart.items[index].amount +=  $scope.amount
        } else {
            $scope.product.amount = $scope.amount;
            $scope.cart.items.push($scope.product);
        }

    };

    $scope.order = function() {

        $http({method: 'POST', url: 'order', data: {items: $scope.cart.items}})
        .success(function(data) {
            console.log(data);
            $scope.ordered = data.ordered;
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

        <div layout="row">
            <md-input-container flex="80">
                <label>商品</label>
                <md-select ng-model="product" ng-change="amount = 1">
                    <md-option ng-repeat="product in products" ng-value="product">{{product.title}} $ {{product.price}}</md-option>
                </md-select>
            </md-input-container>
            <md-input-container flex="20">
                <label>數量</label>
                <input ng-model="amount" type="number">
            </md-input-container>
        </div>

        <md-button class="md-primary" ng-click="addProduct()">新增</md-button>

        <div ng-repeat="item in cart.items">
            {{item.title}} X {{item.amount}}
        </div>

        <div ng-if="ordered">
            <div>訂單號碼 {{ordered.no}}</div>
            <div>取餐時間 {{ordered.taked_at}}</div>
        </div>

        <md-button class="md-primary" ng-click="order()">確定</md-button>

    </md-content>
</body>
</html>