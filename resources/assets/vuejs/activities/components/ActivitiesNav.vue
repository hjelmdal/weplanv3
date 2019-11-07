<script>
    export default {
        name: "ActivitiesNav",
        props:["calendar","types","filters","showFilters"],
        methods: {
            activitiesLoad(string) {
                this.$root.$emit("activitiesLoad",string);
            }
        }
    }
</script>

<style scoped>
@media(max-width:575px) {
    .kt-checkbox {
        display: flex !important;
    }
}
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
                                <button @click.stop="activitiesLoad('today')" class="btn btn-success kt-btn--icon">
                                    <span class="d-inline d-sm-none">&nbsp;&nbsp;</span><span><i class="fa fa-calendar"></i><span class="d-none d-sm-inline">Denne uge</span>
                        </span>
                                </button>
                            </div>
                            <div class="col-5 kt-align-center">
                                <h3><span id="headline" class="d-none d-sm-inline">Aktiviteter i </span>Uge {{calendar.start_date | formatDate("ww")}}</h3>
                            </div>
                            <div class="col-4">
                                <div class="float-right">
                                    <button id="btnPrev" type="button" class="btn btn-primary" v-on:click.stop="activitiesLoad('prev')">&nbsp;<i class="fa fa-arrow-left"></i><span class="d-none d-sm-inline">Uge {{calendar.prev_week | formatDate("ww")}}</span></button>
                                    <button id="btnNext" type="button" class="btn btn-primary" v-on:click.stop="activitiesLoad('next')">&nbsp;<span class="d-none d-sm-inline">Uge {{calendar.next_week | formatDate("ww")}} </span><i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <div v-if="showFilters" class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6" style="margin-top:10px;">

                            <div class="card">
                                <div class="card-header" id="headingThree6">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6" aria-expanded="false" aria-controls="collapseThree6">
                                        <i class="la la-filter"></i> Filters
                                    </div>
                                </div>
                                <div id="collapseThree6" class="collapse" aria-labelledby="headingThree6" data-parent="#accordionExample6" style="">
                                    <div class="card-body">
                                        <div class="col-12 kt-padding-0 text-center">
                                            <span class="pull-right"><label class="col-form-label">Kun mine</label>
                                <span class="kt-switch kt-switch--icon" style="vertical-align:bottom">
								<label style="margin-bottom:0">
									<input type="checkbox" v-model="filters[0]">
									<span></span>
								</label>
							</span>
                                </span>
                                            <template v-for="type in types">
                                                <label class="kt-checkbox kt-checkbox--solid kt-padding-r-5" style="padding-left: 19px;" v-bind:class="{'kt-checkbox--success':(type.id == 1), 'kt-checkbox--warning':(type.id == 5), 'kt-checkbox--danger':(type.id == 2), 'kt-checkbox--primary':(type.id == 3), 'kt-checkbox--warning':(type.id == 4)}">
                                                    <input v-model="filters[type.id]" type="checkbox" checked> {{ type.name }}
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
            </div>
        </div>
    </div>
    <!-- end: header nav -->
</template>
