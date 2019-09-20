import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/test').default,
        meta: {
            access: "public"
        }
    },
    {
        path: '/activities',
        component: require('./activities/components/UserActivities').default,
        meta: {
            access: "protected",
        }

    },
    {
        path: '/users',
        component: require('./users/components/usersAdmin').default,
        meta: {
            access: "protected",
            roles: ["super-admin","player"]
        }
    },

];
const router = new VueRouter({
    routes,
    linkActiveClass: 'is-active'

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
