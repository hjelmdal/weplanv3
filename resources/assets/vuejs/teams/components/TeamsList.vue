<script>
    export default {
        name: "TeamsList",
        props:["teams"],

        methods: {
            getInitials(name) {
                if (name) {
                    let nameSplit = name.split(" ");
                    let final = "";
                    nameSplit.forEach(function (i, idx, array) {
                        i = i.substr(0, 1);
                        if (idx == 0) {
                            final = final + i;
                        }
                        if (idx === array.length - 1 && i.substr(0, 1) != '(') {
                            final = final + i;
                        } else if (idx === array.length - 1 && array.length > 2) {
                            final = final + array[idx - 1].substr(0, 1);

                        }
                    });


                    return final;
                }
            }
        }

    }
    Vue.filter('formatNumber', function (value = false) {
        let name = "spillere";
        let len = 0;
        if(value) {
            len = value.length;
            if(len > 1 || len == 0) {
                name = "spillere";
            } else {
                name = "spiller";
            }
            return len + " " + name;
        }

    });

</script>

<style scoped>
    .kt-widget-18 .kt-widget-18__item {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }
    .kt-widget-18 .kt-widget-18__item .kt-widget-18__legend {
        background-color: #385aeb;
        width: 1rem;
        height: 1rem;
        border-radius: 3px;
        margin-right: 1.25rem;
    }
    .kt-widget-18 .kt-widget-18__item .kt-widget-18__orders span {
        font-weight: 500;
        color: #3d4465;
        font-size: 1rem;
    }
    .kt-widget-18 .kt-widget-18__item .kt-widget-18__orders {
        font-weight: 400;
        color: #a1a8c3;
        font-size: .9rem;
        margin: auto 0 auto auto;
    }

    .kt-portlet .kt-portlet__foot {
        padding: 10px;
    }
</style>
<template>
    <div class="row">

        <div class="col-12   kt-margin-b-20">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Trupper
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <button id="reload" v-on:click="teamsLoad('reload')" class="btn btn-brand btn-icon kt-margin-r-10"><i class="la la-refresh"></i></button>
                        <a data-target="#modal-std" data-toggle="modal" href="#" class="btn btn-success"><i class="flaticon2-plus-1"></i> <span>Opret trup</span></a>



                    </div>
                </div>
            </div>
        </div>
        <template v-if="teams.length == 0">
            <div class="col-12 card1  kt-margin-b-20">
                <div class="flex-left"></div>
                <div class="flex-center">
                    <div class="div-row">Der blev ikke fundet nogen trupper!</div>
                </div>
            </div>
        </template>
        <template v-for="team in teams">
            <div class="col-md-6 col-lg-4 order-lg-1 order-xl-1">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="flaticon2-graph"></i>
					</span>
                            <h3 class="kt-portlet__head-title" v-text="team.name"></h3>

                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <span class="" style="display:block"><span v-bind:class="[team.players.length > team.max_players ? 'kt-font-danger' : '']">{{ team.players | formatNumber() }}</span> / {{ team.max_players }} spillere</span>
                        <div class="kt-widget-18">
                            <div class="kt-widget-18__item">
                                <div class="kt-widget-18__legend kt-bg-brand"></div>

                                <div class="kt-widget-18__orders kt-margin-0">
                                    <span v-text="team.men"></span> Herrer
                                </div>
                                <div style="margin: 0 0 0 auto">
                                    <div class="kt-widget-18__orders" style="display: inline;">
                                        <span v-text="team.women"></span> Damer

                                    </div>
                                    <div class="kt-widget-18__legend kt-bg-danger" style="display: inline-block; margin: 0 0 0 10px; position: relative;top: 2px;"></div>

                                </div>
                            </div>
                            <div class="kt-widget-18__progress">
                                <div class="progress">
                                    <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                    <div class="progress-bar bg-brand" role="progressbar" :style="{width: team.menP + '%'}" v-bind:aria-valuenow="team.menP" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-transparent" role="progressbar" :style="{width: 100-team.menP-team.womenP + '%'}"></div>
                                    <div class="progress-bar bg-danger" role="progressbar" :style="{width: team.womenP + '%'}" v-bind:aria-valuenow="team.womenP" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="row align-items-center">
                            <div class="col-lg-6 m--valign-middle">
                                <div v-for="(player, index) in team.players" class="kt-media-group">
                                    <a v-if="index < 3" href="#" class="kt-media kt-media--sm kt-media--circle" :class="player.gender = 'M' ? ' kt-media--brand' : '  kt-media--danger'" v-b-tooltip.hover :title="player.name" v-tooltip:top="''">
                                        <img v-if="player.user && player.user.avatar" :src="player.user.avatar " :alt="player.name" />
                                        <span v-else>{{ getInitials(player.name) }}</span>
                                    </a>
                                    <a v-if="index == 3" href="#" class="kt-media kt-media--sm kt-media--circle">
                                        +{{ team.players.length-index }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 kt-align-right">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="submit" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet kt-portlet--height-fluid kt-widget-12">
                    <div class="kt-portlet__body">
                        <div class="kt-widget-12__body">
                            <div class="kt-widget-12__head">
                                <div class="kt-widget-12__label">
                                    <h3 class="kt-widget-12__title" v-text="team.name"></h3>
                                    <span class="kt-widget-12__desc"><span v-bind:class="[team.players.length > team.max_players ? 'kt-font-danger' : '']">{{ team.players | formatNumber() }}</span> / {{ team.max_players }} spillere</span>
                                </div>
                            </div>
                            <div class="kt-widget-12__info">
                                <div class="kt-widget-18">
                                    <div class="kt-widget-18__item">
                                        <div class="kt-widget-18__legend kt-bg-brand"></div>

                                        <div class="kt-widget-18__orders kt-margin-0">
                                            <span v-text="team.men"></span> Herrer
                                        </div>
                                        <div style="margin: 0 0 0 auto">
                                            <div class="kt-widget-18__orders" style="display: inline;">
                                                <span v-text="team.women"></span> Damer

                                            </div>
                                            <div class="kt-widget-18__legend kt-bg-danger" style="display: inline-block; margin: 0 0 0 10px; position: relative;top: 2px;"></div>

                                        </div>
                                    </div>
                                    <div class="kt-widget-18__progress">
                                        <div class="progress">
                                            <!-- Doc: A bootstrap progress bar can be used to show a user how far along it's in a process, see https://getbootstrap.com/docs/4.1/components/progress/ -->
                                            <div class="progress-bar bg-brand" role="progressbar" :style="{width: team.menP + '%'}" v-bind:aria-valuenow="team.menP" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="progress-bar bg-transparent" role="progressbar" :style="{width: 100-team.menP-team.womenP + '%'}"></div>
                                            <div class="progress-bar bg-danger" role="progressbar" :style="{width: team.womenP + '%'}" v-bind:aria-valuenow="team.womenP" aria-valuemin="0" aria-valuemax="100"></div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--md">
                        <div class="kt-portlet__foot-wrapper">
                            <div class="kt-portlet__foot-info">
                                <div class="kt-widget-12__members">

                                        <div v-for="(player, index) in team.players" class="kt-media-group">
                                            <a v-if="index < 3" href="#" class="kt-media kt-media--sm kt-media--circle" :class="player.gender = 'M' ? ' kt-media--brand' : '  kt-media--danger'" v-b-tooltip.hover :title="player.name" v-tooltip:top="''">
                                                <img v-if="player.user && player.user.avatar" :src="player.user.avatar " :alt="player.name" />
                                                <span v-else>{{ getInitials(player.name) }}</span>
                                            </a>
                                            <a v-if="index == 3" href="#" class="kt-media kt-media--sm kt-media--circle">
                                                +{{ team.players.length-index }}
                                            </a>
                                        </div>





                                </div>
                            </div>
                            <div class="kt-portlet__foot-toolbar">
                                <a data-toggle="modal" data-target="#modal1" :href="'/' + team.id + '/players'" class="btn btn-outline-metal btn-elevate btn-icon btn-sm">
                                <i class="la la-users"></i>
                                </a>
                                <a data-toggle="modal" data-target="#modal-std" :href="'/'  + team.id + '/edit'" class="btn btn-outline-brand btn-elevate btn-icon btn-sm">
                                <i class="la la-pencil-square-o"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-elevate btn-icon btn-sm" title="Slet">
                                    <i class="la la-trash-o"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>

        </template>
    </div>
</template>
