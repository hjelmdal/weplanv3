const state = {
    activities: [],
    types: [],
    calendar: [],
    date:"",
    type:"",
    filters:"",
}

const getters = {
    getActivities: (state) => {
        return state.activities;
    },

    getActivityById: (state) => (id) => {
        return state.activities.find(item => item.id === parseInt(id))
    },

    getActivityTypes: (state) => {
        return state.types;
    },
    getCalendar: (state) => {
        return state.calendar;
    }
}

const mutations = {
    setActivities: (state, activities) => {
        state.activities = activities;
    },
    setTypes: (state, types) => {
        state.types = types;
    },
    setCalendar: (state, calendar) => {
        state.calendar = calendar;
    },
    setActivity: (state, activity) => {
        const item = state.activities.find(item => item.id === activity.id);
        if(item) {
            Object.assign(item, activity);
        } else {
            //state.activities[0] = activity;
            state.activities.push(activity);
        }
      }
}

const actions = {
    getActivities: async (context,{date: date,filters:filters,type:type}) => {
        var activities = []; // Axios here
        var types = [];
        if(!date) {
            date = moment().format("YYYY-MM-DD");
        }
        if(!type) {
            type = "week";
        }
        let form = new Form({
            filters: filters,
        });
        state.date = date;
        state.type = type;
        state.filters = filters;
        return new Promise((resolve, reject) => {
           axios.post('/api/v1/calendar/' + type + '/' + date,{filters})
               .then((response) => {
                    activities = response.data.data;
                    types = response.data.types;
                    context.commit('setActivities', activities);
                    context.commit('setCalendar', response.data.calendar);
                    if(state.types.length == 0) {
                        context.commit('setTypes', types);
                    }
               })
        });

    },
    getActivityById: async (context, {id: id}) => {
        return new Promise((resolve, reject) => {
           axios.get('/api/v1/activities/' + id)
               .then((response) => {
                   context.commit('setActivity',response.data.data);
                   resolve(response.data);
               })
        });
    },
    confirmActivityById: async (context, {activity_id }) => {
        return new Promise((resolve, reject) => {
            axios.post("/api/v1/activities/confirm",{activity_id: activity_id})
                .then(response => {
                   console.log(response.data);
                   context.dispatch('getActivities',{date: state.date,filters: state.filters,type: state.type});
                   resolve(response.data);
                });
        });

    },
    declineActivityById: async (context, {activity_id, description, category }) => {
        return new Promise((resolve, reject) => {
            axios.post("/api/v1/activities/decline",{activity_id: activity_id, category: category, description: description,})
                .then(response => {
                    console.log(response.data);
                    context.dispatch('getActivities',{date: state.date,filters: state.filters,type: state.type});
                    resolve(response.data);
                });
        });

    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
