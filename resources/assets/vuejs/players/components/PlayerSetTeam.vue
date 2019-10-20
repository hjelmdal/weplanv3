<script>
export default {
    name: "PlayerSetTeam",
    props: ["player", "modal"],
    data() {
        return {
            selected: "",
        }
    },

    computed: {
        teams() {
            let teams = this.$store.getters['teams/getAllTeams'];
            let options = [];
            options.push({value: 0, text: "Ingen trup"})
            teams.forEach(team => {
                options.push({
                    value: team.id,
                    text: team.name
                })
            })
            return options;
        }
    },
    methods: {
        initSelect() {
            if (this.player.team) {
                this.selected = this.player.team.id;
            } else if(this.player.team_id) {
                this.selected = this.player.team_id;
            } else {
                this.selected = 0;
            }
        },
        setTeam(team) {
            let payload = {
                player: this.player,
                team_id: team,
            }
            if(!this.player.team || this.player.team.id != payload.team_id) {
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
        },
    },
    mounted() {
        this.initSelect();
    },
    watch: {
        player: {
            // the callback will be called immediately after the start of the observation
            immediate: true,
            handler(val, oldVal) {
                this.initSelect();
            }

        }
    }
}
</script>

<style scoped>

</style>

<template>
    <b-modal size="sm" id="setTeam" title="Sæt trup" :title="player.name">
        <label v-for="team in teams" class="kt-option cursor-pointer">

            <span class="kt-option__label">
									<span class="kt-option__head">
									<span class="kt-option__title" :class="team.value == selected ? 'kt-font-boldest' : ''">
									{{ team.text }}
									</span>
									<span class="kt-option__focus">
									</span>
									</span>
									<span v-if="team.id" class="kt-option__body">
									</span>
									</span>
            <span class="kt-option__control">
									<span class="kt-radio kt-radio--bold kt-radio--brand" :class="team.value == 0 ? 'kt-radio--danger' : ''" :checked="team.value == selected">
									<input @input="setTeam(team.value)" type="radio" v-model="selected" :value="team.value" :checked="team.value == selected">
									<span></span>
									</span>
									</span>
        </label>
        <template v-slot:modal-footer="{ cancel }">
            <b-button size="sm" variant="outline-secondary" @click="cancel()">
                Fortryd
            </b-button>
        </template>
    </b-modal>
</template>
