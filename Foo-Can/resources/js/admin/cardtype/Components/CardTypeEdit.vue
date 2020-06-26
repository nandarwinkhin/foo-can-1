<template>
    <div>
        <v-card>
            <v-card-title>
                <v-icon>payment</v-icon> Edit Card Type
            </v-card-title>
            <v-divider class="mb-2"></v-divider>
            <v-form v-model="valid" ref="userFormEdit" lazy-validation>
                <v-container grid-list-md>
                <v-layout row wrap>
                    <v-flex xs12 sm6>
                        <v-text-field label="Card Type" v-model="cardTypeName" ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-text-field label="Description" v-model="cardTypeDescription"></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                        <v-btn @click="save()" :disabled="!valid" color="primary" dark>Update</v-btn>
                    </v-flex>
                </v-layout>
            </v-container>
            </v-form>
        </v-card>
    </div>
</template>

<script>
    export default {
        props: {
            cardType_id: {
                required: true
            }
        },
        data() {

            const self = this;

            return {
                valid: false,
                cardTypeName: '',
                cardTypeDescription: '',
                
            }
        },
        mounted() {
            console.log('components.CardTypeEdit.vue');

            const self = this;

            this.loadCardTypes(()=>{});
        },
        methods: {
            save() {

                const self = this;

                let payload = {
                    cardTypeName: self.cardTypeName,
                    cardTypeDescription: self.cardTypeDescription
                };

                self.$store.commit('showLoader');

                axios.put('/admin/cardtype/'+self.cardType_id,payload).then(function(response) {

                    self.$store.commit('showSnackbar',{
                       message: response.data.message,
                       color: 'success',
                       duration: 3000
                    });

                    self.$eventBus.$emit('CARDTYPE_UPDATED');
                    self.$store.commit('hideLoader');

                    // //reset
                    // self.$refs.cardtype.reset();
                    // self.cardtypes = [];

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
 

            loadCardTypes(cb) {

                const self = this;

                // reset first
                // self.groups = [];

                axios.get('/admin/cardtype/' + self.cardType_id).then(function(response) {
                    let CardType = response.data.data;

                    self.cardTypeName = CardType.cardTypeName;
                    self.cardTypeDescription = CardType.cardTypeDescription;


                    self.$store.commit('setBreadcrumbs',[
                        {label:'Cardtypes',to:{name:'cardtype.list'}},
                        {label:CardType.cardTypeName,to:''},
                        {label:'Edit',to:''},
                    ]);

                    cb();
                });
            },

        }
    }
</script>