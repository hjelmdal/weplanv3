<template>
    <div>
        <ul v-for="task in tasks">
        <li v-text="task.description"></li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Test",
        props: ["tasks"]
    }
</script>

<style scoped>

</style>