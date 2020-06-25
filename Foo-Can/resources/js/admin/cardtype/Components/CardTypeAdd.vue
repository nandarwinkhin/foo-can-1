<template>
<div id="cardtypediv">
<v-card>
        <v-card-title>
            <v-icon>payment</v-icon> New Card Type
        </v-card-title>
        <v-divider></v-divider>
        <v-form v-model="valid" ref="userFormAdd" lazy-validation>
            <v-container grid-list-md>
                <v-layout row wrap>
                <v-row>
                    <v-flex xs12 sm12>
                        <v-text-field label="Card Type" v-model="cardTypeName"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-textarea label="Description" v-model="cardTypeDescription"></v-textarea>
                    </v-flex>
                    <v-flex xs12 sm12>
                        <v-btn @click="save()" :disabled="!valid" color="primary" dark>Submit</v-btn>
                    </v-flex>
                </v-row>
                </v-layout>
            </v-container>
        </v-form>
    </v-card>
</div>
</template>
<script>
    export default {
        el : "#cardtypediv",
        data(){
            return{
                valid: false,
                // items: [],
                // hasError: true,
                // newItem: { 'CardTypeName': '','CardTypeDescription': ''},
                cardTypeName:'',
                cardTypeDescription:'',
                // CreatedBy:'1',
            }
        },
        mounted() {

            console.log('components.CardTypeAdd.vue');

            const self = this;

            self.$store.commit('setBreadcrumbs',[
                {label:'cardtype',to:{name:'cardtype'}},
                {label:'Create',to:''},
            ]);
        },
        methods : {
            save() {
                const self = this;

                let payload = {
                    cardTypeName: self.cardTypeName,
                    cardTypeDescription: self.cardTypeDescription,
                };

                self.$store.commit('showLoader');

                axios.post('/admin/cardtype',payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                       message: response.data.message,
                       color: 'success',
                       duration: 3000
                    });

                    self.$eventBus.$emit('CARDTYPE_ADDED');
                    self.$store.commit('hideLoader');

                    // reset
                    self.$refs.cardtype.reset();
                    self.cardtypes = [];

                }).catch(function (error) {

                    self.$store.commit('hideLoader');

                    if (error.response) {
                        self.$store.commit('showSnackbar',{
                            message: error.response.data.message,
                            color: 'error',
                            duration: 3000
                        });
                    } else if (error.request) {
                        console.log(error.request);
                    } else {
                        console.log('Error', error.message);
                    }
                });
            },
            
        }
            
        
    }
</script>