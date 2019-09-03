<script>
    export default {
        name: "ActivityInfoModal",
        props:["activity"]
    }
</script>

<style scoped>

</style>

<template>
    <div class="kt-portlet kt-bg-brand kt-portlet--skin-solid kt-portlet--height-fluid">

        <div class="kt-portlet__body" style="padding:1rem">
            <!--begin::Widget 7-->
            <div style="flex">
            <div class="flex-left">
                <div class="div-date">
                    <div class="p8-date">
                        <div class="p8-date-mon">{{activity.start_date | formatDate("MMM")}}</div>
                        <div class="p8-date-num">{{activity.start_date | formatDate("DD")}}</div>
                        <div class="p8-date-day">{{activity.start_date | formatDate("ddd")}}</div>

                    </div>
                </div>
            </div>
            <div class="flex-center" style="width: calc(100% - 90px);">
                <div v-bind:id="'elem-' + activity.id" class="div-row" v-bind:class="{ 'overlay1-container':(activity.type && activity.type.signup == 1 || activity.my_activity)}">

                    <div v-if="activity.type" class="row-column" v-bind:class="{'bef-brand':(activity.type.signup == 1), 'bef-warning':(activity.my_activity && activity.my_status == 1), 'bef-danger':(activity.my_activity && activity.my_status == 0), 'bef-success':(activity.my_activity && activity.my_status == 2), 'bef-metal':(activity.type.decline == 1 && activity.my_activity == false)}">
                        <span class="div-text" style="font-size: 1.5rem;">{{ activity.title }}</span>
                        <div class="div-time" style="display: flex;">
                            <span style="height:12px" data-toggle="kt-tooltip" :title="activity.type.name" class="badge kt-font-white badge-sm" v-bind:class="{'badge-success':(activity.type_id == 1), 'badge-danger':(activity.type_id == 2), 'badge-primary':(activity.type_id == 3), 'badge-warning':(activity.type_id == 4)}">{{ activity.type.name }}</span>
                            <i class="la la-clock-o" style="font-size: 14px;"></i> {{ activity.start | formatTime("HH:mm") }} - {{ activity.end | formatTime("HH:mm") }}
                            <span v-if="activity.my_activity || activity.type.signup"><img src="/img/activities/alarm_clock.svg"> {{ activity.response_date + " " + activity.response_time | dateString("to") }}</span>


                        </div>

                    </div>
                    <div class="div-right" style="align-self: center; width: 40px; text-align: right;">
                            <span v-if="activity.my_activity === true && calendar.now < activity.response_timestamp"  class="btn btn-sm btn-outline-success btn-icon btn-icon-md" title="RSVP">
                                <i class="la la-calendar-o"></i>
                            </span>
                        <span @click="activityShow(activity)" data-toggle="modal" :data-target="'#'+activity.id" href="#" v-else class="btn btn-font-dark btn-outline-hover-brand btn-icon btn-icon-md" title="RSVP">
                                <i class="la la-chevron-right"></i>
                            </span>

                    </div>
                </div>

            </div>
            </div>
            <div class="clearfix"></div>
            <hr />
            <div class="kt-widget7 kt-widget7--skin-light">
                <div class="kt-widget7__desc">

                </div>
                <div class="kt-widget7__content">
                    <div class="kt-widget7__userpic">
                        <img src="/base/media//users/100_4.jpg" alt="">
                    </div>
                    <div class="kt-widget7__info">
                        <h3 class="kt-widget7__username">
                            Nick Mana
                        </h3>
                        <span class="kt-widget7__time">
						6 hours ago
					</span>
                    </div>
                </div>
                <div class="kt-widget7__button">
                    <a class="btn btn-success" href="#" role="button">All Feeds</a>
                </div>
            </div>
            <!--end::Widget 7-->
        </div>
    </div>
</template>
