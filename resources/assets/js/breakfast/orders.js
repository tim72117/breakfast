angular.module('breakfast', [])

.directive('orders', function() {
    return {
        restrict: 'E',
        replace: true,
        transclude: false,
        scope: {

        },
        template:  `
            <md-content>
                <md-card md-theme="default" ng-repeat="order in orders | orderBy:'wait'" layout="row">
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
                    <md-card-actions flex="30" layout="row" layout-align="center center">
                        <md-button style="height:100%;font-size:40px" ng-click="checkout(order)">$ {{order.total}}</md-button>
                    </md-card-actions>
                </md-card>
            </md-content>
        `,
        controller: function($scope, $http, $timeout) {
            var promise;
            function getOrders() {
                $http({method: 'GET', url: 'orders', data: {}})
                .success(function(data) {
                    console.log(data);
                    $scope.orders = data.orders;
                    promise = $timeout(getOrders, 3000);
                }).error(function(e) {
                    document.write(e);
                    console.log(e);
                });
            }

            getOrders();

            $scope.$on('$destroy', function() {
                $timeout.cancel(promise);
            });

            $scope.checkout = function(order) {
                console.log(order);
                $http({method: 'POST', url: 'checkout', data: {order_id: order.id}})
                .success(function(data) {
                    console.log(data);
                    $scope.orders = data.orders;
                }).error(function(e) {
                    console.log(e);
                });
            };
        }
    };
})

.directive('materials', function() {
    return {
        restrict: 'E',
        replace: true,
        transclude: false,
        scope: {

        },
        template:  `
            <md-content>
                <md-grid-list md-cols-xs="1" md-cols-sm="2" md-cols-md="3" md-cols-gt-md="6" md-row-height="2:2" md-gutter="12px" md-gutter-gt-sm="8px">
                    <md-grid-tile ng-repeat="material in materials | filter: {amount: '!!'}" md-colors="{backgroundColor: 'grey'}" md-rowspan="1" md-colspan="1">
                        <img ng-src="{{images[material.id]}}" class="md-card-image" alt="Washed Out"><h1> X {{material.amount || 0}}</h1>
                        <md-grid-tile-footer><h1>{{material.title}} X {{material.amount || 0}}</h1></md-grid-tile-footer>
                    </md-grid-tile>
                </md-grid-list>
            </md-content>
        `,
        controller: function($scope, $http, $timeout) {
            $scope.images = {
                1: '/images/128-128-661117d81dd8ad0fa59a79fda9ca6425-egg.png',
                2: '/images/128-128-161155927d849dfecb1cd5eaf62e822a-drumstick.png',
                3: '/images/128-128-7d724eef55c678bd635f35c6f8337fa3-burger.png',
                4: '/images/128-128-23d1edbc2f697ebeb75dc718db6d60e6-bread.png'
            };
            var promise;
            function getMaterials() {
                $http({method: 'GET', url: 'materials', data: {}})
                .success(function(data) {
                    console.log(data);
                    $scope.materials = data.materials;
                    //promise = $timeout(getMaterials, 3000);
                }).error(function(e) {
                    document.write(e);
                    console.log(e);
                });
            }

            getMaterials();

            $scope.$on('$destroy', function() {
                $timeout.cancel(promise);
            });
        }
    };
})