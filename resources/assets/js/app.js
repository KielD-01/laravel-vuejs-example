import Vue from 'vue';
import axios from 'axios';
import 'vue-awesome/icons'
import Meta from 'vue-meta';
import VueTour from 'vue-tour'
import 'vue-awesome/icons/flag'
import VueAxios from 'vue-axios';
import BlockUI from 'vue-blockui';
import VueRouter from 'vue-router';
import {sync} from 'vuex-router-sync';
import {Store} from './config/storage';
import {Routes} from "./config/routes";
import VueCarousel from 'vue-carousel';
import VeeValidate from 'vee-validate';
import Vue2Sidebar from 'vue2-sidebar';
import BootstrapVue from 'bootstrap-vue';
import VueSweetalert2 from 'vue-sweetalert2';
import Icon from 'vue-awesome/components/Icon'
import * as VueGoogleMaps from 'vue2-google-maps'

require('./bootstrap');

axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel;

Vue.use(Meta);
Vue.use(BlockUI);
Vue.use(VueTour);
Vue.use(VueRouter);
Vue.use(VueCarousel);
Vue.use(VeeValidate);
Vue.use(Vue2Sidebar);
Vue.use(BootstrapVue);
Vue.use(VueSweetalert2);
Vue.use(VueAxios, axios);
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyCF4MLwPQDo8fw4Lx3kyKj2l-TLrgBTs4c',
        libraries: 'places',
        // v: '3.26',
    },
});

Vue.component('icon', Icon);

sync(Store, Routes);

Routes.beforeEach((to, from, next) => {
    let user = null;
    const isAdminMatch = /(admin)/g;
    const isLoginMatch = /(login)/g;

    if (isAdminMatch.exec(to.name) !== null) {
        Store.state.blockUI.setMessage('Checking Permissions');
        return axios.get('/api/user', {headers: {Authorization: `Bearer ${localStorage.getItem('portfolio_v1')}`}})
            .then(success => {
                Store.state.blockUI.setDefaults();

                user = success.data.data.user;

                if (user !== null) {

                    if (isLoginMatch.exec(to.name)) {
                        next({name: from.name});
                    }

                    Store.state.user = user;

                    if (user.role !== 'su') {
                        next({name: 'home'});
                    }
                }

                next();

            })
            .catch(() => {
                Store.state.blockUI.setDefaults();
                next({path: '/login'});
            });
    }

    return next();
});

new Vue({
    el: '#app',
    store: Store,
    router: Routes,
    created() {
        this.$store.state.jwt = localStorage.getItem(this.$store.state.jwtDefaultKey);
        this.$store.state.blockUI.setDefaults();
    },
    mounted() {
    },
    methods: {
        showTour(tour) {
            this.$tours[tour].start();
        }
    }
});


