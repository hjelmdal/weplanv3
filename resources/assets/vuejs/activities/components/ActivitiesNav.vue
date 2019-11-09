<script>
    export default {
        name: "ActivitiesNav",
        props:["calendar","types","filters","showFilters"],
        methods: {
            activitiesLoad(string) {
                this.$root.$emit("activitiesLoad", string);
            },
            navigate(direction, inputType = false) {
                let date;
                let type;
                let ref;
                inputType ? type = inputType : type = this.calendar.type;
                if(direction == "prev") {
                    ref = "prev_" + type;
                } else if(direction == "next") {
                    ref = "next_" + type;
                } else if(direction == "this") {

                    ref = "this_" + type;
                } else if(direction == "today") {
                    ref = "realdate";
                }
                date = this.calendar[ref];
                this.$router.push({ name: 'activities.filter', params: { type: type, date:date } });

            }
        },
        computed: {
            headLine() {
                if(this.calendar.type == "week") {
                    return "Uge " + Vue.filter('formatDate')(this.calendar.start, 'ww');
                } else if(this.calendar.type == "month") {
                    return Vue.filter('formatDate')(this.calendar.start, 'MMM. Y');
                } else if(this.calendar.type == "day") {
                    return Vue.filter('formatDate')(this.calendar.start, 'D. MMM Y');
                }

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
.we-act-nav-head {
    display: flex;
    align-items: center;
}
.we-act-nav-head h3 {
    margin:0 auto;
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
                                <button class="btn btn-success dropdown-toggle kt-btn--icon" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-calendar"></i> <span class="d-none d-sm-inline">Visning</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 36px, 0px);">
                                    <a class="dropdown-item" @click.stop="navigate('today')">Dags dato</a>
                                    <a class="dropdown-item" @click.stop="navigate('this','day')">1 Dag</a>
                                    <a class="dropdown-item" @click.stop="navigate('this','week')">1 Uge</a>
                                    <a class="dropdown-item" @click.stop="navigate('this','month')">1 Måned</a>
                                </div>

                            </div>
                            <div class="col-5 kt-align-center we-act-nav-head">
                                <h3><span id="headline" class="d-none d-sm-inline">Aktiviteter </span><span style="text-transform: capitalize">{{ headLine }}</span></h3>
                            </div>
                            <div class="col-4">
                                <div class="float-right">
                                    <button id="btnPrev" type="button" class="btn btn-primary" v-on:click.stop="navigate('prev')">&nbsp;<i class="fa fa-arrow-left"></i><span class="d-none d-sm-inline">Uge {{calendar.prev_week | formatDate("ww")}}</span></button>
                                    <button id="btnNext" type="button" class="btn btn-primary" v-on:click.stop="navigate('next')">&nbsp;<span class="d-none d-sm-inline">Uge {{calendar.next_week | formatDate("ww")}} </span><i class="fa fa-arrow-right"></i></button>
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
