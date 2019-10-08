<script>
    import SetTeamModal from "./SetTeamModal";
    export default {
        name: "EditTeam",
        components: {SetTeamModal},
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
                                showConfirmButton: false,
                            });
                        })
                } else {
                    console.log("Are you kiddin' me?");
                }
                this.$bvModal.hide("setTeam");
            },
            modalEditTeam() {
              this.$store.dispatch('teams/updateTeam',{payload: this.team})
                  .then(data => {
                      this.$swal({
                          title: data.message,
                          timer: 1500,
                          type: 'success',
                          showConfirmButton: false,
                      });
                      var self = this;
                      setTimeout(function () {
                          self.$bvModal.hide("editTeam");
                      },1500)

                  })
            },
            resetForm() {
                this.selected = this.id;
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
        }

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
                    <!--begin::Section-->
                    <div class="kt-section kt-form__section--first">

                        <!-- begin::form rows -->
                        <div class="form-group kt-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Navn</label>

                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <input name="id" type="hidden" v-model="team.id" />
                                <input name="name" class="form-control kt-input" id="name" autocomplete="new-password" type="text" placeholder="Trup navn" v-model="team.name">
                                <span class="kt-form__help">Skriv et sigende navn for den trup du opretter</span>

                            </div>

                        </div>

                        <div class="form-group kt-form__group row">


                            <label class="col-form-label col-lg-3 col-sm-12">Max antal spillere</label>

                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <input name="max_players" class="form-control kt-input" id="max_players" type="number" placeholder="20" v-model="team.max_players">
                                <span class="kt-form__help">Hvor mange ønsker du max på denne trup?</span>

                            </div>

                        </div>
                        <div class="form-group kt-form__group row">


                            <label class="col-lg-3 col-sm-12">Aktiv?</label>

                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                    <input name="active" v-model="team.active" value="1" type="checkbox" > Er truppen aktiv?
                                    <span></span>
                                </label>



                            </div>

                        </div>
                    </div>
                    <!--end::Section-->
                </b-tab>
                <b-tab title="Spillere">
                    <b-table sort-icon-left small :fields="teamPlayersFields" :items="team.players">
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
            </b-tabs>




        </div>

        <template v-slot:modal-footer="{ ok, cancel }">
            <!-- Emulate built in modal footer ok and cancel button actions -->
            <b-button size="sm" class="btn btn-outline-metal" @click="cancel()">
                Luk
            </b-button>
            <b-button size="sm" variant="brand" @click="modalEditTeam">
                Gem
            </b-button>
        </template>
    </b-modal>


    <b-modal @show="resetForm" v-if="team && team.id" id="setTeam">
        <template v-slot:modal-title>{{ team.name }}</template>
        <div class="kt-section kt-form__section--first">

            <!-- begin::form rows -->
            <div class="form-group kt-form__group">
                <h5>Sæt spilleren på en anden trup nedenfor.</h5>
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
