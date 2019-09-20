import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import moment from "moment";
import BootstrapVue from "bootstrap-vue";
import 'bootstrap-vue/dist/bootstrap-vue.css';
import { BTooltip } from "bootstrap-vue";
import Form from "./Form";
import Notify from "./Notification";
moment.locale("da");
window.moment = require('moment');

window.Vue = Vue;
Vue.use(VueRouter);
Vue.use(BootstrapVue);
window.Form = Form;
window.Notify = Notify;
window.axios = axios;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'Authorization': apiToken
};


Vue.filter('formatTime', function(value,format = "HH:mm") {
    if (value) {
        return moment(String(value),"HH:mm:ss").format(format)
    }
});
Vue.filter('formatDate', function(value,format = "YYYY-MM-DD") {
    if (value) {
        return moment(String(value),"YYYY-MM-DD").format(format)
    }
});

Vue.filter('dateString', function (value,type = "to") {
    if(type === "to") {
        return moment().to(value);
    } else if(type === "from") {
        return moment().from(value);
    }
});

Vue.component('b-tooltip', BTooltip);
