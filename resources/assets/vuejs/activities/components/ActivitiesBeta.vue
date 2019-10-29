<script>
export default {
    name: "ActivitiesBeta",
    props:["type","date","filter"],
    data() {
      return {
          calendar: []
      }
    },
    methods: {
      getCalendar() {
          let type = this.type;
          let date = this.date;
          let filter = this.filter;
          if(!this.type) {
              type = "week";
          } if(!this.date) {
              date = moment().format("YYYY-MM-DD");
          }
          if(!this.filter) {
              filter = "";
          }
          axios.get("/api/v1/calendar/" + type + "/" + date + "/" + filter)
              .then(response => {
                  this.calendar = response.data.calendar;
              })
      }
    },
    created() {
        this.getCalendar();
    }
}
</script>

<style scoped>
    .we-flex {
        display:flex;
        flex-direction:row;
    }
    .we-flex-grow {
        flex-grow: 1;
    }
    .we-100 {
        width:100%;
    }
    .we-flex-row {
        display:flex;
        flex-direction:column;
        padding:10px;
    }

    .we-flex1 {
        display:flex;
    }
    .we-flex2 {
        display:flex;
        background-color:green;
    }
    .we-flex5 {
        display:flex;
        align-self:center;
    }
    .we-body {
        margin:10px;
    }
    .we-pill {
        border-radius: 1rem 0rem 0rem 1rem;
    }
    .btn-sm {

    }

</style>

<template>
<div>
    <div class="we-flex" v-for="day in calendar.days">
        <div class="we-flex-row">
            <div class="p8-date">
                <div class="p8-date-mon">{{day.date | formatDate("MMM")}}</div>
                <div class="p8-date-num">{{day.date | formatDate("DD")}}</div>
                <div class="p8-date-day">{{day.date | formatDate("ddd")}}</div>

            </div>
        </div>
        <div class="we-flex-row we-flex-grow kt-mt-10">
        <div class="we-flex1" v-for="activity in day.activities">

            <div class="kt-portlet we-100" style="border-right: 5px solid green">
                <div class="we-flex">
                <div class="we-flex-row kt-m10 we-flex-grow">
                    <div class="title kt-font-lg kt-font-bold">{{ activity.title }} </div>
                    <div class="time-span"> <i class="la la-clock-o" style="font-size: 14px;"></i> {{ activity.start | formatTime("HH:mm") }} - {{ activity.end | formatTime("HH:mm") }}</div>
                </div>
                <div class="we-flex-row kt-pr0">
                    <button type="button" class="btn btn-sm btn-success btn-elevate btn-pill we-pill kt-mb-5"><i class="la la-check"></i> Ja</button>
                    <button type="button" class="btn btn-sm btn-danger btn-elevate btn-pill we-pill"><i class="la la-close"></i> Nej</button>
                </div>
                </div>
            </div>

        </div>
        </div>
    </div>

</div>
</template>
