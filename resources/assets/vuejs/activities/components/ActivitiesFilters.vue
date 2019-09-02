<script>
    export default {
        name: "ActivitiesFilters",
        props:["filters","types"],
        methods: {
            activitiesLoad(string) {
                this.$root.$emit("activitiesLoad",string);
            }
        }
    }
</script>

<style scoped>

</style>

<template>
    <!-- begin: Filters -->
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-section__content kt-section__content--border">
                        <div class="row">
                            <div class="col-12 kt-padding-0 text-center">
                                <template v-for="type in types">
                                    <label class="kt-checkbox kt-checkbox--solid kt-padding-r-5" style="padding-left: 19px;" v-bind:class="{'kt-checkbox--success':(type.id == 1), 'kt-checkbox--warning':(type.id == 5), 'kt-checkbox--danger':(type.id == 2), 'kt-checkbox--primary':(type.id == 3), 'kt-checkbox--warning':(type.id == 4)}">
                                        <input v-model="filters[type.id]" type="checkbox" @change="activitiesLoad('reload')"> {{ type.name }}
                                        <span></span>
                                    </label>

                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Filters -->
</template>
