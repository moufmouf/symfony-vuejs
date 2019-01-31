import Vue from 'vue';
import App from './App';
import apolloProvider from './graphql'
import router from './router';
import store from './store';

new Vue({
    template: '<App/>',
    components: { App },
    router,
    store,
    apolloProvider,
}).$mount('#app');