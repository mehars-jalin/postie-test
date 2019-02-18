require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Router from './routes';
import ParentView from './components/parent';

Vue.use(VueRouter);

Router.beforeEach((to,from,next)    =>  {

    if(to.matched.some(record    =>  record.meta.Auth)){

        if(window.location.href.indexOf('access_token=') > 0){
            var access_token             =       window.location.href.split('access_token=')[1];
            localStorage.setItem('access_token',access_token);
        }else{
            if (localStorage.getItem('access_token') == null) {
                next({
                    path: '/',
                    params: { nextUrl: to.fullPath }
                })
            }
        }

    }else{
        next();
    }
});

const app = new Vue({
    el: '#app',
    router: Router,
    components:{
        'main-app' : ParentView
    }
});
