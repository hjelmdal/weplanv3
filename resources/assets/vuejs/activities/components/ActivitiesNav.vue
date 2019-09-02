<script>
    export default {
        name: "ActivitiesNav",
        props:["calendar"],
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
    <!-- begin: header nav -->
    <div class="row">
        <div class="col-12">
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-section__content kt-section__content--border">
                        <div class="row">
                            <div class="col-3">
                                <button @click="activitiesLoad('today')" class="btn btn-success kt-btn--icon">
                                    <span class="d-inline d-sm-none">&nbsp;&nbsp;</span><span><i class="fa fa-calendar"></i><span class="d-none d-sm-inline">Denne uge</span>
                        </span>
                                </button>
                            </div>
                            <div class="col-5 kt-align-center">
                                <h3><span id="headline" class="d-none d-sm-inline">Aktiviteter i </span>Uge {{calendar.start_date | formatDate("ww")}}</h3>
                            </div>
                            <div class="col-4">
                                <div class="float-right">
                                    <button id="btnPrev" type="button" class="btn btn-primary" v-on:click="activitiesLoad('prev')">&nbsp;<i class="fa fa-arrow-left"></i><span class="d-none d-sm-inline">Uge {{calendar.prev_week | formatDate("ww")}}</span></button>
                                    <button id="btnNext" type="button" class="btn btn-primary" v-on:click="activitiesLoad('next')">&nbsp;<span class="d-none d-sm-inline">Uge {{calendar.next_week | formatDate("ww")}} </span><i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: header nav -->
</template>
