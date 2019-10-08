<script>
import TeamsList from "./TeamsList";
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
    },
    computed : {
        teams() {
            return this.$store.getters['teams/getAllTeams'];
        }
    },
    mounted: function () {
        this.teamsLoad("reload");

    }
}
</script>

<style scoped>

</style>


<template>
    <teams-list :teams="teams">

    </teams-list>
</template>
