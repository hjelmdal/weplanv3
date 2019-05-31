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
        info: 0,
        today: document.querySelector('meta[name="start-date"]').getAttribute('content'),
        tomorrow:0,
        yesterday:0,
        start_date: document.querySelector('meta[name="start-date"]').getAttribute('content'),
        end_date:0,
        activities: [],
        uri: '/api/v1/calendar/',
        url: '/api/v1/calendar/' + document.querySelector('meta[name="start-date"]').getAttribute('content'),
        next: 0,
        prev: 0,
        days:[],
        players:[],
        to: 0,
        from: 0,
        total: 0,
        next_week: 0,
        prev_week: 0,
        authStr: document.querySelector('meta[name="api-token"]').getAttribute('content')
    },

    methods : {
        setLoadingSpinner(bool,string) {
            let elem = document.getElementById(string);
            if(bool) {
                elem.classList.add("kt-spinner", "kt-spinner--center", "kt-spinner--md", "kt-spinner--light");
            } else {
                elem.classList.remove("kt-spinner", "kt-spinner--right", "kt-spinner--md", "kt-spinner--light");
            }
            return true;
        },

        activitiesLoad(string) {
            let btn = "null";
            if(!document.querySelector('meta[name="api-token"]').getAttribute('content')) {
                location.reload();
            }
            if(string == "next") {
                this.url = this.next;
                 btn = "btnNext";
            } else if(string == "prev") {
                this.url = this.prev;
                btn = "btnPrev";
            } else if(string == "reload") {
                console.log("Reloading");
                btn = "btnNext";
            }
            this.setLoadingSpinner(true,btn);

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
                this.info = response.data.data;
                this.to = response.data.to;
                this.from = response.data.from;
                this.total = response.data.total;
                this.activities = response.data.activities;
                this.days = [];
                this.players = response.data.players;
                this.start_date = response.data.start_date;
                this.end_date = response.data.end_date;
                this.today = this.info.today;
                this.yesterday = this.info.yesterday;
                this.tomorrow = this.info.tomorrow;

                let last_start_date;
                this.activities.forEach(event => {
                    if(event.start_date === last_start_date) {
                        this.days[this.days.length-1].events.push(event);
                    } else {
                        this.days.push({
                            date: event.start_date,
                            events: [event]
                        });
                    }
                    last_start_date = event.start_date;
                });


                this.next = this.uri + this.tomorrow;
                this.prev = this.uri + this.yesterday;
                //console.log("to: " + this.to + ", total: " + this.total);
                history.pushState(null,"", this.url);
                this.setLoadingSpinner(false,btn);
            });
            Vue.nextTick(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })



        },
    },

    mounted: function () {
        this.activitiesLoad("reload");





    }

});