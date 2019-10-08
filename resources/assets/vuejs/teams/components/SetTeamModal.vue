<script>
    export default {
        name: "SetTeamModal",
        props: ["teams","player","id"],
        data() {
            return {
                selected: this.player.team_id,
                options: [],
            }
        },
        methods: {
            setSelect() {
                this.options.push({ value: null, text: "- Fjern fra trup -"})
                this.teams.forEach(team => {
                    this.options.push({
                        value: team.id,
                        text: team.name
                    })
                })
            },
            submit() {
                this.$root.$emit("modalTeamPlayerUpdate",{'team_id':this.selected,'player':this.player})
            }
        },
        mounted() {
            this.setSelect();
            this.$root.$on("modalTeamPlayerTrigger",data => {
                this.submit();
            })
        }
    }
</script>

<style scoped>

</style>
<template>
    <div>
        <b-form-select v-model="selected" :options="options"></b-form-select>
        <div class="mt-3">Selected: <strong>{{ selected }}</strong></div>
    </div>
</template>

