<script>
    import TeamForm from "./TeamForm";
    import AddPlayers from "./AddPlayers";
    export default {
        name: "EditTeam",
        components: {AddPlayers, TeamForm},
        props:["id"],
        data() {
            return {
                selected: this.id,

                modalPlayer:"",
                teamPlayersFields: [
                    { key: "index", label: "#", sortable: false },
                    { key: "name",label: "Navn", sortable: true, class: "text-ellipsis"},
                    { key: "gender", label:"Køn", sortable: true, class: "kt-align-center"},
                    { key: "action", label:" ", sortable: false, class: "kt-align-right"}
                ],
            }
        },
        methods: {
            modalPlayerTeam(player) {
                this.$bvModal.show("setTeam");
                this.modalPlayer = player;


            },
            modalSavePlayerTeam() {
                let payload = {
                    player: this.modalPlayer,
                    team_id: this.selected
                }
                if(this.id != this.selected) {
                    this.$store.dispatch('players/setPlayerTeam', {payload: payload})
                        .then(data1 => {
                            this.$swal({
                                title: data1,
                                timer: 1500,
                                type: 'success',
                                position: 'top',
                                showConfirmButton: false,
                            });
                        })
                } else {
                    console.log("Are you kiddin' me?");
                }
                this.$bvModal.hide("setTeam");
            },


            resetForm() {
                this.selected = this.id;
            },
            modalUpdateTeam() {
                console.log("Sent to child");
                this.$refs.TeamForm.modalUpdateTeam();
            },
            setFocus() {
                this.$refs.addPlayers.setFocus();
            }
        },

        computed:{
            team() {
                return this.$store.getters['teams/getTeamById'](this.id);
            },
            teamsSelect() {
                let teams = this.$store.getters['teams/getAllTeams'];
                let options = [];
                options.push({ value: null, text: "- Fjern fra trup -"})
                teams.forEach(team => {
                    options.push({
                        value: team.id,
                        text: team.name
                    })
                })
                return options;
            },
        },

    }
</script>

<style>
    .b-table > tbody > tr > td {
        vertical-align: middle;
    }
    .text-ellipsis {
        max-width: 185px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap
    }
</style>

<template>
<div>
    <b-modal id="editTeam">
        <template v-slot:modal-title>{{ team.name }}</template>

        <div v-if="team && team.id">
            <b-tabs content-class="mt-3">
                <b-tab title="Info" active>
                    <team-form ref="TeamForm" :team="team"></team-form>
                </b-tab>
                <b-tab title="Spillere">

                    <b-table show-empty empty-text="Der er ikke tilknyttet nogen spillere til denne trup" sort-icon-left small :fields="teamPlayersFields" :items="team.players">
                        <template v-slot:cell(index)="data">
                            {{ data.index + 1 }}
                        </template>
                        <template v-slot:cell(gender)="data">
                            <i v-if="data.value == 'M'" class="fa fa-2x fa-male kt-font-brand"></i>
                            <i v-if="data.value == 'K'" class="fa fa-2x fa-female kt-font-danger"></i>
                        </template>
                        <template v-slot:cell(action)="data">
                            <div class="btn-group" role="group" aria-label="...">
                                <button class="btn btn-sm btn-success" title="Edit player" role="button"><i class="la la-search"></i></button>
                                <button @click="modalPlayerTeam(data.item)"  class="btn btn-sm btn-brand" title="Remove from team" role="button"><i class="la la-list-ol"></i></button>
                            </div>
                        </template>
                    </b-table>
                </b-tab>
                <b-tab title="Tilføj.." @click="setFocus">
                    <add-players ref="addPlayers" :team="team"></add-players>
                </b-tab>
            </b-tabs>




        </div>

        <template v-slot:modal-footer="{ ok, cancel }">
            <!-- Emulate built in modal footer ok and cancel button actions -->
            <b-button size="sm" class="btn btn-outline-metal" @click="cancel()">
                Luk
            </b-button>
            <b-button tabindex="-1" size="sm" variant="brand" @click="modalUpdateTeam">
                Gem
            </b-button>
        </template>
    </b-modal>


    <b-modal @show="resetForm" v-if="team && team.id" id="setTeam">
        <template v-slot:modal-title>{{ modalPlayer.name }}</template>
        <div class="kt-section kt-form__section--first">

            <!-- begin::form rows -->
            <div class="form-group kt-form__group">
                <h5>Sæt {{ modalPlayer.name }} på en trup nedenfor.</h5>
                <b-form-select v-model="selected" :options="teamsSelect"></b-form-select>

            </div>
        </div>
        <template v-slot:modal-footer="{ ok, cancel }">
            <!-- Emulate built in modal footer ok and cancel button actions -->
            <b-button size="sm" class="btn btn-outline-metal" @click="cancel()">
                Fortryd
            </b-button>
            <b-button size="sm" variant="brand" @click="modalSavePlayerTeam">
                Gem
            </b-button>

        </template>
    </b-modal>
</div>
</template>
