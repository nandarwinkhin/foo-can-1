<template>
<v-tabs>

  <v-tabs-slider class="yellow"></v-tabs-slider>
  <v-tab href="#tab-1">
    Cash In
  </v-tab>
   <v-tab href="#tab-2">
    Cash Out
  </v-tab>


  <v-tab-item id="tab-1" center>
    <v-card width="40%" center>
    <v-card-title>
                <v-icon>payment</v-icon> Cash In
            </v-card-title>
            <v-divider></v-divider>
      <v-form v-model="valid" ref="userFormAdd" lazy-validation>
                <v-container grid-list-xl text-xs-center>
                    <v-layout v-bind="binding">
                    <v-flex xs4 offset-xs1>
                        <v-text-field label="Card ID or Name" v-model="name" :rules="nameRules"></v-text-field>
                    </v-flex>
                    <v-flex xs4 offset-xs1>
                        <v-text-field label="Current Amount" v-model="email" :rules="emailRules"></v-text-field>
                    </v-flex>
                    <v-flex xs4 offset-xs1>
                        <v-text-field label="Add Amount" type="password" v-model="password" :rules="passwordRules"></v-text-field>
                    </v-flex>
                    <v-flex xs4 offset-xs1>
                        <v-btn @click="save()" :disabled="!valid" color="primary" dark>Add</v-btn>
                    </v-flex>
                    </v-layout>
                </v-container>
            </v-form>
    </v-card>
  </v-tab-item>
  <v-tab-item id="tab-2" center>
      <v-card width="40%" center>
      <v-card-title>
                <v-icon>payment</v-icon> Cash Out
            </v-card-title>
            <v-divider></v-divider>
        <v-form v-model="valid" ref="userFormAdd" lazy-validation>
            <v-container grid-list-xl>
                    <v-layout v-bind="binding">
                    <v-flex xs4 offset-xs1>
                        <v-text-field label="Card ID or Name" v-model="name" :rules="nameRules"></v-text-field>
                    </v-flex>
                    <v-flex xs4 offset-xs1>
                        <v-text-field label="Current Amount" v-model="email" :rules="emailRules"></v-text-field>
                    </v-flex>
                    <v-flex xs4 offset-xs1>
                        <v-text-field label="Add Amount" type="password" v-model="password" :rules="passwordRules"></v-text-field>
                    </v-flex>
                    <v-flex xs4 offset-xs1>
                        <v-btn @click="save()" :disabled="!valid" color="primary" dark>Refund</v-btn>
                    </v-flex>
                    </v-layout>
                </v-container>
        </v-form>
      </v-card>
  </v-tab-item>

</v-tabs>
</template>

<script>
    export default {
        mounted() {

            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'Card Amount',name:''}
            ]);
        },
        computed: {
            binding () {
            const binding = {}

            if (this.$vuetify.breakpoint.mdAndUp) binding.column = true

            return binding
            }
        }
    }
</script>