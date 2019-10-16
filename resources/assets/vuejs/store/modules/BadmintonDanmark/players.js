const state = {
    players: []
}

const getters = {
    getAllPlayers: (state) => {
        return state.players;
    },

    getPlayerById: (state) => (id) => {
        return state.players.find(player => player.id === id)
    }
}

const mutations = {
    setPlayers: (state, players) => {
        state.players = players;
    }
}

const actions = {
    getAllPlayers: async (context) => {
        let players = [];
        return new Promise((resolve, reject) => {
            axios.get("/api/v1/BP/players")
                .then(players => {
                    context.commit('setPlayers', players.data.data);
                })
        })
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
