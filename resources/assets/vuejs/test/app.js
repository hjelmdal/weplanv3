import Test from '../../../views/app/calendar/test.vue';


new Vue({
   components: {
     Test
   },
   el: "#kt_body",
   data: {
      tasks: [
         { id: 1, description: "This is one"},
         { id: 2, description: "This is two"}
      ]

   },

   methods: {
      test() {
         this.tasks.push({ id: 3, description: "This is three"});
      }
   },
   mounted: function () {


         this.test();

   }
});