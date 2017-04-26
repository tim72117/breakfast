import Vue from 'vue';
import VueMaterial from 'vue-material';
import axios from 'axios';
import Vuetify from 'vuetify';

Vue.use(Vuetify);
Vue.use(VueMaterial);

var store = {
    message: 'Hello Vue!',
    e1: 1,
    state: {
        cart: false,
        cart1: false
    },
    products: [],
    prompt: {
        product: {},
        value: 1
    },
    shopCart: {
        items: []
    }
};

const app = new Vue({
    el: '#app',
    data: store,
    created: function() {
        var data = this;
        console.log(this);
        axios.get('/products')
        .then(function (response) {
            console.log(response.data);
            data.products = response.data.products;
        })
        .catch(function (error) {
            /* 失敗，發生錯誤，然後...*/
        });
    },
    methods: {
        openDialog: function(ref, product) {
            console.log(ref);
            this.prompt.product = product;
            this.$refs[ref].open();
        },
        submitDialog: function(ref) {
            var index = this.shopCart.items.indexOf(this.prompt.product);
            if (index > -1) {
                $scope.cart.items[index].amount +=  prompt.value;
            } else {
                $scope.product.amount = $scope.amount;
                $scope.cart.items.push($scope.product);
            }
            this.$refs[ref].close();
        },
        closeDialog: function(ref) {
            this.$refs[ref].close();
        }
    }
});