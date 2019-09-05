<script>
    export default {
        name: "ActivityInfoModal",
        props:["activity"],
        data() {
            return {
                attend: null,
            }
        },
        methods: {
            signup() {
                this.attend = true;
            },
            decline() {
                this.attend = false;
            },
            getPlayerStatus(player) {
                let response = null;
                console.log(player.pivot);
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
                    console.log(response);
                    return response;
                }
                return false;
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
<div>
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
            <div class="flex-row">
            <button @click="signup" type="button" class="btn btn-success kt-margin-10"><i class="fa fa-check"></i> Tilmeld</button>
            <button @click="decline" type="button" class="btn btn-danger kt-margin-10"><i class="fa fa-door-open"></i> Afmeld</button>
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
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
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
                                    </tbody>

                                </table>
                            </div>
                            <div class="tab-pane fade" id="kt_tabs_8_3" role="tabpanel">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                        </div>

                    <img class="mb-2 img-fluid rounded-circle thumb64" src="/base/media//users/100_4.jpg" alt="Contact">
                    <h4>Audrey Hunt</h4>
                    <p>Hello, I'm a just a dummy contact in your contact list and this is my presentation text. Have fun!</p>
                </div>
                <div class="card-footer d-flex">
                    <div><a class="btn btn-xs btn-primary" href="#">Send message</a></div>
                    <div class="ml-auto"><a class="btn btn-xs btn-secondary" href="#">View</a></div>
                </div>
            </div>
            <div class="card card-default d-none d-lg-block">
                <div class="card-header">
                    <div class="card-title text-center">Recent contacts</div>
                </div>
                <div class="card-body">
                    <div class="media">
                        <img class="align-self-center mr-2 rounded-circle img-thumbnail thumb48" src="/base/media//users/100_4.jpg" alt="Contact">
                        <div class="media-body py-2">
                            <div class="text-bold">
                                Floyd Ortiz
                                <div class="text-sm text-muted">12m ago</div>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <img class="align-self-center mr-2 rounded-circle img-thumbnail thumb48" src="/base/media//users/100_5.jpg" alt="Contact">
                        <div class="media-body py-2">
                            <div class="text-bold">
                                Luis Vasquez
                                <div class="text-sm text-muted">2h ago</div>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <img class="align-self-center mr-2 rounded-circle img-thumbnail thumb48" src="/base/media//users/100_6.jpg" alt="Contact">
                        <div class="media-body py-2">
                            <div class="text-bold">
                                Duane Mckinney
                                <div class="text-sm text-muted">yesterday</div>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <img class="align-self-center mr-2 rounded-circle img-thumbnail thumb24" src="/base/media//users/100_7.jpg" alt="Contact">
                        <div class="media-body py-2">
                            <div class="text-bold">
                                Connie Lambert
                                <div class="text-sm text-muted">2 weeks ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end::Widget 7-->

</div>
</template>
