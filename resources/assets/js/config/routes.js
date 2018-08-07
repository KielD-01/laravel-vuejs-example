import VueRouter from 'vue-router';
import {load} from './loader';
import axios from "axios";

const components = load.components();

const Routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: components.HomePage,
            name: 'home'
        },
        {
            path: '/login',
            component: components.Login,
            name: 'login'
        },
        {
            path: '/projects',
            component: components.Projects,
            name: 'projects'
        },
        {
            path: '/technologies',
            component: components.Technologies,
            name: 'tech'
        },
        {
            path: '/contact',
            component: components.Contact,
            name: 'contact-me',
        },
        {
            path: '/admin',
            component: components.Admin.Layout,
            children: [
                {
                    path: '',
                    component: components.Admin.Dashboard,
                    name: 'admin.dashboard'
                },
                {
                    path: 'projects',
                    component: components.Admin.Projects,
                    name: 'admin.projects'
                },
                {
                    path: 'articles',
                    component: components.Admin.Articles,
                    name: 'admin.articles'
                },
                {
                    path: 'feedback',
                    component: components.Admin.Feedback,
                    name: 'admin.feedback',
                },
                {
                    path: 'users',
                    component: components.Admin.Users,
                    name: 'admin.users',
                },
                {
                    path: 'technologies',
                    component: components.Admin.Technologies,
                    name: 'admin.tech',
                },
            ]
        }
    ]
});

export {Routes};
