import './bootstrapper';
import router from './routes';
import store from './store/vuex';
import AdminNav from "./components/AdminNav";
import PageTitle from "./components/PageTitle";
import BreadCrumb from "./components/BreadCrumb";
new Vue({
components: { AdminNav, PageTitle, BreadCrumb},

    el: '#vuejs',
    store,
    router,
    created() {
        this.$store
    }
});
