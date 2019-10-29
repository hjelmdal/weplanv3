const state = {
    user: []
}

const getters = {
    getMyUser: (state) => {
        return state.user;
    },

}

const mutations = {
    setUser: (state, user) => {
        state.user = user;
    }
}

const actions = {
    getUser: async (context) => {
        var user = []; // Axios here
        context.commit('setUser', user)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
