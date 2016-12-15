<!DOCTYPE html>
<html xmlns:ng="http://angularjs.org" ng-app="app" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title></title>

<!--[if lt IE 9]><script src="/js/html5shiv.js"></script><![endif]-->
<script src="/js/angular/1.5.3/angular.min.js"></script>
<script src="/js/angular/1.5.3/angular-sanitize.min.js"></script>
<script src="/js/angular/1.5.3/angular-cookies.min.js"></script>
<script src="/js/angular/1.5.3/angular-animate.min.js"></script>
<script src="/js/angular/1.5.3/angular-aria.min.js"></script>
<script src="/js/angular/1.5.3/angular-messages.min.js"></script>
<script src="/js/angular_material/1.1.1/angular-material.min.js"></script>

<link rel="stylesheet" href="/css/Semantic-UI/2.2.4/semantic.min.css" />
<link rel="stylesheet" href="/js/angular_material/1.1.1/angular-material.min.css">

<script>
var app = angular.module('app', ['ngSanitize', 'ngCookies', 'ngMaterial']);

app.config(function ($compileProvider, $mdIconProvider, $mdThemingProvider) {
    $compileProvider.debugInfoEnabled(false);
    $mdIconProvider.defaultIconSet('/js/angular_material/core-icons.svg', 24);
})

.controller('ordersController', function($scope, $mdSidenav, $mdToast) {
    $scope.orders = [{
        items: [
            {title: '卡啦雞腿堡', amount: 1},
            {title: '花生厚片', amount: 2},
            {title: '豆漿', amount: 1}
        ],
        time : 10
    }, {
        items: [
            {title: '漢堡蛋', amount: 1},
            {title: '豆漿', amount: 1}
        ],
        time : 15
    }];
});
</script>
</head>
<body ng-controller="ordersController" layout="column">
    <md-content flex>

<md-card md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}" ng-repeat="order in orders" layout="row">
<md-card-content flex>

      <md-list flex>
        <md-list-item ng-repeat="item in order.items">
          <div class="md-list-item-text" layout="column">
            <h3>{{ item.title }} X {{ item.amount }}</h3>
          </div>
        </md-list-item>
    </md-list>


</md-card-content>

<h3 style="vertical-align:middle;justify-content: center;flex-direction: column;display: flex;">{{ order.time }} min</h3>

<md-card-actions flex="30" layout="row" layout-align="end center">
<md-button flex="100" style="height:100%;font-size:40px">$ 100</md-button>
</md-card-actions>
</md-card>

    </md-content>
</body>
</html>