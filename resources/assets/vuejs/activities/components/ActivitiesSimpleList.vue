<script>
    import ActivitiesFilters from "./ActivitiesFilters";
    import ActivitiesNav from "./ActivitiesNav";
    import router from "../../routes";
    import ActivityResponseModal from "./ActivityResponseModal";
    export default {
        name: "ActivitiesSimpleList",
        components: {ActivityResponseModal, ActivitiesNav, ActivitiesFilters},
        props:["type","date"],
        data() {
            return {
                time: (new Date).getTime() / 1000,
                filters:[],
                types: [],
                response:{
                    activity: "",
                    type: "",
                    id:""
                }
            }
        },
        methods: {
            getCalendar() {
                let type = this.type;
                let date = this.date;
                if(!this.type) {
                    type = "week";
                } if(!this.date) {
                    date = moment().format("YYYY-MM-DD");
                }

                this.$store.dispatch('activities/getActivities',{ date : date, filters: this.filters, type: type })
            },
            setFilters() {
                if(this.types.length > 0 && (this.filters.indexOf(true) == -1 || this.filters.length == 0)) {
                    this.filters[0] = (false);
                    this.types.forEach(type => {

                        this.filters[type.id] = (true);
                    });
                }

            },
            showActivity(id) {
                return router.push({ name: 'activity.show', params: { id } });
            },
            setTypes() {
                axios.get("/api/v1/activities/types")
                    .then(types => {
                        this.types = types.data.data;
                        this.setFilters();
                    })

            },
            responseModal(activity,type) {
                this.response.activity = activity;
                this.$bvModal.show("responseModal");
            }
        },
        computed: {
            calendar() {
                return this.$store.getters['activities/getCalendar'];
            },
            days() {
                let last_start_date;
                let days = [];
                let activities = this.$store.getters['activities/getActivities'];
                if(activities) {
                    activities.forEach(event => {
                        if (event.start_date === last_start_date) {
                            days[days.length - 1].activities.push(event);
                        } else {
                            days.push({
                                date: event.start_date,
                                activities: [event]
                            });
                        }
                        last_start_date = event.start_date;
                        this.response.activity = event;
                    });
                }
                return days;
            },
            types1() {
                let types = this.$store.getters['activities/getActivityTypes'];
                return types;
            }
        },
        created() {
            this.getCalendar();
            this.setTypes();
            setInterval(() => this.time = Math.floor((new Date).getTime() / 1000), 1000 * 1)
        },
        watch: {
            filters: {
                // the callback will be called immediately after the start of the observation
                immediate: true,
                handler (val, oldVal) {
                    if(oldVal) {
                        this.setFilters();
                        this.getCalendar();
                    }
                }
            },
        }
    }
</script>

<style scoped>
    .we-flex {
        display:flex;
        flex-direction:row;
    }
    .we-flex-grow {
        flex-grow: 1;
        min-width:0;
    }


    .we-100 {
        width:100%;
    }
    .we-flex-row {
        display:flex;
        flex-direction:column;
    }

    .we-flex1 {
        display:flex;
    }
    .we-flex2 {
        display:flex;
    }
    .we-flex5 {
        display:flex;
        align-self:center;
    }
    .we-body {
        margin:10px;
    }
    .we-pill {
        border-radius: 1rem 0rem 0rem 1rem;
    }
    .btn-sm {

    }
    .title {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .we-ellipsis {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .we-response {
        /*min-width:60px;*/
        align-self:center;
    }
    .kt-portlet {
        margin-bottom: 10px;
    }

    .p8-date {
        margin: 10px 10px 10px 0px;
    }
    @media(max-width:575px) {
        .p8-date {
            width:55px;
            margin: 10px 10px 10px 0px;
        }
        .we-flex-row {
            padding:10px 0px;
        }
    }

    @media (max-width: 1024px) {

    }

    .btn-xs [class*=" la-"], .btn [class^=la-] {
        font-size: 1.0rem;
    }

    .response-none {
        border-color: #ddd !important;
    }
    .response-missing {
        border-color: var(--warning) !important;
    }
    .response-confirmed {
        border-color: var(--success) !important;
    }
    .response-declined {
        border-color: var(--danger) !important;
    }
    .invitational {
        border-color: var(--blue) !important;
    }
    .not-invited {
        border-color: #ddd !important;
    }
    .we-btn-flex {
        display:flex;
        align-items:center;
    }
    .we-response-wrapper {
        display:flex;
        flex-direction:column;
    }
    .btn-xs {
        padding: 0.6rem 0.6rem;
        font-size:0.7rem;
    }

</style>

<template>
    <div>
        <activities-nav :showFilters="true" :calendar="calendar" :filters="filters" :types="types"></activities-nav>
        <div class="we-flex" v-for="day in days">
            <div class="we-flex-row kt-pl0">
                <div class="p8-date">
                    <div class="p8-date-mon">{{day.date | formatDate("ddd")}}</div>
                    <div class="p8-date-num">{{day.date | formatDate("DD")}}</div>
                    <div class="p8-date-day">{{day.date | formatDate("MMM")}}</div>

                </div>
            </div>
            <div class="we-flex-row we-flex-grow kt-mt-10">
                <div class="we-flex1" v-for="activity in day.activities">
                    <div class="kt-portlet we-100 response-none" :class="{'response-missing':activity.response_missing, 'response-declined':activity.response_declined, 'response-confirmed':activity.response_confirmed, 'invitational': !activity.my_activity && activity.type && activity.type.signup && activity.response_timestamp > time}" style="border-left: 5px solid">
                        <div class="we-flex">
                            <div class="we-flex-row kt-m10 we-flex-grow">
                                <div class="title kt-font-lg kt-font-bold we-ellipsis">{{ activity.title }}</div>
                                <div class="time-span"> <i class="la la-clock-o" style="font-size: 14px;"></i> {{ activity.start | formatTime("HH:mm") }} - {{ activity.end | formatTime("HH:mm") }} <span v-if="activity.type">{{ activity.type.name }}</span> </div>
                            </div>
                            <div v-if="activity.type" class="we-flex-row kt-pr0 we-response">
                                <button @click="showActivity(activity.id)" v-if="activity.response_timestamp < time || !activity.my_activity && !activity.type.signup || (activity.response_confirmed || activity.response_declined)" type="button" class="btn btn-outline-hover-info btn-elevate btn-icon" style="align-self:flex-end">
                                    <span class="we-btn-flex"></span><i class="la la-chevron-right"></i>
                                </button>
                                <button @click="responseModal(activity,'signup')" v-if="!activity.my_activity && activity.type.signup && activity.response_timestamp > time" type="button" class="btn btn-xs btn-brand btn-elevate btn-pill we-pill"><span class="we-btn-flex"><i class="la la-plus"></i> Tilmeld</span></button>

                                <span class="we-response-wrapper" v-if="activity.response_timestamp > time && activity.response_missing">
                    <button v-if="activity.my_activity" type="button" class="btn btn-xs btn-success btn-elevate btn-pill we-pill kt-mb-5"><span class="we-btn-flex"><i class="la la-check"></i> Bekræft</span></button>
                    <button v-if="activity.my_activity" type="button" class="btn btn-xs btn-brand btn-elevate btn-pill we-pill"><span class="we-btn-flex"><i class="la la-close"></i> Afbud</span></button>
</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <activity-response-modal :activity="response.activity" :type="response.type" :id="responseModal"></activity-response-modal>
    </div>
</template>
