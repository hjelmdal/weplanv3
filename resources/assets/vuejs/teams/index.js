import axios from "axios"
import moment from "moment"
moment.locale("da");
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

Vue.filter('formatNumber', function (value = false) {
    let name = "spillere";
    let len = 0;
    if(value) {
       len = value.length;
       if(len > 1 || len == 0) {
           name = "spillere";
       } else {
           name = "spiller";
       }
       return len + " " + name;
   }

});

new Vue({
    el: '#kt_body',


    data:  {
        teams: [],
        url : '/api/v1/teams',
        authStr: document.querySelector('meta[name="api-token"]').getAttribute('content')
    },

    methods : {

        teamsLoad(string) {

            axios({
                method: 'get',
                url: this.url,
                headers: { Authorization: this.authStr },
            }).catch(error => {
                if(error.response) {
                    console.log("Error code: " + error.response.status);
                    if(error.response.status == 401) {
                        location.reload();
                    }
                }
            }).then((response) => {
                this.teams = response.data.data;

            })



        },
    },

    mounted: function () {
        this.teamsLoad("reload");





    }

});
