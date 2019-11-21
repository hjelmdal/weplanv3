<script>
    export default {
        name: "ActivityDecline",
        props: ["activity"],
        data() {
            return {
                categories: [],
                selected: "",
                reason: ""
            }
        },
        methods: {
            setCategory(val) {
                this.selected = val;
            },
            decline() {
                this.$store.dispatch('activities/declineActivityById', {activity_id: this.activity.id,category: this.selected, description: this.reason,})
                    .then(response => {
                        console.log(response);
                        //this.$root.$emit('modalDecline');
                        this.$bvModal.hide("declineModal");

                    });
            }
        },
        created() {
            axios.get("/api/v1/declines/categories")
                .then(data => {
                    data.data.forEach(cat => {
                        this.categories.push({
                            value: cat.id,
                            text: cat.reason
                        })
                    })
                })
        },
        watch: {
            activity: {
                immediate: true,
                handler(val, oldVal) {
                    this.selected = "";
                    this.reason = "";
                }
            }
        }
    }
</script>

<style scoped>

</style>

<template>
    <b-modal size="sm" id="declineModal" title="Meld afbud">
        <label v-for="category in categories" class="kt-option cursor-pointer">

            <span class="kt-option__label">
									<span class="kt-option__head">
									<span class="kt-option__title" :class="category.value == selected ? 'kt-font-boldest' : ''">
									{{ category.text }}
									</span>
									<span class="kt-option__focus">
									</span>
									</span>
									<span v-if="category.id" class="kt-option__body">
									</span>
									</span>
            <span class="kt-option__control">
									<span class="kt-radio kt-radio--bold kt-radio--brand" :class="category.value == 0 ? 'kt-radio--danger' : ''" :checked="category.value == selected">
									<input @input="setCategory(category.value)" type="radio" v-model="selected" :value="category.value" :checked="category.value == selected">
									<span></span>
									</span>
									</span>
        </label>
        <div class="form-group form-group-last">
            <label for="exampleTextarea">Anden årsag:</label>
            <textarea class="form-control" id="exampleTextarea" v-model="reason" rows="3"></textarea>
        </div>
        <template v-slot:modal-footer="{ cancel,ok }">
            <b-button size="sm" variant="outline-secondary" @click="cancel()">
                Fortryd
            </b-button>
            <b-button size="sm" variant="outline-danger" @click="decline()">
                Meld Afbud
            </b-button>
        </template>
    </b-modal>
</template>
