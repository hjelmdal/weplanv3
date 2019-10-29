import Vue from 'vue';
import Vuex from 'vuex';
import teams from './modules/teams';
import players from "./modules/players";
import activities from "./modules/activities";
import bpPlayers from "./modules/BadmintonDanmark/players";
import users from "./modules/users";
import auth from "./modules/auth";
Vue.use(Vuex);


export default new Vuex.Store({
    modules: {
        auth,
        users,
        teams,
        players,
        activities,
        bpPlayers
    }
});
