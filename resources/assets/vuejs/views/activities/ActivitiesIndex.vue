<script>
    import ActivitiesSimpleList from "../../activities/components/ActivitiesSimpleList";
    export default {
        name: "ActivitiesIndex",
        components: {ActivitiesSimpleList},
        props:["type","date"]
    }
</script>

<style scoped>


</style>

<template>
    <activities-simple-list :type="type" :date="date">
    </activities-simple-list>
</template>
