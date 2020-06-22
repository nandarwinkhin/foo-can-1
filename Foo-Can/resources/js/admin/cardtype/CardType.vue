<template>
    <div class="page_wrap_vue pa-3">
 
  <h2>Horizontal form</h2>
  <form class="form-horizontal" action="/action_page.php">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-6">
        <input type="email" class="form-control" id="email" v-model="email" placeholder="Enter email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-6">          
        <input type="password" class="form-control" id="pwd" v-model="password" placeholder="Enter password" name="pwd">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" @click="submit" class="btn btn-outline-primary">Submit</button>
      </div>
    </div>
  </form>
</div>
    
   
</template>
 
<script>
    export default {
        mounted() {

            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'Card Type',name:''}
            ]);
        },
        data(){
            const self = this
            return{
                email:'',
                password:'',
                show:'',
            }
        },
        methods:{
            submit(){
                const self = this
                self.show=self.email+' '+self.password
                alert(self.email+' '+self.password)
            }
        }
    }
</script>
