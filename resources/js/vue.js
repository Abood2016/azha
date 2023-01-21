import Vue from 'vue'
import 'livewire-vue'

window.Vue = Vue

Vue.component('drivers-map', require('./components/DriversMap.vue').default);

import * as GmapVue from 'gmap-vue'

Vue.use(GmapVue, {
    load: {
        key: 'AIzaSyCiF79nNWttqCQcYcFYToE5XS1qJFbAUhY'
    }
});

const app = new Vue({
    el: '#app',
});