import './bootstrapper';
import router from './routes';
import store from './store/vuex';
import AdminNav from "./components/AdminNav";
import PageTitle from "./components/PageTitle";
new Vue({
components: { AdminNav, PageTitle},

    el: '#vuejs',
    store,
    router
});
