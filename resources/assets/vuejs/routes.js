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
    {
        name: "Spillere",
        path: '/players',
        component: require('./players/components/PlayersAdmin').default,
        meta: {
            access: "protected",
            roles: ["super-admin","coach"],
            icon: "flaticon-users",
            title: "Spillere"
        }
    },
    {
        name: "Trupper",
        path: '/teams',
        component: require('./teams/components/teamsAdmin').default,
        meta: {
            access: "protected",
            roles: ["super-admin","player"],
            icon: "flaticon-users",
            title: "Trupper"
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
            document.querySelector("#kt_aside_close_btn").click();
            next();
        } else if(access == "protected" && !roles) {
            axios.get("/api/v1/auth/user")
                .then(data => {
                    console.log("Authorized");
                    document.querySelector("#kt_aside_close_btn").click();
                    next();

                })
                .catch(e => {
                    notify.send("warning","Du er ikke logget ind!");
                    window.location.href = "/login";
                })
        } else if(access == "protected" && roles) {
            let form = new Form({
                roles: to.meta.roles
            })
            form.post("/api/v1/auth/user/roles")
                .then(data => {
                    document.querySelector("#kt_aside_close_btn").click();
                    next();
                })
                .catch(e => {
                    if(e.status == 403) {

                        notify.send("warning","Du har ikke de krævede rettigheder til at se denne side!");
                    }

                    if(e.status == 401) {

                        notify.send("warning","Du er ikke logget ind!!");

                        window.location.href = "/login";
                    }
                })
        }
    } else {
        console.log("Route access is not set!");
    }
});
export default router;
