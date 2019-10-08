<script>
import TeamsList from "./TeamsList";
import { mapState } from "vuex";
export default {
    name: "teamsAdmin",
    components: {TeamsList},


    methods: {

        teamsLoad(string) {
            KTApp.blockPage();
            this.$store.dispatch('teams/getAllTeams');

            Vue.nextTick(function () {
                $('[data-toggle="tooltip"]').tooltip();
            })

            KTApp.unblockPage();


        },
        teamSetPlayerTeam(data) {
            this.$store.dispatch('teams/setPlayerTeam', {data: data})
                .then(data1 => {
                    console.log("test" + data1);
                    this.$swal({
                        title: data1,
                        timer: 1500,
                        type: 'success',
                        showConfirmButton: false,
                    });

                    //this.teamsLoad("reload");
                    //this.$root.$emit("sendUpdateToTeamsList", {'team': data.player.team_id});
                })
        }
    },
    computed : {
        teams() {
            return this.$store.getters['teams/getAllTeams'];
        }
    },
    mounted: function () {
        this.teamsLoad("reload");

        this.$root.$on("modalTeamPlayerUpdate",data => {
            this.teamSetPlayerTeam(data);
        })


    },
    created() {
        //this.teamsLoad("reload")
    }
}
</script>

<style scoped>

</style>


<template>
    <teams-list :teams="teams">

    </teams-list>
</template>
