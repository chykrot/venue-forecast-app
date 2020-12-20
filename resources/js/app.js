require('./bootstrap');
import Vue from 'vue'

import App from './components/App.vue'
import * as VueGoogleMaps from 'vue2-google-maps'
import i18n from './utility/i18n';


Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyCUjrqneaRACKjJy5lke_l4Smn7-KFVYZc',
    }
  
});


const app = new Vue({
    i18n,
    el: '#app',
    components: { App }
});