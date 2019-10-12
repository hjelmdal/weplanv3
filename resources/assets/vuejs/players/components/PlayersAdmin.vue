<script>
    export default {
        name: "PlayersAdmin",
        data() {
          return {
              playerFields: [
                  {key: "index", label: "#", sortable: false, class: "fit"},
                  {key: "dbf_id", label: "ID", sortable: true, class: "fit"},
                  {key: "name", label: "Navn", sortable: true, class: "text-ellipsis ellipsis-name"},
                  {key: "gender", label: "Køn", sortable: true, class: "kt-align-center"},
                  {key: "team.name", label: "Trup", sortable: true, class: "kt-pr0-mobile fit"},
                  {key: "action", label: " ", sortable: false, class: "kt-align-right"}
              ],
              selected: null,
              options: [
                  { value: null, text: 'Please select an option' },
                  { value: 'a', text: 'This is First option' },
                  { value: 'b', text: 'Selected Option' },
                  { value: { C: '3PO' }, text: 'This is an option with object value' },
                  { value: 'd', text: 'This one is disabled', disabled: true }
              ]
          }
        },

        methods: {
            getInitials(name) {
                if(name) {
                    let nameSplit = name.split(" ");
                    let final = "";
                    nameSplit.forEach(function(i, idx, array){
                        i = i.substr(0,1);
                        if(idx == 0) {
                            final = final + i;
                        }
                        if (idx === array.length - 1 && i.substr(0,1) != '(') {
                            final = final + i;
                        } else if(idx === array.length - 1 && array.length > 2) {
                            final = final + array[idx - 1].substr(0,1);

                        }
                    });


                    return final;
                }
            },
            test(id) {
                console.log("YAAAAH" + id);
            }
        },

        computed: {
            players() {
                return this.$store.getters["players/getAllPlayersWithUsers"];
            }
        },
        mounted() {
            this.$store.dispatch('players/getAllPlayersWithUsers');
        }
    }
</script>

<style scoped>

</style>

<template>
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="flaticon2-user"></i>
					</span>
                <h3 class="kt-portlet__head-title">
                    Spillere
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <b-table striped show-empty responsive empty-text="Ingen spillere fundet" sort-icon-left small :fields="playerFields" :items="players">
                <template v-slot:cell(index)="data">
                    {{ data.index + 1 }}
                </template>
                <template v-slot:cell(name)="data">
                    <div :class="{ 'kt-media--danger' : data.item.gender == 'K'}" class="kt-media kt-media--brand kt-media--sm kt-media--circle">
                        <span>{{ getInitials(data.value) }}</span>
                    </div> {{ data.value }} <i v-if="data.item.user" class="flaticon2-correct kt-font-brand"></i>
                </template>
                <template v-slot:cell(gender)="data">
                    <i v-if="data.value == 'M'" class="fa fa-2x fa-male kt-font-brand"></i>
                    <i v-if="data.value == 'K'" class="fa fa-2x fa-female kt-font-danger"></i>
                </template>
                <template v-slot:cell(team.name)="data">
                    <span  v-if="data.value" v-b-tooltip.hover :title="data.value" class="badge badge-secondary badge-sm text-ellipsis ellipsis-team">{{ data.value }}</span>
                    <span v-else v-b-tooltip.hover :title="'Sæt på trup'" class="badge badge-secondary badge-sm text-ellipsis ellipsis-team">- Ikke tilkyttet trup -</span>

                </template>
                <template v-slot:cell(action)="data">
                    <div class="btn-group" role="group" aria-label="...">
                    <span>
                        <div class="btn-group" role="group" aria-label="Administration af spillere">
                            <button :id="'popover-target-' + data.item.id" class="btn btn-sm btn-outline-brand btn-icon" role="button"><i class="la la-users"></i></button>
                            <button class="btn btn-sm btn-outline-success btn-icon"  role="button"><i class="la la-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger btn-icon"  role="button"><i class="la la-trash"></i></button>
                        </div>

                        <b-popover :target="'popover-target-' + data.item.id" triggers="click" placement="left">
                        <template v-slot:title>Popover Title</template>
                        <v-select @input="test(data.item.id)" label="text" :options="options" v-model="selected" :clearable="false"></v-select>
                    </b-popover>
                    </span>
                    </div>
                </template>
            </b-table>
        </div>
        <div class="kt-portlet__foot kt-hidden">
            <div class="row">
                <div class="col-lg-6">
                    Portlet footer:
                </div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <span class="kt-margin-left-10">or <a href="#" class="kt-link kt-font-bold">Cancel</a></span>
                </div>
            </div>
        </div>
    </div>
</template>
