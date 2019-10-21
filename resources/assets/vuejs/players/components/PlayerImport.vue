<script>
    export default {
        name: "PlayerImport",
        mounted() {
            this.$on("")
        }
    }
</script>

<style scoped>

</style>

<template>
    <b-modal title="Importér fra BadmintonPlayer" id="importPlayers" size="lg" body-class="kt-pl0-mobile kt-pr0-mobile">
        <player-import-table></player-import-table>
        <template v-slot:modal-footer="{ ok, cancel }">
            <!-- Emulate built in modal footer ok and cancel button actions -->
            <b-button size="sm" class="btn btn-outline-metal">
                Fortryd
            </b-button>
            <b-button tabindex="-1" size="sm" variant="brand">
                Opret
            </b-button>
        </template>
    </b-modal>
</template>
