<template>
    <div class="row">
        <div class="col-sm-12">
            <h1>Users</h1>
        </div>

        <div class="col-sm-12">
            <b-table hover :items="users.data" v-bind:fields="fieldsList.users">
                <template slot="edit" slot-scope="user">
                    <i class="fa fa-edit" @click="editUser(user.index)" style="cursor : pointer !important;"></i>
                </template>
            </b-table>
        </div>

        <b-modal ref="userEdit" centered>
            <div slot="modal-header">
                <h3 v-text="'Edit : ' + user.fullName"></h3>
            </div>

            <!-- ID -->
            <b-row class="mb-1">
                <b-col cols="4" class="pt-1">
                    ID
                </b-col>
                <b-col cols="8" v-text="user.id"></b-col>
            </b-row>

            <!-- Full Name -->
            <b-row class="mb-1 justify-content-center">
                <b-col cols="4" class="pt-2">
                    Full Name
                </b-col>
                <b-col cols="8">
                    <b-form-input v-model="user.fullName" type="text"
                                  placeholder="Full Name, ex John Doe"></b-form-input>
                </b-col>
            </b-row>

            <!-- Role -->
            <b-row class="mb-1 justify-content-center">
                <b-col cols="4" class="pt-2">
                    Role
                </b-col>
                <b-col cols="8">
                    <b-form-select v-model="user.role" :options="roles" class="mb-3"></b-form-select>
                </b-col>
            </b-row>

            <div slot="modal-ok">
                <b-button variant="success">Save</b-button>
            </div>

        </b-modal>

    </div>
</template>

<script>
    export default {
        name: "Users",
        metaInfo: {
            title: 'Admin | Users'
        },
        data() {
            return {
                user: {},
                roles: [
                    {value: 'user', text: 'User'},
                    {value: 'su', text: 'Administrator'}
                ],
                users: [],
                fieldsList: {
                    users: {
                        id: {label: '#'},
                        fullName: {label: 'Full Name'},
                        email: {label: 'E-Mail'},
                        role: {label: 'Role'},
                        edit: {label: 'Edit'}
                    }
                }
            }
        },
        methods: {
            getUsers(link = null) {
                this.$store.state.blockUI.setMessage('Loading Users List');

                this.axios.get(link || '/api/users')
                    .then(success => {
                        this.users = success.data.data.users;
                        this.$store.state.blockUI.setDefaults();
                    }, () => {
                        this.$store.state.blockUI.setDefaults();
                    });
            },
            editUser(id = null) {
                this.user = this.users.data[id];
                this.$refs.userEdit.show();
            },
            storeUser(id = null) {

                let sc = (response) => {
                        this.getUsers();
                    },
                    fc = (errors) => {
                    };

                id ?
                    this.axios.put(`/api/users/${id}`, this.user).then(sc, fc) :
                    this.axios.post('/api/users', this.user).then(sc, fc);

            }
        },
        mounted() {
            this.getUsers();
        }
    }
</script>

<style scoped>

</style>
