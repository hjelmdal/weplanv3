<script>
    export default {
        name: "ActivityInfoExtra",
        props: ["activity"],
        methods: {
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
</style>

<template>
    <div class="card card-default">
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

</template>