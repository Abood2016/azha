require('./bootstrap');

require('alpinejs');

import firebase from 'firebase/app';
require("firebase/firestore");

const firebaseConfig = {
    apiKey: "AIzaSyDfXuGSOOOU6pyG4VRFLEr4zXGMWaKmFAo",
    authDomain: "deliveryapp-ed0f5.firebaseapp.com",
    databaseURL: "https://deliveryapp-ed0f5-default-rtdb.firebaseio.com/",
    projectId: "deliveryapp-ed0f5",
    storageBucket: "deliveryapp-ed0f5.appspot.com",
    messagingSenderId: "521804932683",
    appId: "1:521804932683:web:ae476cd8438461a5c20fce",
    measurementId: "G-9Y2G6ELMMM"
  };

firebase.initializeApp(firebaseConfig);
window.firebase = firebase

import Vue from 'vue'
import 'livewire-vue'
import * as GmapVue from 'gmap-vue';
import Select2 from 'v-select2-component';
Vue.component('Select2', Select2);
import vSelect from 'vue-select'

Vue.component('v-select', vSelect)
window.Vue = Vue;
import VueNotify from 'vuejs-notify';
Vue.use(VueNotify) // use defaults
Vue.use(VueNotify, {/*...or overwrite them*/})
Vue.component('star-rating', require('./components/StarRating.vue').default);
Vue.component('drivers-map', require('./components/DriversMap.vue').default);
Vue.component('location-map', require('./components/LocationMap.vue').default);
Vue.component('business-order-map', require('./components/Business/BusinessOrderMap.vue').default);
Vue.component('place-map', require('./components/PlaceMap.vue').default);
Vue.component('customer-location-map', require('./components/CustomerLocationMap.vue').default);
Vue.component('route-map', require('./components/RouteMap.vue').default);
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)

Vue.use(GmapVue, {
    load: {
        key: 'AIzaSyCiF79nNWttqCQcYcFYToE5XS1qJFbAUhY',
        libraries: 'places',
    }
});


