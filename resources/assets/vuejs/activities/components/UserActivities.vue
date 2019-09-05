<script>
    import axios from "axios";
import ActivitiesNav from "./ActivitiesNav";
    import ActivitiesFilters from "./ActivitiesFilters";
    import ActivitiesList from "./ActivitiesList";
    import Form from "../../Form";
export default {
    name: "ActivitiesUser",
    components: {ActivitiesList, ActivitiesFilters, ActivitiesNav},
    data() {
        return {
            activities: [],
            url : '/api/v1/activities/get/' + moment().format("YYYY-MM-DD"),
            uri: '/api/v1/activities/get/',
            confirmUrl: '/api/v1/activities/confirm',
            confirmForm: new Form({
                activity_id: "",
            }),
            declineUrl: '/api/v1/activities/decline',
            meta: document.querySelector('meta[name="start-date"]').getAttribute('content'),
            days:[],
            types:[],
            to: 0,
            from: 0,
            total: 0,
            calendar: {
                next_week: 0,
                prev_week: 0,
                next: 0,
                prev: 0,
                start_date: 0,
                end_date:0,
                today: moment().format("YYYY-MM-DD"),
                now: (new Date).getTime(),
            },
            decline_activity: "test",
            decline_start_date: "",
            decline_end_date: "",
            decline_players: [],
            user:0,
            user_role:0,
            filters: [],
            filter_my: false,
            hover: false,
            authStr: document.querySelector('meta[name="api-token"]').getAttribute('content')
        }
    },
    methods : {
        myActivities(events) {
            return events.filter(item => {
                return item.my_activity == true;
            })
        },
        nullCheck(prop) {
            if(prop === null) {
                return 0;
            } else {
                return prop;
            }
        },
        setLoadingSpinner(bool,string) {
            let elem = document.getElementById(string);
            if(bool) {
                //elem.classList.add("kt-spinner", "kt-spinner--center", "kt-spinner--md", "kt-spinner--light");
            } else {
                //elem.classList.remove("kt-spinner", "kt-spinner--right", "kt-spinner--md", "kt-spinner--light");
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
            let firstLoad = false;
            if(!document.querySelector('meta[name="api-token"]').getAttribute('content')) {
                location.reload();
            }
            if(string == "next") {
                this.reload = 0;
                this.url = this.calendar.next;
                btn = "btnNext";
            } else if(string == "prev") {
                this.reload = 0;
                this.url = this.calendar.prev;
                btn = "btnPrev";
            } else if(string == "reload" || string == "today") {
                this.reload = 1;
                if(string == "today") {
                    this.calendar.start_date = this.calendar.today;
                    this.reload = 0;
                }

                if(this.calendar.start_date) {
                    firstLoad = false;
                    this.url = this.uri + this.calendar.start_date;
                } else {
                    firstLoad = true;
                    let newDate = moment(this.meta);
                    if (newDate.isValid()) {
                        this.url = this.uri + this.meta;
                    }
                }
                //console.log(this.url);
                btn = "btnNext";

            }
            console.log(this.url);
            this.setLoadingSpinner(true,btn);
            let postData = [];
            postData = {
                "filters" : this.filters,
            },

                axios({
                    method: 'post',
                    data: postData,
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
                    this.types = response.data.types;
                    this.to = response.data.to;
                    this.from = response.data.from;
                    this.total = response.data.total;
                    this.activities = response.data.data;
                    this.days = [];
                    this.calendar.start_date = response.data.start_date;
                    this.end_date = response.data.end_date;
                    this.calendar.next_week = response.data.next_week;
                    this.calendar.prev_week = response.data.prev_week;
                    this.user = response.data.user;

                    if(this.user.roles && this.user.roles.length) {
                        this.user_role = this.user.roles[0].id;
                    }
                    let last_start_date;
                    if(this.activities) {
                        this.activities.forEach(event => {
                            if (event.start_date === last_start_date) {
                                this.days[this.days.length - 1].events.push(event);
                            } else {
                                this.days.push({
                                    date: event.start_date,
                                    events: [event]
                                });
                            }
                            last_start_date = event.start_date;

                        });
                    }
                    if(firstLoad || this.filters.indexOf(true) == -1) {
                        this.filters[0] = (false);
                        this.types.forEach(type => {
                            this.filters[type.id] = (true);
                        });
                    }

                    //console.log(this.days);

                    this.calendar.next = response.data.next_week_url;
                    this.calendar.prev = response.data.prev_week_url;
                    if(this.reload === 0) {
                        history.pushState(null, "", "/activities/date/" + this.calendar.start_date);
                    }
                    this.setLoadingSpinner(false,btn);
                })



        },


        confirmActivity(event,activity) {
            let btn = event.target;
            btn.classList.add("kt-spinner", "kt-spinner--center", "kt-spinner--md", "kt-spinner--light");
            let postData = []
            this.confirmForm.activity_id = activity.id;
            this.confirmForm.post(this.confirmUrl)
                .catch(error => {
                    if(error.response) {
                        console.log("Error code: " + error.response.status);
                        if(error.response.status == 401) {
                            location.reload();
                        }
                        btn.classList.remove("kt-spinner", "kt-spinner--center", "kt-spinner--md", "kt-spinner--light");
                    }
                })
                .then(data => {
                    console.log(data.data);
                    this.activitiesLoad("reload");
                    btn.classList.remove("kt-spinner", "kt-spinner--center", "kt-spinner--md", "kt-spinner--light");
                    this.toastr("Du er nu tilmeldt aktiviteten", "success");
                });



        },
        declineActivity(event,activity) {
            let btn = document.getElementById("declineSubmit");
            btn.classList.add("kt-spinner", "kt-spinner--center", "kt-spinner--md", "kt-spinner--light");
            let postData = [];
            postData = {
                "activity_id" : this.decline_activity,
                "start_date" : this.decline_start_date,
                "end_date" : this.decline_end_date,
                "players" : this.decline_players,
            },
                axios({
                    method: 'post',
                    url: this.declineUrl,
                    headers: {Authorization: document.querySelector('meta[name="api-token"]').getAttribute('content')},
                    data: postData
                }).catch(error => {
                    if(error.response) {
                        console.log("Error code: " + error.response.status);
                        if(error.response.status == 401) {
                            location.reload();
                        }
                        btn.classList.remove("kt-spinner", "kt-spinner--center", "kt-spinner--md", "kt-spinner--light");
                    }
                }).then((response) => {
                    console.log(response.data);
                    btn.classList.remove("kt-spinner", "kt-spinner--center", "kt-spinner--md", "kt-spinner--light");
                    this.activitiesLoad("reload");
                    this.toastr("Dit afbud er registreret!", "error");
                    $('#modal1').hide();
                    $('.modal-backdrop').hide();
                    this.hideDeclineModal(this.decline_activity);
                });
        },


        showDeclineModal(event,activity) {
            this.decline_activity = activity.id;
            this.decline_start_date = activity.start_date;
            this.decline_end_date = activity.end_date;
            this.decline_players = activity.players;
        },

        hideDeclineModal(id,timeout = false) {
            //this.hover = false;
            let timeout1 = timeout;
            if(!timeout1) {
                timeout1 = 500;
            }
            console.log("hide modal id: " + id);
            let item = document.getElementById("elem-" + id);
            this.hover = 0;
            this.hover = id;
            item.classList.add("active");


        },

        hideMouseOver() {
            this.hover = 0;
        },

        toastr(message,type = false) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            if(type == "info") {
                toastr.info(message);
            } else if(type == "warning") {
                toastr.warning(message);
            } else if(type == "error") {
                toastr.error(message);
            } else if(type == "success") {
                toastr.success(message);
            } else {
                toastr.info(message);
            }
        },

    },



    mounted() {
        this.$root.$on('activitiesLoad', data => {
            this.activitiesLoad(data);
        }),

        this.$root.$on("confirmActivity", data => {
            this.confirmActivity(data.event,data.activity);
        }),

        this.activitiesLoad("reload");


    },
    created () {
        setInterval(() => this.calendar.now = Math.floor((new Date).getTime() / 1000), 1000 * 1)
    }
}
</script>

<style scoped>

</style>

<template>
    <div>
        <activities-nav :calendar="calendar"></activities-nav>
        <activities-filters :filters="filters" :types="types"></activities-filters>
        <activities-list :user_role="user_role" :calendar="calendar" :days="days"></activities-list>

    </div>
</template>
