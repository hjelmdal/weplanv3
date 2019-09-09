<script>
    import Chart from "chart.js";
    import planetChartData from "./planetChartData";
    export default {
        name: "AttendeeStats",
        data() {
            return {
                planetChartData: planetChartData,
            }
        },
        methods: {
            createChart(chartId, chartData) {
                const ctx = document.getElementById(chartId);
                const myChart = new Chart(ctx, {
                    type: chartData.type,
                    data: chartData.data,
                    options: chartData.options,
                });
            }
        },
        mounted() {
            this.createChart('planet-chart', this.planetChartData);
        }
    }
</script>

<style scoped>

</style>

<template>
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head  kt-portlet__head--noborder">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Technologies</h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-toolbar-wrapper">
                    <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="flaticon-more-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">
                            <!--begin::Nav-->
                            <ul class="kt-nav">
                                <li class="kt-nav__head">
                                    Export Options
                                    <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="kt-nav__separator"></li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-drop"></i>
                                        <span class="kt-nav__link-text">Users</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                        <span class="kt-nav__link-text">Reports</span>
                                        <span class="kt-nav__link-badge">
					<span class="kt-badge kt-badge--danger">9</span>
                </span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-link"></i>
                                        <span class="kt-nav__link-text">Statements</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                        <span class="kt-nav__link-text">Customer Support</span>
                                    </a>
                                </li>
                                <li class="kt-nav__separator"></li>
                                <li class="kt-nav__foot">
                                    <a class="btn btn-label-brand btn-bold btn-sm" href="#">Proceed</a>
                                    <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                </li>
                            </ul>
                            <!--end::Nav-->
                        </div>				</div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fluid">
            <div class="kt-widget-21">
                <div class="kt-widget-21__title">
                    <div class="kt-widget-21__label">9.3M</div>
                    <img src="/base/media/misc/iconbox_bg.png" class="kt-widget-21__bg" alt="bg"/>
                </div>
                <div class="kt-widget-21__data">
                    <!--Doc: For the chart legend bullet colors can be changed with state helper classes: kt-bg-success, kt-bg-info, kt-bg-danger. Refer: components/custom/colors.html -->
                    <div class="kt-widget-21__legends">
                        <div class="kt-widget-21__legend">
                            <i class="kt-bg-brand"></i>
                            <span>HTML</span>
                        </div>
                        <div class="kt-widget-21__legend">
                            <i class="kt-shape-bg-color-4"></i>
                            <span>CSS</span>
                        </div>
                        <div class="kt-widget-21__legend">
                            <i class="kt-shape-bg-color-3"></i>
                            <span>Angular</span>
                        </div>
                    </div>
                    <div class="kt-widget-21__chart">
                        <div class="kt-widget-21__stat">+37%</div>
                        <!--Doc: For the chart initialization refer to "widgetTechnologiesChart" function in "src\theme\app\scripts\custom\dashboard.js" -->
                        <canvas id="planet-chart" style="height: 110px; width: 110px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
