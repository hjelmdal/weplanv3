<script>
import Form from "../../Form";
export default {
    name: "UserService",
    data () {
        return {
            user: Object,
            users: Array,
            form: new Form()
        }
    },
    methods: {
        getAllUsers() {
            this.form.get("/api/v1/users")
                .then((response) =>  {
                    return this.users = response;
                })
                .catch((e) => {
                   // Nothing yet
                });
        },
    },
    mounted() {
        this.$root.$on('getAllUsers', data => {
            this.getAllUsers();
        });
    }
}
</script>

<style scoped>

</style>

<template>
    
</template>
