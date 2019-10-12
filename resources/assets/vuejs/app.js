import './bootstrapper';
import router from './routes';
import store from './store/vuex';
import AdminNav from "./components/AdminNav";
new Vue({
components: { AdminNav },

    el: '#vuejs',
    store,
    router
});
