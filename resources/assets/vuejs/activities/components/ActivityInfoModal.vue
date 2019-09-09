<script>
    export default {
        name: "ActivityInfoModal",
        props:["activity"],
        data() {
            return {
                playersCount: {
                    males: 0,
                    females: 0,
                    maleDeclines: 0,
                    femaleDeclines: 0,
                    maleConfirms: 0,
                    femaleConfirms: 0
                }
            }
        },
        methods: {
            signup(event,activity) {
                this.respond = true;
                this.$root.$emit("confirmActivity",{'event':event,'activity':activity })
            },
            decline() {
                this.respond = true;
            },
            getPlayerStatus(player) {
                let response = null;
                //console.log(player.pivot);
                let pivot = player.pivot;
                if(pivot) {

                    if(pivot.declined_at == null && pivot.confirmed_at == null) {
                        response = null;
                    } else if(pivot.declined_at) {
                        response = 'declined';
                    } else if(pivot.confirmed_at) {
                        response = 'confirmed';
                    }
                    return response;
                }
                return false;
            },
            //Status color for showing in table
            getStatusColor(player) {
                let response = null;
                if(player) {
                    switch(this.getPlayerStatus(player)) {
                        case 'null':
                            response = null;
                            break;
                        case 'declined':
                            response = 'bg-danger';
                            break;
                        case 'confirmed':
                            response = 'bg-success';
                            break;

                    }
                    //console.log(response);
                    return response;
                }
                return false;
            },
            // Setting players count for the giving activity - resetting at component update (watch)
            getPlayers() {
                if(this.activity.players) {
                    console.log("yes");
                    this.activity.players.forEach(player => {
                        if(player.gender == "M") {
                            this.playersCount.males++;
                        }
                        if(player.gender == "K") {
                            this.playersCount.females++;
                        }
                    })
                }
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
.circle {
    display: inline-block;
    width: 7px;
    height: 7px;
    border-radius: 500px;
    margin: 0 .5em;
    background-color: #ddd;
    vertical-align: baseline;
    border: 2px solid transparent;
}
.circle-lg {
    width: 11px;
    height: 11px;
}
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
</style>

<template>
<div v-if="activity && activity.id">
    <div class="kt-portlet kt-bg-brand kt-portlet--skin-solid kt-portlet--height-fluid">

        <div class="kt-portlet__body" style="padding:1rem">
            <!--begin::Widget 7-->
            <div class="flex-container">
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
                    <div class="truncate-text text-large">{{ activity.title }}</div>
                    <div><i class="la la-clock-o" style="font-size: 14px;"></i> {{ activity.start | formatTime("HH:mm") }} - {{ activity.end | formatTime("HH:mm") }}</div>
                    <div><span v-if="activity.type" data-toggle="kt-tooltip"  class="badge kt-font-white info-block" v-bind:class="{'badge-success':(activity.type_id == 1), 'badge-danger':(activity.type_id == 2), 'badge-primary':(activity.type_id == 3), 'badge-warning':(activity.type_id == 4)}">{{ activity.type.name }}</span></div>
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
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-3 kt-widget-3--primary">
                        <div class="kt-widget-3__content">
                            <div class="kt-widget-3__content-info">
                                <div class="kt-widget-3__content-section">
                                    <div class="kt-widget-3__content-title">Ansvarlig</div>
                                    <div class="kt-widget-3__content-desc">Kontaktoplysninger</div>
                                </div>
                            </div>

                            <div class="kt-widget-3__content-stats">
                                <div class="truncate-text kt-font-white" style="display: flex; align-items: center"> <div class="kt-media kt-media--md kt-media--circle"><img :src="activity.responsible.avatar != null ? activity.responsible.avatar : '/img/profile.png'" :alt="activity.responsible.name"></div> <div> {{ activity.responsible.name }}<br><span class="kt-widget-3__content-desc">{{ activity.responsible.email }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-6">
            <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-3 kt-widget-3--primary">
                        <div class="kt-widget-3__content">
                            <div class="kt-widget-3__content-info">
                                <div class="kt-widget-3__content-section">
                                    <div class="kt-widget-3__content-title">Placering</div>
                                    <div class="kt-widget-3__content-desc">Adresse</div>
                                </div>
                            </div>

                            <div class="kt-widget-3__content-stats">
                                <div class="kt-font-white" style="display: flex; align-items: center"> <a href="#" class="kt-media kt-media--circle kt-media--brand">
                                    <span><i class="la la-map-marker la-2x kt-valign-middle" style="vertical-align: middle;"></i></span></a> <div> Annexhallen<br><span class="kt-widget-3__content-desc  truncate-text" style="width: calc(100% - 50px);">Bethesdavej 29, 8200 Aarhus N</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>

            <div class="flex-row">
            <button @click="signup($event,activity)" type="button" class="btn btn-success kt-margin-10"><i class="fa fa-check"></i> Tilmeld</button>
            <button @click="decline" type="button" class="btn btn-danger kt-margin-10"><i class="fa fa-door-open"></i> Afbud</button>
            </div>
        </div>
    </div>

        <div class="clearfix kt-margin-b-20"></div>
            <hr />
            <div v-if="(activity.my_status && activity.my_status != 1) || activity.type.signup == 1 || (!activity.my_status && activity.type.decline == 1)" class="card card-default">
                <div class="card-body text-center">
                        <ul class="nav nav-pills nav-tabs-btn" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tabs_8_1" role="tab">
                                    <span class="nav-link-icon"><i class="flaticon-information"></i></span>
                                    <span class="nav-link-title">Program</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tabs_8_2" role="tab">
                                    <span class="nav-link-icon"><i class="flaticon-users"></i></span>
                                    <span class="nav-link-title">Deltagere</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tabs_8_3" role="tab">
                                    <span class="nav-link-icon"><i class="flaticon2-graph-2"></i></span>
                                    <span class="nav-link-title">Kampe</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="kt_tabs_8_1" role="tabpanel">
                                <h4>Opvarmning</h4>
                                <div>2 x rundt i 3 hjørner</div>
                                <div>4 x fladt spil på kvart bane</div>
                                <h4>Runder</h4>
                                <div>2 x Runder a 25 minutter</div>
                                <h4>Fysisk</h4>
                                <div>bip test - 15 minutter</div>
                            </div>
                            <div class="tab-pane fade" id="kt_tabs_8_2" role="tabpanel">
                                <table class="table table-ellipsis table-striped table-v-middle table-left">
                                    <thead>
                                        <tr>
                                            <th width="20">#</th>
                                            <th>Navn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="activity.players.length > 0" v-for="player in activity.players">
                                            <td valign="middle"><div data-toggle="tooltip" data-title="User connected" class="circle circle-lg" :class="getStatusColor(player)" data-original-title="" title=""></div></td>
                                            <td class="text-left"><img class="align-self-center mr-2 rounded-circle img-thumbnail thumb32" :src="player.user && player.user.avatar != null ? player.user.avatar : '/img/profile.png'" :alt="player.name" :title="player.name" /> {{ player.name }}</td>
                                        </tr>
                                        <tr v-if="activity.players.length == 0"><td colspan="2" class="text-center">Ingen spillere fundet.</td> </tr>
                                    </tbody>

                                </table>
                            </div>
                            <div class="tab-pane fade" id="kt_tabs_8_3" role="tabpanel">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                        </div>


                </div>

            </div>

            <!--end::Widget 7-->

</div>
</template>
