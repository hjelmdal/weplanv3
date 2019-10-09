const state = {
    teams: []
}

const getters =  {
    getAllTeams : (state) => {
        return state.teams;
    },

    getTeamById: (state) => (id) => {
        return state.teams.find(team => team.id === id)
    }
}
const mutations = {
    SET_TEAMS : (state, teams) => {
        state.teams = teams;
    }
}

const actions = {
    getAllTeams : async (context) => {
    axios.get("/api/v1/teams")
        .then(teams => {
            let i;
            teams.data.data.forEach(event => {
                event.men = 0;
                event.women = 0;
                event.menP = 0;
                event.womenP = 0;
                if (event.players.length > 0) {
                    event.players.forEach(player => {
                        if (player.gender === "M") {
                            event.men++;
                        } else if (player.gender === "K") {
                            event.women++;
                        }
                    });
                    if (event.max_players > 0) {
                        if (event.men + event.women > event.max_players) {
                            event.menP = Math.round(event.men / (event.men + event.women) * 100);
                            event.womenP = Math.round(event.women / (event.men + event.women) * 100);

                        } else {
                            event.menP = Math.round(event.men / event.max_players * 100);
                            event.womenP = Math.round(event.women / event.max_players * 100);
                        }

                    }
                }


                i++;
            });
            context.commit('SET_TEAMS',teams.data.data)
        })
    },

    updateTeam : async (context, {payload}) => {
        return new Promise((resolve, reject) => {
            let type = "post";
            if(payload.id) {
                type = "put";
            }
                payload[type]("/api/v1/teams/" + payload.id)

                .then(data => {
                    resolve(data);
                    context.dispatch('getAllTeams');
                })
        });
    },
    saveTeam : async (context, {payload}) => {
        return new Promise((resolve, reject) => {
            let form = new Form(payload);
            form.post("/api/v1/teams")

                .then(data => {

                    context.dispatch('getAllTeams');
                    resolve(data);
                })
                .catch(e => {
                    reject(e.data);
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
