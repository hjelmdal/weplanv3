const state = {
    activities: []
}

const getters = {
    getAllActivities: (state) => {
        return state.activities;
    },

    getActivityById: (state) => (id) => {
        return state.activities.find(activity => activity.id === id)
    }
}

const mutations = {
    setActivities: (state, activities) => {
        state.activities = activities;
    }
}

const actions = {
    getActivities: async (context,{date: date}) => {
        var activities = []; // Axios here
        if(!date) {
            date = moment().format("YYYY-MM-DD");
        }
        return new Promise((resolve, reject) => {
           axios.get('/api/v1/activities/get/' + date)
               .then((response) => {
                   this.types = response.data.types;
                   this.to = response.data.to;
                   this.from = response.data.from;
                   this.total = response.data.total;
                   this.activities = response.data.data;
                   this.days = [];
                   this.calendar.start_date = response.data.start_date;
                   this.end_date = response.data.end_date;
                   this.calendar.next_week = response.data.next_week;
                   this.calendar.prev_week = response.data.prev_week;
                   this.user = response.data.user;

                   if(this.user.roles && this.user.roles.length) {
                       this.user_role = this.user.roles[0].id;
                   }
                   let last_start_date;
                   if(this.activities) {
                       this.activities.forEach(event => {
                           if (event.start_date === last_start_date) {
                               this.days[this.days.length - 1].events.push(event);
                           } else {
                               this.days.push({
                                   date: event.start_date,
                                   events: [event]
                               });
                           }
                           last_start_date = event.start_date;

                       });
                   }
                   if(firstLoad || this.filters.indexOf(true) == -1) {
                       this.filters[0] = (false);
                       this.types.forEach(type => {
                           this.filters[type.id] = (true);
                       });
                   }

                   //console.log(this.days);

                   this.calendar.next = response.data.next_week_url;
                   this.calendar.prev = response.data.prev_week_url;
                   if(this.reload === 0) {
                       if(!this.isSpa) {
                           history.pushState(null, "", "/activities/date/" + this.calendar.start_date);
                       } else {
                           history.pushState(null, "", "/#/activities/date/" + this.calendar.start_date);
                       }
                   }
                   context.commit('setActivities', activities)
               })
        });

    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
