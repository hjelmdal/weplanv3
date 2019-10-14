<script>
    import PlayerTable from "./PlayerTable";
    export default {
        name: "PlayersAdmin",
        components: {PlayerTable},

        computed: {
            players() {
                return this.$store.getters["players/getAllPlayersWithUsers"];
            }
        },
        mounted() {
            this.$store.dispatch('players/getAllPlayersWithUsers');
            this.$store.dispatch('teams/getAllTeams');
        }
    }
</script>

<style scoped>

</style>

<template>
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="flaticon2-user"></i>
					</span>
                <h3 class="kt-portlet__head-title">
                    Spillere
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <player-table :players="players"></player-table>
        </div>
        <div class="kt-portlet__foot kt-hidden">
            <div class="row">
                <div class="col-lg-6">
                    Portlet footer:
                </div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <span class="kt-margin-left-10">or <a href="#" class="kt-link kt-font-bold">Cancel</a></span>
                </div>
            </div>
        </div>
    </div>
</template>
