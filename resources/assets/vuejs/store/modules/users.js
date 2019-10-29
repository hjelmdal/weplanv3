const state = {
    users: [],
    myUser: Object,
}

const getters = {
    getAllUsers: (state) => {
        return state.users;
    },

    getUserById: (state) => (id) => {
        return state.users.find(user => user.id === id)
    }
}

const mutations = {
    setUsers: (state, users) => {
        state.users = users;
    }
}

const actions = {
    getUsers: async (context) => {
        var users = []; // Axios here
        context.commit('setUsers', users)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
