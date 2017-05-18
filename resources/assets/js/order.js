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
    },
    items: []
};

var shopCart = {
    data: function() {
        return {
            products: []
        };
    },
    template: `
    <div style="padding: 10px">
        <md-card v-for="(product, index) in products" style="margin-bottom: 10px">
        <md-card-area>
        <md-card-header>
            <md-card-header-text>
                <div class="md-title">{{ product.title }}</div>
                <div class="md-subhead">{{ product.amount }}</div>
            </md-card-header-text>
            <md-card-media>
                <img v-bind:src="product.image" style="" />
            </md-card-media>
        </md-card-header>
        </md-card-area>
        <md-card-actions>
            <md-button class="md-primary" v-on:click.native="drop(product, index)">移除</md-button>
        </md-card-actions>
        </md-card>

    </div>
    `,
    created: function() {
        var vm = this;
        console.log(vm);
        axios.get('/cart')
        .then(function (response) {
            vm.products = response.data.products;
        })
        .catch(function (error) {
            /* 失敗，發生錯誤，然後...*/
        });
    },
    methods: {
        drop: function(product, index) {
            console.log(index);
            axios.delete('/cart/item/' + product.id)
            .then(function (response) {
                console.log(response.data);
                store.products = response.data.products;
            })
            .catch(function (error) {
                /* 失敗，發生錯誤，然後...*/
            });
            this.products.splice(index, 1);
        }
    }
}

const app = new Vue({
    el: '#app',
    data: store,
    components: {
        'shop-cart': shopCart
    },
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
            this.prompt.value = 1;
            this.$refs[ref].open();
        },
        submitDialog: function(ref) {
            // var index = this.shopCart.items.indexOf(this.prompt.product);
            // if (index > -1) {
            //     $scope.cart.items[index].amount +=  prompt.value;
            // } else {
            //     $scope.product.amount = $scope.amount;
                this.shopCart.items.push(this.prompt.product);
            // }
            axios.post('/cart', {
                item: this.prompt.product
            })
            .then(function (response) {
                console.log(response.data);
            })
            .catch(function (error) {
                /* 失敗，發生錯誤，然後...*/
            });
            this.$refs[ref].close();
        },
        closeDialog: function(ref) {
            this.$refs[ref].close();
        },
        removeCart: function() {
            console.log(1);
            shopCart.data.products = [];
            console.log(1);
            axios.delete('/cart')
            .then(function (response) {
                store.products = response.data.products;
            })
            .catch(function (error) {
                /* 失敗，發生錯誤，然後...*/
            });
        },
        checkout: function() {
            console.log(1);
        }
    }
});