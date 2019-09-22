import './bootstrapper';
import router from './routes';
import AdminNav from "./components/AdminNav";
new Vue({
components: { AdminNav },

    el: '#vuejs',

    router
});
