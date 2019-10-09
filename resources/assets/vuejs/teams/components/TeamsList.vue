<script>
    import EditTeam from "./EditTeam";
    import TeamForm from "./TeamForm";
    export default {
        name: "TeamsList",
        components: {TeamForm, EditTeam},
        props:["teams"],
        data() {
            return {
                modalTeam: Object,
                modalPlayer: Object,
                editTeamId: 1
            }
        },

        methods: {
            getInitials(name) {
                if (name) {
                    let nameSplit = name.split(" ");
                    let final = "";
                    nameSplit.forEach(function (i, idx, array) {
                        i = i.substr(0, 1);
                        if (idx == 0) {
                            final = final + i;
                        }
                        if (idx === array.length - 1 && i.substr(0, 1) != '(') {
                            final = final + i;
                        } else if (idx === array.length - 1 && array.length > 2) {
                            final = final + array[idx - 1].substr(0, 1);

                        }
                    });


                    return final;
                }
            },
            getGender(player) {
                if(player && player.gender) {
                    if(player.gender == "M") {
                        return "kt-media--brand";
                    } else if(player.gender == "K") {
                        return "kt-media--danger";
                    }
                }
                return false;
            },
            editTeam(team) {
                this.modalTeam = team;
                this.editTeamId = team.id;
                this.$bvModal.show("editTeam");
            },
            setTeam(player) {
                this.modalPlayer = player;
                this.$bvModal.show("setTeam");
            },
            modalSetTeamSave() {
                this.$root.$emit("modalTeamPlayerTrigger");
                this.$bvModal.hide("setTeam");

            },
            createTeam() {
                this.$bvModal.show("createTeam");
            },
            modalCreateTeam() {
                this.$refs.createTeam.modalUpdateTeam();
            },
            setTeam1(id) {
                console.log(this.$store.getters['teams/getTeamById'](id));
            }
        },
        mounted() {

        }

    }
    Vue.filter('formatNumber', function (value = false) {
        let name = "spillere";
        let len = 0;
        if(value) {
            len = value.length;
            if(len > 1 || len == 0) {
                name = "spillere";
            } else {
                name = "spiller";
            }
            return len + " " + name;
        }

    });

</script>

<style scoped>
    .kt-media:hover {
        cursor:pointer;
    }
    .kt-widget-18 .kt-widget-18__item {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }
    .kt-widget-18 .kt-widget-18__item .kt-widget-18__legend {
        background-color: #385aeb;
        width: 1rem;
        height: 1rem;
        border-radius: 3px;
        margin-right: 1.25rem;
    }
    .kt-widget-18 .kt-widget-18__item .kt-widget-18__orders span {
        font-weight: 500;
        color: #3d4465;
        font-size: 1rem;
    }
    .kt-widget-18 .kt-widget-18__item .kt-widget-18__orders {
        font-weight: 400;
        color: #a1a8c3;
        font-size: .9rem;
        margin: auto 0 auto auto;
    }

    .kt-portlet .kt-portlet__foot {
        padding: 10px;
    }
</style>
<template>
    <div class="row">
        <div class="col-12 kt-margin-b-20">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Trupper
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <button @click="createTeam" class="btn btn-success"><i class="flaticon2-plus-1"></i> <span>Opret trup</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="teams.length == 0" class="col-12 card1 kt-margin-b-20">
            <div class="flex-left"></div>
            <div class="flex-center">
                <div class="div-row">Der blev ikke fundet nogen trupper!</div>
            </div>
        </div>

        <div v-for="team in teams" class="col-md-6 col-lg-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="flaticon2-graph"></i>
					</span>
                            <h3 class="kt-portlet__head-title" v-text="team.name"></h3>

                        </div>
                        <span v-if="team.players && team.players.length > 0" style="display:flex; align-self:center; font-size:0.9rem; font-weight:500"><span v-bind:class="[team.players.length > team.max_players ? 'kt-font-danger' : '']">{{ team.players.length }}</span>&nbsp;/ {{ team.max_players }} spillere</span>
                    </div>
                    <div class="kt-portlet__body">

                        <div class="kt-widget-18">
                            <div class="kt-widget-18__item">
                                <div class="kt-widget-18__legend kt-bg-brand"></div>

                                <div class="kt-widget-18__orders kt-margin-0">
                                    <span v-text="team.men"></span> Herrer
                                </div>
                                <div style="margin: 0 0 0 auto">
                                    <div class="kt-widget-18__orders" style="display: inline;">
                                        <span v-text="team.women"></span> Damer

                                    </div>
                                    <div class="kt-widget-18__legend kt-bg-danger" style="display: inline-block; margin: 0 0 0 10px; position: relative;top: 2px;"></div>

                                </div>
                            </div>
                            <div class="kt-widget-18__progress">
                                <div class="progress">
                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                    <div class="progress-bar bg-brand" role="progressbar" :style="{width: team.menP + '%'}" v-bind:aria-valuenow="team.menP" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-transparent" role="progressbar" :style="{width: 100-team.menP-team.womenP + '%'}"></div>
                                    <div class="progress-bar bg-danger" role="progressbar" :style="{width: team.womenP + '%'}" v-bind:aria-valuenow="team.womenP" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="row align-items-center">
                            <div class="col-6 m--valign-middle">
                                <div class="kt-media-group">
                                    <template  v-for="(player, index) in team.players">
                                        <span v-if="index < 4" class="kt-media kt-media--sm kt-media--circle" :class="getGender(player)" v-b-tooltip.hover :title="player.name">
                                            <img v-if="player.user && player.user.avatar" :src="player.user.avatar " :alt="player.name" />
                                            <span v-else>{{ getInitials(player.name) }}</span>
                                        </span>
                                        <span v-if="index == 4" class="kt-media kt-media--sm kt-media--circle kt-media--dark">
                                            <span>+{{ team.players.length-index }}</span>
                                        </span>
                                    </template>
                                </div>
                            </div>
                            <div class="col-6 kt-align-right">
                                <button @click="editTeam(team)" type="submit" class="btn btn-success btn-sm"><i class="la la-gears"></i> Redigér</button>
                                <button @click="setTeam1(team.id)" type="submit" :disabled="team.players.length > 0" class="btn btn-secondary btn-sm" :class="team.players.length > 0 ? 'btn-secondary' : 'btn-danger'"><i class="la la-trash"></i>Slet</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>

           <edit-team :id="editTeamId"></edit-team>
            <b-modal id="createTeam">
                <template v-slot:modal-title>Opret ny trup</template>
                <team-form ref="createTeam"></team-form>
                <template v-slot:modal-footer="{ ok, cancel }">
                    <!-- Emulate built in modal footer ok and cancel button actions -->
                    <b-button size="sm" class="btn btn-outline-metal" @click="cancel()">
                        Fortryd
                    </b-button>
                    <b-button tabindex="-1" size="sm" variant="brand" @click="modalCreateTeam" @keyup.enter="modalCreateTeam">
                        Opret
                    </b-button>
                </template>
            </b-modal>
    </div>
</template>
