<script>
    export default {
        name: "EditTeam",
        props:["team"],
        data() {
            return {
                form: new Form({
                    id: this.team.id,
                    name: this.team.name,
                    max_players:this.team.max_players


                }),
                sortBy: ['name'],
                fields: [
                    { key: "index", label: "#", sortable: false },
                    { key: "name", sortable: true },
                    { key: "gender", sortable: true},
                    { key: "action", sortable: false}
                ],
            }
        }
    }
</script>

<style>
    .b-table > tbody > tr > td {
        vertical-align: middle;
    }
</style>

<template v-slot:modal-title="team.name">
   <div>
       <b-tabs content-class="mt-3">
           <b-tab title="Info" active>
               <!--begin::Section-->
               <div class="kt-section kt-form__section--first">

                   <!-- begin::form rows -->
                   <div class="form-group kt-form__group row">
                       <label class="col-form-label col-lg-3 col-sm-12">Navn</label>

                       <div class="col-lg-6 col-md-9 col-sm-12">
                           <input name="id" type="hidden" :value="team.id" />
                           <input name="name" class="form-control kt-input" id="name" autocomplete="new-password" type="text" placeholder="Trup navn" :value="team.name">
                           <span class="kt-form__help">Skriv et sigende navn for den trup du opretter</span>

                       </div>

                   </div>

                   <div class="form-group kt-form__group row">


                       <label class="col-form-label col-lg-3 col-sm-12">Max antal spillere</label>

                       <div class="col-lg-6 col-md-9 col-sm-12">
                           <input name="max_players" class="form-control kt-input" id="max_players" type="number" placeholder="20" :value="team.max_players">
                           <span class="kt-form__help">Hvor mange ønsker du max på denne trup?</span>

                       </div>

                   </div>
                   <div class="form-group kt-form__group row">


                       <label class="col-lg-3 col-sm-12">Aktiv?</label>

                       <div class="col-lg-6 col-md-9 col-sm-12">
                           <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                               <input name="active"  type="checkbox" :checked="team.active = 1"> Er truppen aktiv?
                               <span></span>
                           </label>



                       </div>

                   </div>
               </div>
               <!--end::Section-->
           </b-tab>
           <b-tab title="Spillere">
                <b-table small :sort-by.sync="sortBy" :fields="fields" :items="team.players">
                    <template v-slot:cell(index)="data">
                        {{ data.index + 1 }}
                    </template>
                    <template v-slot:cell(gender)="data">
                        <i v-if="data.value == 'M'" class="fa fa-2x fa-male kt-font-brand"></i>
                        <i v-if="data.value == 'K'" class="fa fa-2x fa-female kt-font-danger"></i>
                    </template>
                    <template v-slot:cell(action)="data">
                        <div class="btn-group" role="group" aria-label="...">
                            <a class="btn btn-sm btn-success" href="http://skovbakken.weplan.dk/admin/players/46/edit" title="Edit player" role="button"><i class="la la-pencil"></i></a>
                            <a data-toggle="modal" data-target="#modal-small" class="btn btn-sm btn-danger" href="http://skovbakken.weplan.dk/admin/teams/1/remove/46" title="Remove from team" role="button"><i class="la la-trash"></i></a>
                        </div>
                    </template>
                </b-table>
           </b-tab>
       </b-tabs>


   </div>
</template>
