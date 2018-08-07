import Vue from 'vue';
import Vuex from 'vuex';
import axios from "axios";

Vue.use(Vuex);

export let Store = new Vuex.Store(
    {
        state: {
            jwtDefaultKey: 'portfolio_v1',
            jwt: null,
            user: null,
            carousel: {
                perPage: 3
            },
            recaptcha: {
                siteKey: '6LdO82cUAAAAADqlE_x8y1U-Qc_Dl-JcJ8kWpxbf'
            },
            blockUI: {
                message: 'Please Wait',
                html: null,
                visible: false,
                setDefaults() {
                    this.html = '<i class="fa fa-cog fa-spin fa-3x fa-fw"></i>';
                    this.message = 'Please wait';
                    this.visible = false;
                },
                makeVisible() {
                    this.visible = true;
                },
                setMessage(message) {
                    this.message = message || this.message;
                    this.makeVisible();
                }
            }
        },
        mutations: {
            setToken(state, token) {
                localStorage.setItem(state.jwtDefaultKey, token);
                state.jwt = token;
            },
            setUser(state, user) {
                state.user = user;
            },
            unsetUser(state) {
                state.user = null;
            },
            unsetToken(state) {
                localStorage.removeItem(state.jwtDefaultKey);
                state.jwt = null;
                this.commit('unsetUser');
            }
        },
        actions: {
            logout() {
                this.commit('unsetToken');
            },
            checkUser(force = false) {
                axios.get('/api/user', {headers: {Authorization: `Bearer ${force ? localStorage.getItem('portfolio_v1') : this.state.jwt}`}})
                    .then(success => {
                        this.commit('setUser', success.data.data.user);
                    }, () => {
                    });
            }
        }
    }
);
