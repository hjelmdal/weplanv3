<script>
import ActivitiesSimpleList from "./ActivitiesSimpleList";
export default {
    name: "ActivitiesBeta",
    components: {ActivitiesSimpleList},
    props:["type","date"],
    data(){
        return {
            name: this.$route.params.name
        };
    },
    beforeRouteUpdate(to, from, next) {
        this.name = to.params.name
        next()
    }
}
</script>

<style scoped>


</style>

<template>
    <activities-simple-list :type="type" :date="date">
    </activities-simple-list>
</template>
