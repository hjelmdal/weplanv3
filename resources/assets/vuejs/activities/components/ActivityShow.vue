<script>
    import activities from "../../store/modules/activities";

    export default {
        name: "ActivityShow",
        props:["id"],

        computed: {
            activity() {
                //console.log(this.$store.getters['activities/getActivities']);
               return this.$store.getters['activities/getActivityById'](this.id);
            }
        },

        created() {
            this.$store.dispatch('activities/getActivityById',{ id:this.id});
        }
    }
</script>

<style scoped>

</style>

<template>
<div v-if="activity">
    {{ activity.title }}
</div>
</template>
