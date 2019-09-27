<script>
    import VSelect from "@alfsnd/vue-bootstrap-select";
    export default {
        name: "DeclineModalContent",
        props:["activity","calendar"],
        components: {
            VSelect
        },
        data() {
            return {
                declineCategories: []
            };
        },
        methods: {
            decline(event) {
                //console.log(this.activity);
                this.respond = true;
                this.$root.$emit("declineActivity",{'event': event,'formData':this.activity})

            },
            getDeclineCategories() {
                axios.get("/api/v1/declines/categories")
                    .then(data => {
                        this.declineCategories = data.data;
                        $('select').selectpicker();
                    })
            }
        },
        mounted() {
            this.getDeclineCategories();

        }
    }
</script>

<style scoped>
    .buttons {
        display: flex;
        justify-content: center;
    }
</style>

<template>
    <div>
        <div class="form-group">
            <label>Årsag</label>

                <select class="form-control kt-selectpicker">
                    <option value="" selected="selected">- Vælg -</option>
                    <option v-for="category in declineCategories" :value="category.id">{{ category.reason }}</option>

                </select>

        </div>

        <div class="form-group form-group-last">
            <label for="exampleTextarea">Eller skriv</label>
            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
        </div>
        <div class="buttons">
        <button data-dismiss="modal" type="button" class="btn btn-outline-brand kt-margin-10"><i class="fa fa-backspace"></i> Fortryd</button>
        <button @click="decline($event)" type="button" class="btn btn-danger kt-margin-10"><i class="fa fa-door-open"></i> Afbud</button>
        </div>
    </div>
</template>
