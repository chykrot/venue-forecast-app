require('./bootstrap');
import Vue from 'vue'

import App from './components/App.vue'
import * as VueGoogleMaps from 'vue2-google-maps'


Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyCUjrqneaRACKjJy5lke_l4Smn7-KFVYZc',
    }
  
});


const app = new Vue({
    el: '#app',
    components: { App }
});