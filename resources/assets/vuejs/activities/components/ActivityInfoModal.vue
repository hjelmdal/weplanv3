<script>
    export default {
        name: "ActivityInfoModal",
        props:["activity"],
        data() {
            return {
                attend: null,
                playersCount: {
                    males: 0,
                    females: 0,
                    maleDeclines: 0,
                    femaleDeclines: 0
                }
            }
        },
        methods: {
            signup(event,activity) {
                this.attend = true;
                this.$root.$emit("confirmActivity",{'event':event,'activity':activity })
            },
            decline() {
                this.attend = false;
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
                    console.log(response);
                    return response;
                }
                return false;
            },
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
            }
        },
        watch: {
            activity: {
                immediate: true,
                handler (val, oldVal) {
                    this.playersCount.males = 0;
                    this.playersCount.females = 0;
                    this.playersCount.maleDeclines = 0;
                    this.playersCount.femaleDeclines = 0;
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
                    <div class="truncate-text">{{ activity.title }}</div>
                    <div><i class="la la-clock-o" style="font-size: 14px;"></i> {{ activity.start | formatTime("HH:mm") }} - {{ activity.end | formatTime("HH:mm") }}</div>
                    <div><span v-if="activity.type" data-toggle="kt-tooltip"  class="badge kt-font-white info-block" v-bind:class="{'badge-success':(activity.type_id == 1), 'badge-danger':(activity.type_id == 2), 'badge-primary':(activity.type_id == 3), 'badge-warning':(activity.type_id == 4)}">{{ activity.type.name }}</span></div>
                </div>



            </div>
            <div class="kt-separator kt-separator--border-dashed kt-margin-b-10"></div>
            <div style="display: flex;">
                <div style="flex:1; width: 50%;">
                    <div v-if="activity.responsible">
                        <img src="/img/activities/coach.svg" width="26" height="26"> {{ activity.responsible.name }}
                    </div>
                    <div>
                        <i class="la la-map-marker la-2x"></i> <span>Annexhallen</span>
                    </div>
                </div>
                <div style="flex:1">
                    <div>
                        <i class="la la-2x la-male"></i> <span>{{ playersCount.males }}</span>
                    </div>
                    <div>
                        <i class="la la-2x la-female"></i> <span>{{ playersCount.females }}</span>
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
            <div v-if="attend === true" class="card card-default">
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
