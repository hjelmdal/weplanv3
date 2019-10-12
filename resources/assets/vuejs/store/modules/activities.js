const state = {
    objs: []
}

const getters = {
    getAllObjs: (state) => {
        return state.objs;
    },

    getObjById: (state) => (id) => {
        return state.objs.find(obj => obj.id === id)
    }
}

const mutations = {
    setObjs: (state, objs) => {
        state.objs = objs;
    }
}

const actions = {
    getObjs: async (context) => {
        var objs = []; // Axios here
        context.commit('setObjs', objs)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
