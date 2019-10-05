<script>
import ActivityInfoExtra from "./ActivityInfoExtra";
//import AttendeeStats from "./AttendeeStats";
export default {
    name: "ActivityInfoModal",
    components: {ActivityInfoExtra},
    props:["activity","calendar"],
    data() {
        return {
            playersCount: {
                males: 0,
                females: 0,
                maleDeclines: 0,
                femaleDeclines: 0,
                maleConfirms: 0,
                femaleConfirms: 0
            },

        }
    },
    methods: {
        signup(event,activity) {
            this.respond = true;
            this.$root.$emit("confirmActivity",{'event':event,'activity':activity })
        },
        decline(event,data) {
            this.respond = true;
            this.$root.$emit("declineActivity",{'event': event,'formData':data})
            console.log(data);
        },

        // Setting players count for the giving activity - resetting at component update (watch)
        getPlayers() {
            if(this.activity.players) {
                //console.log("yes");
                this.activity.players.forEach(player => {
                    if(player.gender == "M") {
                        this.playersCount.males++;
                    }
                    if(player.gender == "K") {
                        this.playersCount.females++;
                    }
                    if(player.pivot) {
                        if(player.pivot.declined_at) {
                            if(player.gender == "M") {
                                this.playersCount.maleDeclines++;
                            } else if(player.gender == "K") {
                                this.playersCount.femaleDeclines++;
                            }
                        }
                        if(player.pivot.confirmed_at) {
                            if(player.gender == "M") {
                                this.playersCount.maleConfirms++;
                            } else if(player.gender == "K") {
                                this.playersCount.femaleConfirms++;
                            }
                        }
                    }
                })
            }
        },
        canSeeInfo() {
            if(this.activity.my_activity) {
                let status = this.activity.my_status;
                if(status == 1) {
                    return "respond";
                } else if(status == 0 || status == 2) {
                    return "responded";
                }
            } else if(this.activity.type && this.activity.type.signup == 1) {
                return "signup";
            } else if(calendar.now > this.activity.response_timestamp) {
                return "overdue";
            }
            return false;
        },
        resetData() {
            this.playersCount.males = 0;
            this.playersCount.females = 0;
            this.playersCount.maleDeclines = 0;
            this.playersCount.femaleDeclines = 0;
            this.playersCount.maleConfirms= 0;
            this.playersCount.femaleConfirms = 0;
        }
    },
    watch: {
        activity: {
            immediate: true,
            handler (val, oldVal) {
                this.resetData();
                this.getPlayers();
            }
        }

    }

}
</script>

<style scoped>

.flex-container {
    display: flex;
    align-items: center;
}
.truncate-text {
    display: inline-block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.text-large {
    font-size:2rem;
    line-height: 2.3rem;
}
.flex-column {
    display: flex;
    flex-direction: column;
    width:calc(100% - 80px);
    position: relative;
}

.flex-row {
    display: flex;
    flex-direction: row;
    justify-content: center;
}
.kt-media {
    vertical-align: middle;
}

.kt-widget-3 .kt-widget-3__content {
    padding: 1rem;
}
.kt-widget-3 .kt-widget-3__content .kt-widget-3__content-info {
    padding-bottom: 0;
}
.kt-media {
    margin-right: 3px;
}

.kt-widget-3.kt-widget-3--primary {
    background: #bbb;
}
.avatar-width {
    width: calc(100% - 50px);
}
.kt-font-xl {
    font-size: 3.5rem !important;
}
.count-info {
    display: flex;
    flex-direction: column;
    align-items: baseline;
    line-height: 1rem;
    white-space: nowrap;
}
.count-info.right {
    align-items: flex-end;
}
@media (max-width: 767px) {
    .avatar-width {
        width: calc(100% - 25px);
    }
    .kt-media.kt-media--md.kt-media--circle span {
        height: 25px;
        width: 25px;
    }
    .la-2x.la-shrink {
        font-size: 1rem;
    }

    .col-6 {
        padding:5px;
    }
    .col-12 {
        padding:5px;
    }
    .kt-media.kt-media--md img {
        width: 100%;
        max-width: 25px;
        height: 25px;
    }
    .kt-widget-3.kt-widget-3--primary .kt-widget-3__content-desc {
        font-size: 0.9rem;
        position:relative;
        top:-3px;
    }
    .text-right {
        margin-right: -14px;
    }

    .text-left {
        margin-left:-10px;
    }

}

</style>

<template>
<div v-if="activity && activity.id">
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet kt-bg-brand kt-portlet--skin-solid kt-portlet--height-fluid">
                <div class="kt-portlet__body" style="padding:1rem 0rem">
                    <!--begin::Flex container-->
                    <div class="flex-container" style="margin-left: -5px;">
                        <div class="flex-left">
                            <div class="div-date">
                                <div class="p8-date">
                                    <div class="p8-date-mon">{{activity.start_date | formatDate("MMM")}}</div>
                                    <div class="p8-date-num">{{activity.start_date | formatDate("DD")}}</div>
                                    <div class="p8-date-day">{{activity.start_date | formatDate("ddd")}}</div>

                                </div>
                            </div>
                        </div>
                        <div class="flex-column">
                            <div class="truncate-text text-large" id="tooltip1">{{ activity.title }}</div>
                            <b-tooltip target="tooltip1" triggers="hover">
                                {{ activity.title }}
                            </b-tooltip>
                            <div><i class="la la-clock-o" style="font-size: 14px;"></i> {{ activity.start | formatTime("HH:mm") }} - {{ activity.end | formatTime("HH:mm") }}</div>
                            <div><span v-if="activity.type" id="actType" class="badge kt-font-white info-block" v-bind:class="{'badge-success':(activity.type_id == 1), 'badge-danger':(activity.type_id == 2), 'badge-primary':(activity.type_id == 3), 'badge-warning':(activity.type_id == 4)}">{{ activity.type.name }}</span></div>
                            <b-tooltip v-if="activity.type" target="actType" triggers="hover">{{ activity.type.name }}</b-tooltip>
                        </div>
                        <!--end::Flex container-->
                    </div>
                    <div class="kt-separator kt-separator--border-dashed kt-margin-10"></div>
                    <div class="flex-row" v-if="calendar.now < activity.response_timestamp">
                        <button @click="signup($event,activity)" type="button" class="btn kt-margin-10" :disabled="activity.my_activity && activity.my_status == 2" :class="activity.my_activity && activity.my_status == 2 ? 'btn-metal' : 'btn-success'"><i class="fa fa-check"></i> {{ activity.my_activity && activity.my_status == 2 ? 'Tilmeldt' : 'Tilmeld' }}</button>
                        <button data-toggle="modal" :data-target="'#declineModal1'" type="button" class="btn btn-danger kt-margin-10"><i class="fa fa-door-open"></i> Afbud</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div>
        <div>
            <div class="kt-separator kt-separator--border-dashed kt-margin-b-10"></div>

            <div class="row">
            <div class="col-6">
            <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
                <div class="kt-portlet__body">
                    <div class="kt-widget-3 kt-widget-3--primary">
                        <div class="kt-widget-3__content">
                            <div class="kt-widget-3__content-info">
                                <div class="kt-widget-3__content-section">
                                    <div class="kt-widget-3__content-title">Ansvarlig</div>
                                    <div class="kt-widget-3__content-desc">Kontaktoplysninger</div>
                                </div>
                            </div>

                            <div class="kt-widget-3__content-stats">
                                <div class="truncate-text kt-font-white" style="display: flex; align-items: center"> <div class="kt-media kt-media--md kt-media--circle" style="border: 1px solid #dee2e6;"><img :src="activity.responsible.avatar != null ? activity.responsible.avatar : '/img/profile.png'" :alt="activity.responsible.name"></div> <div class="truncate-text avatar-width"> {{ activity.responsible.name }}<br><span v-if="activity.responsible.user_info" class="kt-widget-3__content-desc">{{ '+' + activity.responsible.user_info.tel_dialcode }} {{ activity.responsible.user_info.tel_number }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-6">
            <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
                <div class="kt-portlet__body">
                    <div class="kt-widget-3 kt-widget-3--primary">
                        <div class="kt-widget-3__content">
                            <div class="kt-widget-3__content-info">
                                <div class="kt-widget-3__content-section">
                                    <div class="kt-widget-3__content-title">Placering</div>
                                    <div class="kt-widget-3__content-desc">Adresse</div>
                                </div>
                            </div>

                            <div class="kt-widget-3__content-stats">
                                <div class="kt-font-white" style="display: flex; align-items: center"> <a href="#" class="kt-media kt-media--md kt-media--circle kt-media--brand">
                                    <span><i class="la la-map-marker la-2x la-shrink kt-valign-middle" style="vertical-align: middle;"></i></span></a> <div class="truncate-text avatar-width"> Annexhallen<br><span class="kt-widget-3__content-desc">Bethesdavej 29, 8200 Aarhus N</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <div v-if="canSeeInfo == 'responded'" class="row">
                <div class="col-12">
                    <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-3 kt-widget-3--primary">
                        <div class="kt-widget-3__content">
                            <div class="kt-widget-3__content-info">
                                <div class="kt-widget-3__content-section">
                                    <div class="kt-widget-3__content-title">Deltagere</div>
                                    <div class="kt-widget-3__content-desc">Statistik</div>
                                </div>
                            </div>

                            <div class="kt-widget-3__content-stats">
                                <div class="kt-font-white" style="display: flex; align-items: center; justify-content:space-between">
                                    <div style="display: flex; align-items: center"> <a href="#" class="kt-media kt-media--circle kt-media--brand">
                                        <span><i class="la la-male la-2x kt-valign-middle" style="vertical-align: middle;"></i></span></a> <span class="kt-font-xl kt-font-boldest text-left"> &nbsp;{{ playersCount.males - playersCount.maleDeclines }}</span>
                                        <div class="count-info">
                                        <span class="kt-font-sm kt-font-metal kt-font-boldest">{{ playersCount.males }} I alt</span>
                                        <span class="kt-font-sm kt-font-success kt-font-boldest">{{ playersCount.maleConfirms }} Bekræftet</span>
                                        <span class="kt-font-sm kt-font-danger kt-font-boldest">{{ playersCount.maleDeclines }} Afbud</span>

                                        </div>
                                    </div>
                                    <div style="display: flex; align-items: center">
                                        <div class="count-info right">
                                            <span class="kt-font-sm kt-font-metal kt-font-boldest">I alt {{ playersCount.females }}</span>
                                            <span class="kt-font-sm kt-font-success kt-font-boldest">Bekræftet {{ playersCount.femaleConfirms }}</span>
                                            <span class="kt-font-sm kt-font-danger kt-font-boldest">Afbud {{ playersCount.femaleDeclines }}</span>
                                        </div>
                                        <span class="kt-font-xl kt-font-boldest text-right">{{ playersCount.females - playersCount.femaleDeclines }} &nbsp;</span>
                                        <a href="#" class="kt-media kt-media--circle kt-media--danger">
                                            <span><i class="la la-female la-2x kt-valign-middle" style="vertical-align: middle;"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>


        </div>
    </div>

        <div class="clearfix"></div>
    <div class="kt-separator kt-separator--border-dashed kt-margin-b-10"></div>

    <div class="row" v-if="(activity.my_status && activity.my_status != 1) || activity.type.signup == 1 || (!activity.my_status && activity.type.decline == 1)|| calendar.now > activity.response_timestamp " cl>
        <div class="col-12">
            <activity-info-extra :activity="activity"></activity-info-extra>
        </div>
    </div>

</div>
</template>
