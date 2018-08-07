import Vue from 'vue';

export let load = {
    components() {
        return {
            Layout: Vue.component('main-layout', require('../components/Layout')),
            HomePage: Vue.component('homepage', require('../components/HomePage')),
            Projects: Vue.component('projects-page', require('../components/Projects')),
            Technologies: Vue.component('technologies-page', require('../components/Technologies')),
            Header: Vue.component('p-header', require('../components/Header')),
            Footer: Vue.component('p-footer', require('../components/Footer')),
            Contact: Vue.component('contact-me', require('../components/ContactMe')),
            Login: Vue.component('login', require('../components/Login')),
            Admin: {
                Layout: Vue.component('admin-layout', require('../admin/components/Layout')),
                Dashboard: Vue.component('admin-dashboard', require('../admin/components/Dashboard')),
                Users: Vue.component('admin-users', require('../admin/components/Users')),
                Articles: Vue.component('admin-articles', require('../admin/components/Articles')),
                Projects: Vue.component('admin-projects', require('../admin/components/Projects')),
                Feedback: Vue.component('admin-feedback', require('../admin/components/Feedback')),
                Technologies: Vue.component('admin-feedback', require('../admin/components/Technologies')),
            }
        }
    }
};
