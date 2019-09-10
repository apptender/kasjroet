import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import axios from 'axios';
import {debounce} from 'lodash';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested_width'] = 'XMLHttpRequest';
window.apiUrl = 'https://ishetkoosjer.nl/api/';

if (process.env.NODE_ENV == 'development') {
  window.apiUrl = 'http://kasjroet.test/api/';
}
Vue.use(VueRouter);
Vue.component('header-component', require('./components/HeaderComponent').default);
Vue.component('message', require('./components/Utils/Message').default);
Vue.component('panel', require('./components/Utils/Panel').default);
Vue.component('multiselect', require('./components/Utils/Multiselect').default);
Vue.component('dropdown', require('./components/Utils/Dropdown').default);
Vue.component('toggle', require('./components/Utils/Toggle').default);
Vue.component('search', require('./components/Utils/Search').default);
Vue.filter('capitalize', function (value) {
  if (!value) return '';
  value = value.toString();
  return value.charAt(0).toUpperCase() + value.slice(1)
});

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    filters: {
      capitalize: function (value) {
        if (!value) return ''
        value = value.toString()
        return value.charAt(0).toUpperCase() + value.slice(1)
      }
    }
});
