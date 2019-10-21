<script>
import PlayerTable from "./PlayerTable";
import TablePlayerName from "../../components/helpers/TablePlayerName";
import PlayerImportTable from "./PlayerImportTable";
export default {
    name: "PlayersAdmin",
    components: {PlayerImportTable, TablePlayerName, PlayerTable},

    computed: {
        players() {
            return this.$store.getters["players/getAllPlayersWithUsers"];
        },
        rows() {
            return this.players.length;
        }

    },
    created() {
        this.$store.dispatch('players/getAllPlayersWithUsers');
        this.$store.dispatch('teams/getAllTeams');

    }
}
</script>

<style scoped>

</style>

<template>
<div>
    <div class="row">
        <div class="col-lg-6">
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
            <div class="kt-portlet__head-toolbar">
                <button v-b-modal.importPlayers class="btn btn-success"><i class="flaticon2-plus-1"></i> <span>Importér spillere</span></button></div>
        </div>
        <div class="kt-portlet__body kt-p5-mobile">
            <player-table :rows="rows" :players="players"></player-table>
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
        </div>
    </div>

    <b-modal title="Importér fra BadmintonPlayer" id="importPlayers" size="lg" body-class="kt-pl0-mobile kt-pr0-mobile">
        <player-import-table></player-import-table>
        <template v-slot:modal-footer="{ ok, cancel }">
            <!-- Emulate built in modal footer ok and cancel button actions -->
            <b-button size="sm" class="btn btn-outline-metal">
                Fortryd
            </b-button>
        </template>
    </b-modal>
</div>
</template>
