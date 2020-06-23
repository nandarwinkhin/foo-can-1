<template>
<div class="component-wrap">
    <!-- search -->
    <v-card class="pt-3">
        <div class="d-flex flex-row">
            <div class="flex-grow-1 pa-2">
                <v-btn @click.stop="dialog = true" class="primary lighten-1" dark>
                    New Card Type
                    <v-icon right dark>add</v-icon>
                </v-btn>
                <v-dialog v-model="dialog" max-width="500">
                    <v-card>
                        <v-card-title class="headline">Add New Card Type</v-card-title>
                        <v-card-text>
                            <v-form class="px-3">
                                <v-text-field label="Card Type" v-model="title" prepend-icon="folder"></v-text-field>
                                <v-textarea label="Description" v-model="content" prepend-icon="edit"></v-textarea>
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="green darken-1" text @click="dialog = false">
                                Add
                            </v-btn>
                            <v-btn color="green darken-1" text @click="dialog = false">
                                Cancel
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </div>
        </div>
        <div class="d-flex flex-lg-row flex-sm-column">
            <div class="flex-grow-1 pa-2">
                <v-text-field filled prepend-icon="search" label="Filter By Name" v-model="filters.name"></v-text-field>
            </div>
        </div>
    </v-card>
    <!-- /search -->
    <v-divider class="pb-2" />
    <!-- data table -->
    <v-data-table hide-default-header v-bind:headers="headers" :options.sync="pagination" :items="items" :server-items-length="totalItems" class="elevation-1">
        <template v-slot:header="{props:{headers}}">
            <thead>
                <tr>
                    <th v-for="header in headers">
                        <div v-if="header.value=='name'" :class="`text-${header.align}`">
                            <v-icon>mdi-person</v-icon> {{header.text}}
                        </div>
                        <div v-else-if="header.value=='email'" :class="`text-${header.align}`">
                            <v-icon>mdi-email</v-icon> {{header.text}}
                        </div>
                        <div v-else-if="header.value=='cards'" :class="`text-${header.align}`">
                            <v-icon>mdi-email</v-icon> {{header.text}}
                        </div>
                        <div v-else :class="`text-${header.align}`">{{header.text}}</div>
                    </th>
                </tr>
            </thead>
        </template>
        <template v-slot:body="{items}">
            <tbody>
                <tr v-for="item in items" :key="item.id">
                    <td>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </template>
    </v-data-table>
<v-divider class="py-5" />
</div>
</template>
<script>
export default {
    data() {
        return {
            dialog: false,
            headers: [{
                    text: 'Action',
                    value: false,
                    align: 'left',
                    sortable: false
                },
                {
                    text: 'Card Type Name',
                    value: 'name',
                    align: 'left',
                    sortable: false
                },
                {
                    text: 'Description',
                    value: 'email',
                    align: 'left',
                    sortable: false
                },
                {
                    text: 'Number of Cards',
                    value: 'cards',
                    align: 'left',
                    sortable: false
                },
            ],
            items: [],
            totalItems: 0,
            pagination: {
                itemsPerPage: 10
            },
            filters: {
                name: '',
                email: '',
                groupId: [],
                groupOptions: []
            },
            dialogs: {
                showPermissions: {
                    items: [],
                    show: false
                }
            }
        }
    },
    mounted() {
        const self = this;
        self.loadGroups(() => {});
        self.$eventBus.$on(['USER_ADDED', 'USER_UPDATED', 'USER_DELETED', 'GROUP_ADDED'], () => {
            self.loadUsers(() => {});
        });
        self.$store.commit('setBreadcrumbs', [{
            label: 'Users',
            to: {
                name: 'users.list'
            }
        }, ]);
    },
    watch: {
        pagination: {
            handler() {
                this.loadUsers(() => {});
            },
        },
        'filters.name': _.debounce(function () {
            const self = this;
            self.loadUsers(() => {});
        }, 700),
        'filters.email': _.debounce(function () {
            const self = this;
            self.loadUsers(() => {});
        }, 700),
        'filters.groupId': _.debounce(function () {
            const self = this;
            self.loadUsers(() => {});
        }, 700)
    },
    methods: {
        trash(user) {
            const self = this;
            self.$store.commit('showDialog', {
                type: "confirm",
                icon: 'warning',
                title: "Confirm Deletion",
                message: "Are you sure you want to delete this user?",
                okCb: () => {
                    axios.delete('/admin/users/' + user.id).then(function (response) {
                        self.$store.commit('showSnackbar', {
                            message: response.data.message,
                            color: 'success',
                            duration: 3000
                        });
                        self.$eventBus.$emit('USER_DELETED');
                    }).catch(function (error) {
                        self.$store.commit('hideLoader');
                        if (error.response) {
                            self.$store.commit('showSnackbar', {
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
                cancelCb: () => {
                    console.log("CANCEL");
                }
            });
        },
        showDialog(dialog, data) {
            const self = this;
            switch (dialog) {
                case 'user_permissions':
                    self.dialogs.showPermissions.items = data;
                    setTimeout(() => {
                        self.dialogs.showPermissions.show = true;
                    }, 500);
                    break;
            }
        },
        loadUsers(cb) {
            const self = this;
            let params = {
                name: self.filters.name,
                email: self.filters.email,
                group_id: self.filters.groupId.join(","),
                page: self.pagination.page,
                per_page: self.pagination.itemsPerPage
            };
            axios.get('/admin/users', {
                params: params
            }).then(function (response) {
                self.items = response.data.data.data;
                self.totalItems = response.data.data.total;
                self.pagination.totalItems = response.data.data.total;
                (cb || Function)();
            });
        },
        loadGroups(cb) {
            const self = this;
            let params = {
                paginate: 'no'
            };
            axios.get('/admin/groups', {
                params: params
            }).then(function (response) {
                self.filters.groupOptions = response.data.data;
                cb();
            });
        }
    }
}
</script>