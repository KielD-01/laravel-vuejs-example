<template>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Login</h1>
            </div>
        </div>

        <div class="row pt-5 justify-content-center">
            <div class="col-sm-12 col-md-4">
                <b-form @submit="login">
                    <b-form-group>
                        <b-form-input type="email" name="email" v-validate.immediate="{required: true, email: true}"
                                      v-model="credentials.email"
                                      placeholder="Email, ex. john.doe@example.com"></b-form-input>
                    </b-form-group>
                    <b-form-group>
                        <b-form-input type="password" name="password" v-validate.immediate="{required: true}"
                                      v-model="credentials.password"
                                      placeholder="Password"></b-form-input>
                    </b-form-group>
                    <transition name="fade">
                        <b-form-group class="text-center" v-show="errors.items.length === 0">
                            <b-button type="submit" variant="primary">Login</b-button>
                        </b-form-group>
                    </transition>
                </b-form>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Login",
        metaInfo: {
            title: 'Admin | Login'
        },
        data() {
            return {
                credentials: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            login(event) {
                event.preventDefault();

                this.$store.state.blockUI.makeVisible();
                this.$store.state.blockUI.setMessage('Trying to Log In');

                this.axios.post('/api/login', this.credentials)
                    .then(success => {
                        this.$store.state.blockUI.setDefaults();
                        this.$store.commit('setToken', success.data.data.token);

                        this
                            .$swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'You has been Logged in!',
                                timer: 3200,
                                dissmissable: false,
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                            .then(() => {
                                this.$store.dispatch('checkUser')
                                    .then(() => {
                                        return this.$router.push({name: 'home'});
                                    });
                            });
                    }, () => {
                        this.$store.state.blockUI.setDefaults();

                        this
                            .$swal({
                                type: 'warning',
                                title: 'Failed!',
                                text: 'Please, check Your credentials and try again',
                                showCancelButton: false,
                            })
                            .then(() => {
                                console.log();
                            });
                    })

            }
        }
    }
</script>

<style scoped>

</style>
