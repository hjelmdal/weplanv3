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

new Vue({
    el: '#kt_body',


    data:  {
        activities: [],
        url : '/api/v1/activities/get/' + moment().format("YYYY-MM-DD"),
        next: 0,
        prev: 0,
        start_date: 0,
        end_date:0,
        days:[],
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

        loadOffCanvas(bool) {

            let headerMenuOffcanvas = new KTOffcanvas('kt_offcanvas_01', {
                overlay: true,
                baseClass: 'kt-offcanvas-panel',
                closeBy: 'kt_offcanvas_custom_close',
                toggleBy: {
                    target: 'testid',
                    state: 'kt-header-mobile__toolbar-toggler--active'
                }
            });
            if(bool) {
                let canvasBody = document.getElementById("kt_offcanvas_01_body");
                $(canvasBody).load('/test');
                headerMenuOffcanvas.show();
            } else {
                headerMenuOffcanvas.hide();
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
                headers: { Authorization: document.querySelector('meta[name="api-token"]').getAttribute('content') },
            }).catch(error => {
                if(error.response) {
                    console.log("Error code: " + error.response.status);
                    if(error.response.status == 401) {
                        location.reload();
                    }
                }
            }).then((response) => {
                this.to = response.data.to;
                this.from = response.data.from;
                this.total = response.data.total;
                this.activities = response.data.data;
                this.days = [];
                this.start_date = response.data.start_date;
                this.end_date = response.data.end_date;
                this.next_week = response.data.next_week;
                this.prev_week = response.data.prev_week;

                let last_start_date;
                response.data.data.forEach(event => {
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

                //console.log(this.days);

                this.next = response.data.next_week_url;
                this.prev = response.data.prev_week_url;
                console.log("to: " + this.to + ", total: " + this.total);
                this.setLoadingSpinner(false,btn);
            })



        },
    },

    mounted: function () {
        this.activitiesLoad("reload");






    }

});
