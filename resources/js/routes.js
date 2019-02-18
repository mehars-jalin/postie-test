import VueRouter from 'vue-router';
import Home from './components/home';
import ListScores from './components/list_scores';

let routes  =   [
    {
        path        :   '/',
        component   :   Home,
        name        :   'home'
    },
    {
        path        :   '/list-scores',
        component   :   ListScores,
        meta        :   {
            Auth  :   true
        }
    },
    {
        path        :   '/logout',
        component   :   logout(),
        meta        :   {
            Auth  :   true
        }
    }
];

export function logout(){
    localStorage.clear('access_token');
    window.location.href="/postie-test/public/list-scores";
}

export default new VueRouter({
                            'base' : '/postie-test/public/',
                            routes,
                            mode: 'history',
                        });