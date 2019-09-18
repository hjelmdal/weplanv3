import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/test').default


    },

    {
        path: '/activities',
        component: require('./activities/components/UserActivities').default


    },
];
export default new VueRouter({
    routes,
    linkActiveClass: 'is-active'
});
