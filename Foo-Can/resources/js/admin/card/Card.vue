<template>
<div class="container" style="margin:8px;color:#ff0000">
  <div class="card" style="margin:auto;padding:12px;width:800px;background-color:#b2b0b0">
    <h4 class="" style="text-align:center">Foo-Can</h4>
      <form action="" class="form">
        <div class="form-group row" style="margin:12px" >
          <label class="control-label col-md-0"  for="email">Email:</label>
          
            <input
              type="email"
              class="form-control col-md-4" 
              id="email"
              v-model="email"
              placeholder="Enter email"
              name="email"
            />
            <label class="control-label col-md-0" for="email">Email:</label>
          
            <input
              type="email"
              class="form-control col-md-4" 
              id="email"
              v-model="email"
              placeholder="Enter email"
              name="email"
            />
         
        </div>
      </form>
   
  </div>
  </div>
</template>

<script>
export default {
  mounted() {
    const self = this;

   self.$store.commit("setBreadcrumbs", [{ label: "Card", name: "" }]);
  },
  data: () => ({
    // items: ["Bronze", "Gold", "Platinum"],
    // card: [(val) => (val || "").length > 0 || "This field is required"],
  }),
};
</script>
