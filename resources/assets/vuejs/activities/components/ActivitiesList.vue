<script>
import Modal from "../../components/modal"
import ActivityInfoModal from "./ActivityInfoModal";
import DeclineModalContent from "./DeclineModalContent";
export default {
    name: "ActivitiesList",
    components: {
        DeclineModalContent,
        ActivityInfoModal,
        Modal
    },
    props:["calendar","days"],
    data() {
        return {
            hover:false,
            user_role:2,
            modalData:{
                id:"actModal",
                title:"",
                activity:Object
            },
            declineModal: {
                id:"declineModal1",
                title:"",
                activity:Object
            }

        }
    },
    methods: {
        activityShow(activity) {
            if (typeof activity === 'object') {
                this.modalData.title = activity.title;
                this.modalData.activity = activity;
                this.declineModal.title = "Afbud til " + activity.title;
                this.declineModal.activity = activity;
            } else {
                return false;
            }
        },
        getBgClass(activity) {
            if(activity.my_activity) {

                let pivot = activity.my_status;
                if(pivot == 0) {
                    return "kt-bg-light-danger";
                } else if(pivot == 2) {
                    return "kt-bg-light-success";
                } else if(pivot == 1) {
                    return "kt-bg-light-warning";
                }

            } else if(activity.type && activity.type.signup == 1) {
                return "kt-bg-light-brand";
            }
            return false;
        },
        updateModal() {
            let found = false;

            if(this.days.length > 0) {

                this.days.forEach(day => {
                    if(day.events.length > 0) {

                        day.events.forEach(event => {
                            if (this.modalData.activity && event && this.modalData.activity.id == event.id) {
                                this.modalData.activity = event;

                            }
                        })

                    }
                })
            }
        }
    },
    watch: {
        days: {
            // the callback will be called immediately after the start of the observation
            immediate: true,
            handler (val, oldVal) {
                this.updateModal();
                console.log('Prop changed: ', val, ' | was: ', oldVal)
            }
        }
    },
}
</script>

<style scoped>
    .info-block {
        height: 12px;
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
        position: absolute;
        left: -20px;
        width: 34px;
        max-width: 34px;
        text-overflow: ellipsis;
        overflow: hidden;
        top: 15px;
        display: inline-block;
    }
    .row-column {
        margin-left:0.5rem;
    }
    .alarm-span {
        margin-right: 1rem;
    }
    .div-time {
        justify-content: space-between;
    }
    .div-row {
        position: relative;
    }
</style>

<template>
    <div>
       <div v-if="days.length == 0" class="col-12 card1  kt-margin-b-20">
            <div class="flex-left"></div>
            <div class="flex-center">
                <div class="div-row" style="background-color: #fff; justify-content: center">Der blev ikke fundet nogle aktiviteter i denne uge!</div>
            </div>
        </div>



        <div v-for="day in days" class="col-12 card1  kt-margin-b-20" v-bind:class="{'activity-done-bg' :(calendar.today > day.date)}">
                <div class="flex-left">
                    <div class="div-date">
                        <div class="p8-date">
                            <div class="p8-date-mon">{{day.date | formatDate("MMM")}}</div>
                            <div class="p8-date-num">{{day.date | formatDate("DD")}}</div>
                            <div class="p8-date-day">{{day.date | formatDate("ddd")}}</div>

                        </div>
                    </div>
                    <div class="div-date">
                        <div v-if="day.events.length > 1" class="p8-date kt-align-center" style="border:0px">
                            <img src="/img/activities/palm_tree.svg">
                        </div>
                        <div v-else class="p8-date kt-align-center" style="border:0px">
                            <img src="/img/activities/injury.svg">
                        </div>
                    </div>
                </div>
                <div class="flex-center" style="width: calc(100% - 86px);">
                    <template v-for="activity in day.events">
                        <div v-bind:id="'elem-' + activity.id" class="div-row" :class="getBgClass(activity)">
                            <span style="height:12px" data-toggle="kt-tooltip"  class="badge kt-font-white badge-sm info-block" v-bind:class="{'badge-success':(activity.type_id == 1), 'badge-danger':(activity.type_id == 2), 'badge-primary':(activity.type_id == 3), 'badge-warning':(activity.type_id == 4)}">{{ activity.type.name }}</span>
                            <div class="row-column" v-bind:class="{'bef-brand':(activity.type.signup == 1), 'bef-warning':(activity.my_activity && activity.my_status == 1), 'bef-danger':(activity.my_activity && activity.my_status == 0), 'bef-success':(activity.my_activity && activity.my_status == 2), 'bef-metal':(activity.type.decline == 1 && activity.my_activity == false)}">
                                <span class="div-text" style="font-size: 1.5rem;">{{ activity.title }}</span>
                                <div class="div-time" style="display: flex;">
                                    <span class="time-span">
                                        <i class="la la-clock-o" style="font-size: 14px;"></i> {{ activity.start | formatTime("HH:mm") }} - {{ activity.end | formatTime("HH:mm") }}
                                    </span>
                                    <span class="alarm-span" v-if="activity.my_activity || activity.type.signup"><img src="/img/activities/alarm_clock.svg"> {{ activity.response_date + " " + activity.response_time | dateString("to") }}</span>


                                </div>

                            </div>
                            <div class="div-right" style="align-self: center; width: 40px; text-align: right;">
                            <span v-if="(activity.my_activity === true || activity.type.signup) && calendar.now < activity.response_timestamp"  class="btn btn-outline-success btn-icon btn-icon-md" title="RSVP" @click="activityShow(activity)" data-toggle="modal" :data-target="'#'+modalData.id" href="#" >
                                <i class="la la-calendar-o"></i>
                            </span>
                                <span @click="activityShow(activity)" data-toggle="modal" :data-target="'#'+modalData.id" href="#" v-else class="btn btn-font-dark btn-outline-hover-brand btn-icon btn-icon-md" title="RSVP">
                                <i class="la la-chevron-right"></i>
                            </span>

                            </div>
                        </div>


                    </template>
                </div>
            </div>
            <Modal :title="'Vis aktivitet'" :modal-data="modalData">
                <ActivityInfoModal :calendar="calendar" :activity="modalData.activity"></ActivityInfoModal>
            </Modal>
            <Modal :title="declineModal.title" :modal-data="declineModal">
                <DeclineModalContent calendar="calendar" :activity="declineModal.activity"></DeclineModalContent>
            </Modal>
        <div class="clearfix"></div>

    </div>
</template>
