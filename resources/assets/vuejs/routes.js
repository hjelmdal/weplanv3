import VueRouter from 'vue-router';

let routes = [
    {
        name: "Home",
        path: '/',
        component: require('./views/test').default,
        meta: {
            access: "public",
            icon: "flaticon-home",
            title: "Home",
        }
    },
    {
        path: '/activities',
        component: require('./components/EmptyRouterView').default,
        meta: {
            access: "protected",
            icon: "flaticon2-calendar-8",
        },

        children: [
            {
                name: "Aktiviteter",
                path: '/',
                component: require('./activities/components/UserActivities').default,
                meta: {
                    access: "protected",
                    icon: "flaticon2-calendar-8",
                    title: "Aktiviteter",
                }
            },
            {
                name: "Aktivitet",
                path: 'date/:spaDate',
                component: require('./activities/components/UserActivities').default,
                props:true,
                meta: {
                    access: "protected",
                    icon: "flaticon2-calendar-8",
                    title: null,
                }
            }
        ]
    },

    {
        name: "Brugere",
        path: '/users',
        component: require('./users/components/usersAdmin').default,
        meta: {
            access: "protected",
            roles: ["super-admin","player"],
            icon: "flaticon-users",
            title: "Brugere"
        }
    },

];
window.routes = routes;
const router = new VueRouter({
    routes,
    linkActiveClass: 'is-active',
    //mode: 'history',

});
router.beforeEach((to, from, next) => {
    let access = to.meta.access;
    let roles = to.meta.roles;
    let notify = new Notify();
    if(access) {
        if (access == "public") {
            console.log("public route");
            next();
        } else if(access == "protected" && !roles) {
            axios.get("/api/v1/user")
                .then(data => {
                    console.log("Authorized");
                        next();

                })
                .catch(e => {
                    notify.send("warning","Du er ikke logget ind!");
                    //next("/login");
                })
        } else if(access == "protected" && roles) {
            let form = new Form({
                roles: to.meta.roles
            })
            form.post("/api/v1/user/roles")
                .then(data => {
                    next();
                })
                .catch(e => {
                    if(e.status == 403) {

                        notify.send("warning","Du har ikke de krævede rettigheder til at se denne side!");
                    }
                })
        }
    } else {
        console.log("Route access is not set!");
    }
});
export default router;
