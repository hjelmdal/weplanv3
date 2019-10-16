<script>
export default {
    name: "TeamForm",
    props: ["team"],
    data() {
        return {
            form: new Form({
                id:"",
                name:"",
                max_players: "",
                active: 1,
                resetOnSuccess: false,
            }),
            errors:[]
        }
    },
    methods: {
        modalUpdateTeam() {
            let dispatcher = "saveTeam";
            if(this.team && this.team.id) {
                dispatcher = "updateTeam";
            }
            this.$store.dispatch('teams/' + dispatcher,{payload: this.form})
                .then(data => {
                    this.$swal({
                        title: data.message,
                        timer: 1000,
                        type: 'success',
                        position: 'top',
                        showConfirmButton: false,
                    });
                    var self = this;
                    setTimeout(function () {
                        self.$bvModal.hide("editTeam");
                        self.$bvModal.hide("createTeam");
                    },1000);

                })
                .catch(data => {
                    if(data && data.errors) {
                        this.errors = data.errors;
                    }
                    this.$swal({
                        title: data.message,
                        timer: 1000,
                        type: 'error',
                        position: 'top',
                        showConfirmButton: false,
                    });
                })
        },
    },
    mounted() {
        if(this.team && this.team.id) {
            this.form.id = this.team.id;
            this.form.name = this.team.name;
            this.form.max_players = this.team.max_players;
            this.form.active = this.team.active;
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <!--begin::Section-->
    <div class="kt-section kt-form__section--first">

        <!-- begin::form rows -->
        <div class="form-group kt-form__group row">
            <label class="col-form-label col-lg-3 col-sm-12">Navn</label>

            <div class="col-lg-6 col-md-9 col-sm-12">
                <input name="id" type="hidden" v-model="form.id" />
                <input name="name" :class="errors.name ? 'is-invalid': ''" class="form-control kt-input" id="name" autocomplete="new-password" type="text" placeholder="Trup navn" v-model="form.name">
                <div v-for="error in errors.name" class="invalid-feedback">{{ error.replace("name","Feltet") }}</div>
                <span class="kt-form__help">Skriv et sigende navn for den trup du opretter</span>

            </div>

        </div>

        <div class="form-group kt-form__group row">


            <label class="col-form-label col-lg-3 col-sm-12">Max antal spillere</label>

            <div class="col-lg-6 col-md-9 col-sm-12">
                <input name="max_players" :class="errors.max_players ? 'is-invalid': ''" class="form-control kt-input" id="max_players" type="tel" placeholder="20" v-model="form.max_players">
                <div v-for="error in errors.max_players" class="invalid-feedback">{{ error.replace("max players","Feltet") }}</div>
                <span class="kt-form__help">Hvor mange ønsker du max på denne trup?</span>

            </div>

        </div>
        <div class="form-group kt-form__group row">


            <label class="col-lg-3 col-sm-12">Aktiv?</label>

            <div class="col-lg-6 col-md-9 col-sm-12">
                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                    <input name="active" v-model="form.active" value="1" type="checkbox" > Er truppen aktiv?
                    <span></span>
                </label>



            </div>

        </div>
    </div>
    <!--end::Section-->
</template>
