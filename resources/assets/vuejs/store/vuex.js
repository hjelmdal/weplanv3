import Vue from 'vue';
import Vuex from 'vuex';
import teams from './modules/teams';
import players from "./modules/players";
import activities from "./modules/activities";
import bpPlayers from "./modules/BadmintonDanmark/players";
Vue.use(Vuex);


export default new Vuex.Store({
    modules: {
        teams,
        players,
        activities,
        bpPlayers
    }
});
