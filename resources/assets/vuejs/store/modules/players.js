const state = {
    players: [],
    playersUsers: []
}

const getters = {
    getAllPlayers: (state) => {
        return state.players;
    },
    getAllPlayersWithUsers: (state) => {
        return state.playersUsers;
    },

    getObjById: (state) => (id) => {
        return state.players.find(obj => obj.id === id)
    }
}

const mutations = {
    setPlayers: (state, players) => {
        state.players = players;
    },
    setPlayersUsers: (state, players) => {
        state.playersUsers = players;
    }
}

const actions = {
    getAllPlayers: async (context) => {
        let players = [];
        return new Promise((resolve, reject) => {
            axios.get("/api/v1/players")
                .then(players => {
                    context.commit('setPlayers', players.data.data);
                })
        })


    },
    getAllPlayersWithUsers: async (context) => {
        let players = [];
        return new Promise((resolve, reject) => {
            axios.get("/api/v1/players/byteam")
                .then(players => {
                    context.commit('setPlayersUsers', players.data.data);
                })
        })


    },

    setPlayerTeam : async (context, { payload }) => {
        return new Promise((resolve, reject) => {
            let form = new Form({
                team: payload.team_id,
                player_id: payload.player.id
            });

            form.patch("/api/v1/players/" + form.player_id)
                .then(data1 => {

                    context.dispatch('setTeams');
                    context.dispatch('getAllPlayers');
                    resolve(data1)
                })
        });

    },
    setTeams ({dispatch}) {
        dispatch('teams/getAllTeams',null,{root:true});
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
