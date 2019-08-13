import Vue from "vue";
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

Vue.directive('tooltip', function(el, binding){
    $(el).tooltip({
        title: binding.value,
        placement: binding.arg,
        trigger: 'hover'
    })
});

new Vue({
    el: '#kt_body',


    data:  {
        teams: [],
        url : '/api/v1/teams',
        authStr: document.querySelector('meta[name="api-token"]').getAttribute('content')
    },

    computed : {

    },



    methods : {

        teamsLoad(string) {
            KTApp.blockPage();

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
                let i;

                response.data.data.forEach(event => {
                    event.men = 0;
                    event.women = 0;
                    event.menP = 0;
                    event.womenP = 0;
                    if(event.players.length > 0) {
                        event.players.forEach(player => {
                           if(player.gender === "M") {
                               event.men++;
                           } else if(player.gender === "K") {
                               event.women++;
                           }
                        });
                        if(event.max_players > 0) {
                            if(event.men + event.women > event.max_players) {
                                event.menP = Math.round(event.men / (event.men + event.women) * 100);
                                event.womenP = Math.round(event.women / (event.men + event.women) * 100);

                            } else {
                                event.menP = Math.round(event.men / event.max_players * 100);
                                event.womenP = Math.round(event.women / event.max_players * 100);
                            }

                        }
                    }

                    console.log(event);
                    i++;
                });


            });
            Vue.nextTick(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            KTApp.unblockPage();



        },


    },

    mounted: function () {
        this.teamsLoad("reload");






    }

});
