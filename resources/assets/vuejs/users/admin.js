import Vue from "vue";
import usersAdmin from "./components/usersAdmin";
import moment from "moment";
moment.locale("da");


window.Event = new Vue();
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

new Vue({
    components: {
        usersAdmin
    },
    el: "#kt_body"




});