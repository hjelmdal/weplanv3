<script>
import TeamsList from "./TeamsList";
export default {
    name: "teamsAdmin",
    components: {TeamsList},
    data() {
        return {
            teams: []
        }
    },

    methods: {

        teamsLoad(string) {
            KTApp.blockPage();

            axios.get("/api/v1/teams")
                .catch(error => {
                if (error.response) {
                    console.log("Error code: " + error.response.status);
                    if (error.response.status == 401) {
                        location.reload();
                    }
                }
            }).then((response) => {
                this.teams = response.data.data;
                let i;

                response.data.data.forEach(event => {
                    event.men = 0;
                    event.women = 0;
                    event.menP = 0;
                    event.womenP = 0;
                    if (event.players.length > 0) {
                        event.players.forEach(player => {
                            if (player.gender === "M") {
                                event.men++;
                            } else if (player.gender === "K") {
                                event.women++;
                            }
                        });
                        if (event.max_players > 0) {
                            if (event.men + event.women > event.max_players) {
                                event.menP = Math.round(event.men / (event.men + event.women) * 100);
                                event.womenP = Math.round(event.women / (event.men + event.women) * 100);

                            } else {
                                event.menP = Math.round(event.men / event.max_players * 100);
                                event.womenP = Math.round(event.women / event.max_players * 100);
                            }

                        }
                    }

                    console.log(event);
                    i++;
                });


            });
            Vue.nextTick(function () {
                $('[data-toggle="tooltip"]').tooltip();
            })

            KTApp.unblockPage();


        },
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
