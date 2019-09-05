<script>
    export default {
        name: "ActivityInfoModal",
        props:["activity"]
    }
</script>

<style scoped>
.flex-container {
    display: flex;
    align-items: center;
}
.truncate-text {
    display: inline-block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size:2rem;
    line-height: 2rem;
}
.flex-column {
    display: flex;
    flex-direction: column;
    width:calc(100% - 80px);
    position: relative;
}
</style>

<template>
<div>
    <div class="kt-portlet kt-bg-brand kt-portlet--skin-solid kt-portlet--height-fluid">

        <div class="kt-portlet__body" style="padding:1rem">
            <!--begin::Widget 7-->
            <div class="flex-container">
                <div class="flex-left">
                    <div class="div-date">
                        <div class="p8-date">
                            <div class="p8-date-mon">{{activity.start_date | formatDate("MMM")}}</div>
                            <div class="p8-date-num">{{activity.start_date | formatDate("DD")}}</div>
                            <div class="p8-date-day">{{activity.start_date | formatDate("ddd")}}</div>

                        </div>
                    </div>
                </div>
                <div class="flex-column">
                    <div class="truncate-text">{{ activity.title }}</div>
                    <div><i class="la la-clock-o" style="font-size: 14px;"></i> {{ activity.start | formatTime("HH:mm") }} - {{ activity.end | formatTime("HH:mm") }}</div>
                    <div><span data-toggle="kt-tooltip"  class="badge kt-font-white info-block" v-bind:class="{'badge-success':(activity.type_id == 1), 'badge-danger':(activity.type_id == 2), 'badge-primary':(activity.type_id == 3), 'badge-warning':(activity.type_id == 4)}">{{ activity.type.name }}</span></div>
                </div>

            </div>

        </div>
    </div>

        <div class="clearfix kt-margin-b-20"></div>
            <hr />
            <div class="card card-default">
                <div class="card-header"></div>
                <div class="card-body text-center">
                    <img class="mb-2 img-fluid rounded-circle thumb64" src="/base/media//users/100_4.jpg" alt="Contact">
                    <h4>Audrey Hunt</h4>
                    <p>Hello, I'm a just a dummy contact in your contact list and this is my presentation text. Have fun!</p>
                </div>
                <div class="card-footer d-flex">
                    <div><a class="btn btn-xs btn-primary" href="#">Send message</a></div>
                    <div class="ml-auto"><a class="btn btn-xs btn-secondary" href="#">View</a></div>
                </div>
            </div>
            <div class="card card-default d-none d-lg-block">
                <div class="card-header">
                    <div class="card-title text-center">Recent contacts</div>
                </div>
                <div class="card-body">
                    <div class="media">
                        <img class="align-self-center mr-2 rounded-circle img-thumbnail thumb48" src="/base/media//users/100_4.jpg" alt="Contact">
                        <div class="media-body py-2">
                            <div class="text-bold">
                                Floyd Ortiz
                                <div class="text-sm text-muted">12m ago</div>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <img class="align-self-center mr-2 rounded-circle img-thumbnail thumb48" src="/base/media//users/100_5.jpg" alt="Contact">
                        <div class="media-body py-2">
                            <div class="text-bold">
                                Luis Vasquez
                                <div class="text-sm text-muted">2h ago</div>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <img class="align-self-center mr-2 rounded-circle img-thumbnail thumb48" src="/base/media//users/100_6.jpg" alt="Contact">
                        <div class="media-body py-2">
                            <div class="text-bold">
                                Duane Mckinney
                                <div class="text-sm text-muted">yesterday</div>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <img class="align-self-center mr-2 rounded-circle img-thumbnail thumb24" src="/base/media//users/100_7.jpg" alt="Contact">
                        <div class="media-body py-2">
                            <div class="text-bold">
                                Connie Lambert
                                <div class="text-sm text-muted">2 weeks ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end::Widget 7-->

</div>
</template>
