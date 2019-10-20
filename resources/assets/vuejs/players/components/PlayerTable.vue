<script>
import TablePlayerName from "../../components/helpers/TablePlayerName";
export default {
    name: "PlayerTable",
    components: {TablePlayerName},
    props:["players"],
    data() {
        return {
            playerFields: [
                {key: "index", label: "#", sortable: false, class: "fit d-none d-sm-table-cell"},
                {key: "name", label: "Navn", sortable: true, class: ""},
                {key: "gender", label: "Køn", sortable: true, class: "kt-align-center d-none d-sm-table-cell"},
                {key: "team.name", label: "Trup", sortable: true, class: "kt-pr0-mobile fit"},
                {key: "action", label: " ", sortable: false, class: "kt-align-right"},
                {key: "dbf_id", label: "", sortable:false, class:"width-full"}
            ],
            selected: "",
            teamSelect: {
                team: "",
                player:""
            }
        }
    },
    methods: {
        getInitials(name) {
            if(name) {
                let nameSplit = name.split(" ");
                let final = "";
                nameSplit.forEach(function(i, idx, array){
                    i = i.substr(0,1);
                    if(idx == 0) {
                        final = final + i;
                    }
                    if (idx === array.length - 1 && i.substr(0,1) != '(') {
                        final = final + i;
                    } else if(idx === array.length - 1 && array.length > 2) {
                        final = final + array[idx - 1].substr(0,1);

                    }
                });


                return final;
            }
        },
        setTeam(item,team) {
            console.log(item);
            let value = "";
            if(item.team) {
                value = item.team.id;
            }
            let close = false;
            let payload = {
                player: item,
                team_id: team
            }
            if(!payload.team || payload.team_id != value) {
                this.$store.dispatch('players/setPlayerTeam', {payload: payload})
                    .then(data1 => {
                        this.$swal({
                            title: data1,
                            timer: 1000,
                            type: 'success',
                            position: 'top',
                            showConfirmButton: false,
                        });
                        this.$bvModal.hide("setTeam");
                        this.selected = "";
                    })
            } else {
                console.log("Are you kiddin' me?");
            }
            if(close) {
                console.log("id: " + item.id);
                this.$refs['teamSet' + item.id].$emit('close')
                this.players.forEach(player => {
                    this.$refs['teamSet' + player.id].$emit('close')
                })
            }
        },

        onClose(id) {
            this.$refs['teamSet' + id].$emit('close');
        },
        openTeamModal(player) {
            this.teamSelect.player = player;
            if(player && player.team) {
                this.teamSelect.team = player.team.id;
            }
        },
        test () {
            console.log("clicked");
            this.$bvModal.hide("setTeam");
        }


    },
    computed: {
        teams() {
            let teams = this.$store.getters['teams/getAllTeams'];
            let options = [];
            options.push({ value: 0, text: "Fjern fra trup"})
            teams.forEach(team => {
                options.push({
                    value: team.id,
                    text: team.name
                })
            })
            return options;
        }
    }
}
</script>

<style scoped>
    >>> .flex-row {
        align-self: center;
        line-height: 0.9rem;
    }

    >>> .width-full {
        width:100%;
    }
    .kt-option:hover {
        border: 1px solid #ddd;
    }
</style>

<template>
<div>
    <b-button v-b-modal.setTeam>test</b-button>
    <b-table striped show-empty empty-text="Ingen spillere fundet" sort-icon-left small :fields="playerFields" :items="players">
        <template v-slot:cell(index)="data">
            {{ data.index + 1 }}
        </template>
        <template v-slot:cell(name)="data">
            <table-player-name :data="data"></table-player-name>
        </template>
        <template v-slot:cell(gender)="data">
            <i v-if="data.value == 'M'" class="fa fa-2x fa-male kt-font-brand"></i>
            <i v-if="data.value == 'K'" class="fa fa-2x fa-female kt-font-danger"></i>
        </template>
        <template v-slot:cell(team.name)="data">
            <span  v-if="data.value" v-b-tooltip.hover :title="data.value" class="badge badge-secondary badge-sm text-ellipsis ellipsis-team">{{ data.value }}</span>
            <span v-else v-b-tooltip.hover :title="'Sæt på trup'" class="badge badge-secondary badge-sm text-ellipsis ellipsis-team">- Ikke tilkyttet trup -</span>

        </template>
        <template v-slot:cell(action)="data">
            <div class="btn-group" role="group" aria-label="...">
                    <span>
                        <div class="btn-group" role="group" aria-label="Administration af spillere">
                            <button v-b-modal.setTeam @click="openTeamModal(data.item)" class="btn btn-sm btn-outline-brand btn-icon" role="button"><i class="la la-users"></i></button>
                            <button class="btn btn-sm btn-outline-success btn-icon"  role="button"><i class="la la-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger btn-icon"  role="button"><i class="la la-trash"></i></button>
                        </div>
                    </span>
            </div>
        </template>
        <template v-slot:cell(dbf_id)="data">

        </template>
    </b-table>

    <b-modal size="sm" id="setTeam" title="Sæt trup" :title="teamSelect.player.name">
        <label v-for="team in teams" class="kt-option cursor-pointer">

            <span class="kt-option__label">
									<span class="kt-option__head">
									<span class="kt-option__title" :class="team.value == teamSelect.team ? 'kt-font-boldest' : ''">
									{{ team.text }}
									</span>
									<span class="kt-option__focus">
									</span>
									</span>
									<span v-if="team.id" class="kt-option__body">
									</span>
									</span>
            <span class="kt-option__control">
									<span class="kt-radio kt-radio--bold kt-radio--brand" :class="team.value == 0 ? 'kt-radio--danger' : ''" :checked="team.value == teamSelect.team">
									<input @input="setTeam(teamSelect.player,team.value)" type="radio" name="m_option_1" v-model="teamSelect.team" :value="team.value" :checked="team.value == teamSelect.team">
									<span></span>
									</span>
									</span>
        </label>
    </b-modal>
</div>
</template>
