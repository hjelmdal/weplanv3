<script>
    export default {
        name: "ActivitiesFilters",
        props:["filters","types"],
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
                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">

                            <div class="card">
                                <div class="card-header" id="headingThree6">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6" aria-expanded="false" aria-controls="collapseThree6">
                                        <i class="la la-filter"></i> Filters
                                    </div>
                                </div>
                                <div id="collapseThree6" class="collapse" aria-labelledby="headingThree6" data-parent="#accordionExample6" style="">
                                    <div class="card-body">
                                        <div class="col-12 kt-padding-0 text-center">
                                            <template v-for="type in types">
                                                <label class="kt-checkbox kt-checkbox--solid kt-padding-r-5" style="padding-left: 19px;" v-bind:class="{'kt-checkbox--success':(type.id == 1), 'kt-checkbox--warning':(type.id == 5), 'kt-checkbox--danger':(type.id == 2), 'kt-checkbox--primary':(type.id == 3), 'kt-checkbox--warning':(type.id == 4)}">
                                                    <input v-model="filters[type.id]" type="checkbox" checked> {{ type.name }}
                                                    <span></span>
                                                </label>
                                            </template>
                                            <span class="pull-right"><label class="col-form-label">Kun mine</label>
                                <span class="kt-switch kt-switch--icon" style="vertical-align:bottom">
								<label style="margin-bottom:0">
									<input type="checkbox" v-model="filters[0]">
									<span></span>
								</label>
							</span>
                                </span>
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
    <!-- end: Filters -->
</template>
