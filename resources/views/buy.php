<!DOCTYPE html>
<html xmlns:ng="http://angularjs.org" ng-app="app" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">
<title></title>

<!--[if lt IE 9]><script src="/js/html5shiv.js"></script><![endif]-->
<!--<script src="/js/angular/1.5.8/angular.min.js"></script>
<script src="/js/angular/1.5.8/angular-sanitize.min.js"></script>
<script src="/js/angular/1.5.8/angular-cookies.min.js"></script>
<script src="/js/angular/1.5.8/angular-animate.min.js"></script>
<script src="/js/angular/1.5.8/angular-aria.min.js"></script>
<script src="/js/angular/1.5.8/angular-messages.min.js"></script>
<script src="/js/angular_material/1.1.1/angular-material.min.js"></script>-->

<link rel="stylesheet" href="/css/vue-material.css">
<link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
<!--<link rel="stylesheet" href="/css/Semantic-UI/2.2.4/semantic.min.css" />-->
<!--<link rel="stylesheet" href="/js/angular_material/1.1.1/angular-material.min.css">-->

<script>
// var app = angular.module('app', ['ngSanitize', 'ngCookies', 'ngMaterial']);

// app.config(function ($compileProvider, $mdIconProvider, $mdThemingProvider) {
//     $compileProvider.debugInfoEnabled(true);
//     $mdIconProvider.defaultIconSet('/js/angular_material/core-icons.svg', 24);
// })

// .controller('ordersController', function($scope, $http, $filter, $timeout) {

//     $scope.cart = {items: []};
//     $scope.amount = 1;

//     $http({method: 'GET', url: 'products', data: {}})
//     .success(function(data) {
//         console.log(data);
//         $scope.products = data.products;
//     }).error(function(e) {
//         console.log(e);
//     });

//     $scope.addProduct = function() {
//         var index = $scope.cart.items.indexOf($scope.product);
//         if (index > -1) {
//             $scope.cart.items[index].amount +=  $scope.amount
//         } else {
//             $scope.product.amount = $scope.amount;
//             $scope.cart.items.push($scope.product);
//         }

//     };

//     $scope.order = function() {

//         $http({method: 'POST', url: 'order', data: {items: $scope.cart.items}})
//         .success(function(data) {
//             console.log(data);
//             $scope.ordered = data.ordered;
//             //document.write(data);
//         }).error(function(e) {
//             document.write(e);
//             console.log(e);
//         });
//     };

// });
</script>
<style>
@media screen and (min-width:600px) {
    #app {
        width: 600px;
    }
}

html,
body,
#app {
    height:100%;
    overflow: hidden;
}
</style>

</head>
<body class="grey lighten-4" style="display: flex; justify-content: center;">

<md-whiteframe id="app">

<v-app style="display: flex;flex: 1;-webkit-flex-direction: column">
    <v-toolbar>
        <v-toolbar-side-icon></v-toolbar-side-icon>
        <v-toolbar-title>商品</v-toolbar-title>
        <v-btn icon dark @click.native="removeCart()">
            <v-icon>remove_shopping_cart</v-icon>
        </v-btn>
    </v-toolbar>

  <main style="-webkit-box-flex: 1">
<v-content style="overflow: auto">

<v-list two-line v-if="e1 === 1">
<template v-for="product in products">
    <v-list-item v-bind:key="product.title" @click="openDialog('dialog1', product)">
    <v-list-tile avatar ripple>
        <v-list-tile-avatar>
        <img v-bind:src="product.image" />
        </v-list-tile-avatar>
        <v-list-tile-content>
        <v-list-tile-title v-html="product.title" />
        </v-list-tile-content>
        <v-list-tile-action>
        <v-list-tile-action-text>${{ product.price }}</v-list-tile-action-text>
    </v-list-tile-action>
    </v-list-tile>
    </v-list-item>
</template>

</v-list>

<shop-cart v-if="e1 === 2"></shop-cart>
</v-content>

  </main>

  <v-card height="56px" id="shopCart">
  <v-bottom-nav absolute value="true" class="transparent">
    <v-btn flat light class="teal--text" @click.native="e1 = 1" :value="e1 === 1">
      <span>商品</span>
      <v-icon>list</v-icon>
    </v-btn>
    <v-btn flat light class="teal--text" @click.native="e1 = 2" :value="e1 === 2">
      <span>購物車</span>
      <v-icon>shopping_cart</v-icon>
    </v-btn>
  </v-bottom-nav>
</v-card>



</v-app>

<md-dialog
    md-close-to="#shopCart"
  ref="dialog1">
  <md-dialog-title>{{ prompt.product.title }}</md-dialog-title>
<md-dialog-content>
    <form>
      <md-input-container>
        <label>數量</label>
        <md-input type="number" v-model="prompt.value"></md-input>
<md-select v-model="prompt.value">
      <md-option v-for="n in [1, 2, 3]" v-bind:value="n">{{ n }}</md-option>
    </md-select>
      </md-input-container>
    </form>
  </md-dialog-content>
<md-dialog-actions>
    <md-button class="md-primary" @click.native="closeDialog('dialog1')">取消</md-button>
    <md-button class="md-primary" @click.native="submitDialog('dialog1')">確定</md-button>
  </md-dialog-actions>
</md-dialog>



<!--<div style="display: flex;flex: 1;-webkit-flex-direction: column">
    <md-toolbar>
        <div class="md-toolbar-container" style="flex: 1">
        <h1 class="md-title">My Title</h1>
        <span style="flex: 1"></span>
            <md-input-container md-inline>
            <label>Initial value</label>
            <md-input v-model="initial"></md-input>
            </md-input-container>
        </div>
    </md-toolbar>

    <md-layout md-column style="-webkit-box-flex: 1;overflow: auto">
    <md-list>
        <md-subheader class="md-inset">商品</md-subheader>
        <md-list-item v-for="product in products">
            <md-avatar md-theme="orange" class="md-avatar-icon md-primary">
                <img src="https://placeimg.com/40/40/people/1" alt="People">
            </md-avatar>

            <div class="md-list-text-container">
                <span>{{ product.title }}</span>
            </div>

            <md-button class="md-icon-button md-list-action">
                <md-icon>info</md-icon>
            </md-button>
        </md-list-item>
    </md-list>
    </md-toolbar>
    </md-layout>

    <md-bottom-bar>
        <md-bottom-bar-item md-icon="shopping_cart">購物車</md-bottom-bar-item>
        <md-bottom-bar-item md-icon="favorite" md-active>Favorites</md-bottom-bar-item>
        <md-bottom-bar-item md-icon="near_me">Nearby</md-bottom-bar-item>
    </md-bottom-bar>

</div>-->
</md-whiteframe>




<!--<md-toolbar class="md-hue-2">
      <div class="md-toolbar-tools">
      </div>
</md-toolbar>-->

    <!--<md-content ng-controller="ordersController" flex>-->


    <!--<md-list flex>
        <md-subheader class="md-no-sticky">3 line item (with hover)</md-subheader>
        <md-list-item class="md-3-line" ng-repeat="product in products" ng-click="null">
            <p>{{product.title}}</p>
        </md-list-item>
    </md-list>-->

        <!--<div layout="row">
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

        <md-button class="md-primary" ng-click="order()">確定</md-button>-->

    <!--</md-content>-->
    <script src="/js/order.js"></script>
</body>
</html>