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

<!--<link rel="stylesheet" href="/css/Semantic-UI/2.2.4/semantic.min.css" />-->
<link rel="stylesheet" href="/js/angular_material/1.1.1/angular-material.min.css">

<script>
var app = angular.module('app', ['ngSanitize', 'ngCookies', 'ngMaterial']);

app.config(function ($compileProvider, $mdIconProvider, $mdThemingProvider) {
    $compileProvider.debugInfoEnabled(true);
    $mdIconProvider.defaultIconSet('/js/angular_material/core-icons.svg', 24);
})

.controller('ordersController', function($scope, $http, $timeout) {

    function getOrders() {
        $http({method: 'GET', url: 'orders', data: {}})
        .success(function(data) {
            console.log(data);
            $scope.orders = data.orders;
            $timeout(getOrders, 3000);
        }).error(function(e) {
            document.write(e);
            console.log(e);
        });
    }

    getOrders();

    $scope.checkout = function(order) {
        $http({method: 'POST', url: 'checkout', data: {order_id: order.id}})
        .success(function(data) {
            console.log(data);
            $scope.orders = data.orders;
        }).error(function(e) {
            console.log(e);
        });
    };

});
</script>
</head>
<body ng-controller="ordersController" layout="column">
    <md-content flex>
        <md-tabs md-dynamic-height md-border-bottom>
            <md-tab label="訂單">
                <md-card md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}" ng-repeat="order in orders | orderBy:'wait'" layout="row">
                    <md-card-content flex layout="row">
                        <h3 flex="15" style="justify-content: center;flex-direction: column;display: flex;text-align: center">{{ order.no }}</h3>
                        <md-list flex>
                            <md-list-item ng-repeat="product in order.products">
                                <div class="md-list-item-text" layout="column">
                                    <h3>{{ product.title }} X {{ product.pivot.amount }}</h3>
                                </div>
                            </md-list-item>
                        </md-list>
                        <h3 flex="10" style="justify-content: center;flex-direction: column;display: flex;text-align: center">{{ order.wait }} min</h3>
                    </md-card-content>
                    <md-card-actions flex="30" layout="row" layout-align="end center">
                        <md-button flex="100" style="height:100%;font-size:40px" ng-click="checkout(order)">$ {{order.total}}</md-button>
                    </md-card-actions>
                </md-card>
            </md-tab>
            <md-tab label="調理區">
                <md-content>
                </md-content>
            </md-tab>
        </md-tabs>
    </md-content>
</body>
</html>