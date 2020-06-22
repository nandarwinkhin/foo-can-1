<template>
    <div id="info">
        <h2>{{text}} </h2>
        <p>{{total}}</p>
        <button @click="btnClick" class="btn btn-danger" id="btn">Danger</button>
       
    </div>
   
</template>
 
<script>
   export default {
        mounted() {

            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'About Us',name:''}
            ]);
            console.log('helloworld')
        },
      data(){
          const self = this;
          return{
              text:'HelloWorld',
              total:'',
              num1:100,
              num2:100,
          }
          
      },
    
      methods:{
         
          btnClick(){
               const self = this;
            //   this.$emit('btnClick')
              //alert("helloWorld");
             self.total=self.num1+self.num2
          }
      }
      
    }
  
</script>


