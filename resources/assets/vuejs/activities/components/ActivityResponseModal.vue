<script>
import ActivityInfoExtra from "./ActivityInfoExtra";
import ActivityDecline from "./ActivityDecline";
export default {
    name: "ActivityResponseModal",
    components: {ActivityDecline, ActivityInfoExtra},
    props: ["act", "type", "id", "time"],
    methods: {
        confirmActivity(event, activity) {
            let btn = event.target;
            btn.classList.add("kt-spinner", "kt-spinner--left", "kt-spinner--md", "kt-spinner--light", "disabled");
            this.$store.dispatch('activities/confirmActivityById', {activity_id: this.activity.id})
                .then(response => {
                    btn.classList.remove("kt-spinner", "kt-spinner--left", "kt-spinner--md", "kt-spinner--light", "disabled");
                })
        },
        declineActivity(event,activity) {
            let btn = event.target;
            this.$bvModal.show("declineModal");
            btn.classList.remove("kt-spinner", "kt-spinner--left", "kt-spinner--md", "kt-spinner--light", "disabled");

        }
    },
    computed: {
        activity() {
            if (this.act) {
                return this.$store.getters['activities/getActivityById'](this.act.id);
            }
        },
        confirmText() {
            if (this.activity.type_signup) {
                console.log("Signup");
                if (this.activity.response_confirmed) {
                    return "Tilmeldt";
                }
                return "Tilmeld";

            } else if (this.activity.type_decline) {

                if (this.activity.response_confirmed) {
                    return "Bekræftet";
                }
                return "Bekræft";
            }
        },
        declineText() {
            if (this.activity.type_decline) {
                if (this.activity.response_declined) {
                    return "Meldt afbud";
                }
                return "Afbud";
            } else if(this.activity.type_signup) {
                if(this.activity.my_activity) {
                    return "Afmeld";
                }
            }
        }
    }
}
</script>

<style scoped>
.kt-widget17 {
    background:#f2f3f8;

}
.kt-widget17__stats {
    margin: 0;
    width: 100%;
}


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
    padding: 0.7rem 0.6rem;
    font-size:0.8rem;
}

</style>
<style>
    @media (max-width: 575px) {
        .modal-body {
            padding:5px;
            background-color: #f2f3f8;
        }
    }

    .we-modal-body {
        background-color: #f2f3f8;
    }
</style>

<template>
    <div>
    <b-modal v-if="activity" :title="'Tilmeld ' + activity.title" id="responseModal" size="md" body-class="we-modal-body kt-pl0-mobile kt-pr0-mobile">
        <div class="we-flex kt-mr-5">
            <div class="we-flex-row kt-pl0">
                <div class="p8-date">
                    <div class="p8-date-mon">{{activity.start_date | formatDate("ddd")}}</div>
                    <div class="p8-date-num">{{activity.start_date | formatDate("DD")}}</div>
                    <div class="p8-date-day">{{activity.start_date | formatDate("MMM")}}</div>

                </div>
            </div>
            <div class="we-flex-row we-flex-grow kt-mt-10">
                <div class="we-flex1">
                    <div class="kt-portlet we-100 response-none" :class="{'response-missing':activity.response_missing, 'response-declined':activity.response_declined, 'response-confirmed':activity.response_confirmed, 'invitational': !activity.my_activity && activity.type && activity.type.signup && activity.response_timestamp > time}" style="border-left: 5px solid">
                        <div class="we-flex">
                            <div class="we-flex-row kt-m10 we-flex-grow">
                                <div class="title kt-font-lg kt-font-bold we-ellipsis">{{ activity.title }}</div>
                                <div class="time-span"> <i class="la la-clock-o" style="font-size: 14px;"></i> {{ activity.start | formatTime("HH:mm") }} - {{ activity.end | formatTime("HH:mm") }} <span v-if="activity.type">{{ activity.type.name }}</span> </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="kt-align-center kt-mb-20">
            <button v-if="activity.type_signup" @click="confirmActivity($event)" type="button" class="btn btn-primary btn-lg" :disabled="activity.response_confirmed" :class="{'disabled':activity.response_confirmed}"><i class="fa fa-plus"></i> {{ confirmText }}</button>
            <button v-if="activity.my_activity && activity.type_decline" @click="confirmActivity($event)" type="button" class="btn btn-success  btn-lg" :disabled="activity.response_confirmed" :class="{'disabled':activity.response_confirmed}"><i class="fa fa-plus"></i> {{ confirmText }}</button>
            <button v-if="activity.my_activity" @click="declineActivity($event)" type="button" class="btn btn-danger  btn-lg" :disabled="activity.response_declined" :class="{'disabled':activity.response_declined}"><i class="fa fa-plus"></i> {{ declineText }}</button>
            <div v-if="!activity.my_activity && activity.type_decline" class="alert alert-secondary  fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                <div class="alert-text">Du er ikke inviteret til at deltage på denne træning eller aktivitet.</div>
                <!--div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div-->
            </div>
        </div>
        <activity-info-extra :activity="activity"></activity-info-extra>



        <template v-slot:modal-footer="{ ok, cancel }">
            <!-- Emulate built in modal footer ok and cancel button actions -->
            <b-button size="sm" class="btn btn-outline-metal" @click="cancel">
                Fortryd
            </b-button>
        </template>
    </b-modal>

    <activity-decline :activity="activity"></activity-decline>
    </div>
</template>
