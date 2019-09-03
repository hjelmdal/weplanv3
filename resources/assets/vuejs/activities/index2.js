import Vue from "vue";
import UserActivities from "./components/UserActivities";
import ActivitiesMyFilter from "./components/ActivitiesMyFilter";
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

Vue.filter('dateString', function (value,type = "to") {
    if(type === "to") {
        return moment().to(value);
    } else if(type === "from") {
        return moment().from(value);
    }
});


new Vue({
    components: {
        UserActivities,ActivitiesMyFilter
    },
    el: "#kt_body",





});
