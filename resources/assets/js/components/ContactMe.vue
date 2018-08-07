<template>
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <h1>Contact Me</h1>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-sm-12 col-md-5">
                <b-form @submit="submitContact" @reset="clearContactForm">
                    <b-form-group>
                        <b-form-input type="text" placeholder="Full Name, ex. John Doe" v-model="contact.fullName"
                                      name="full_name"
                                      v-validate="{required: true, regex: /([a-zA-Z])/}"></b-form-input>
                        <span class="text-danger" v-show="errors.has('full_name')"
                              v-text="errors.first('full_name')"></span>
                    </b-form-group>
                    <b-form-group>
                        <b-form-input type="email" placeholder="Email, ex. john.doe@gmail.com" v-model="contact.email"
                                      name="email"
                                      v-validate="{required: true, email:true}"></b-form-input>
                        <span class="text-danger" v-show="errors.has('email')" v-text="errors.first('email')"></span>
                    </b-form-group>
                    <b-form-group>
                        <b-form-textarea placeholder="Message" v-model="contact.message" name="message" :rows="5"
                                         v-validate="{required: true, regex: /(.+?)/}"></b-form-textarea>
                        <span class="text-danger" v-show="errors.has('message')"
                              v-text="errors.first('message')"></span>
                    </b-form-group>

                    <b-form-group>
                        <vue-recaptcha ref="recaptcha" :sitekey="this.$store.state.recaptcha.siteKey"
                                       @verify="onCaptchaVerify"></vue-recaptcha>
                    </b-form-group>

                    <b-form-group>
                        <transition name="fade">
                            <b-button type="submit" v-show="errors.items.length !== 0 || contact.captcha.length > 0"
                                      variant="primary">Submit
                            </b-button>
                        </transition>
                    </b-form-group>

                </b-form>
            </div>
            <div class="col-md-7">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d642.9962355293322!2d24.0466019!3d49.8615275!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473add05778d5ad9%3A0x27b9c2b367f8d96e!2sIT+Prosteer!5e0!3m2!1suk!2sua!4v1533286705281"
                    width="600" height="320" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</template>

<script>
    import VueRecaptcha from 'vue-recaptcha';

    export default {
        components: {VueRecaptcha},
        data() {
            return {
                contact: {
                    fullName: '',
                    email: '',
                    message: '',
                    captcha: ''
                }
            }
        },
        name: "ContactMe",
        metaInfo: {
            title: 'Contact Me'
        },
        methods: {
            submitContact(event) {
                event.preventDefault();

                this.$validator.validateAll().then((result) => {
                    if (result) {

                        this.$store.state.blockUI.makeVisible();
                        this.$store.state.blockUI.setMessage('Sending Form');

                        this.axios.post('/api/contact', this.contact)
                            .then(success => {

                                this.$store.state.blockUI.setDefaults();
                                this.$refs.recaptcha.reset();
                                this.resetContacts();

                                this
                                    .$swal({
                                        type: 'success',
                                        title: 'Feedback has been sent!',
                                        text: 'Thank You for taking Your time to leave a feedback',
                                        showCancelButton: false,
                                        showConfirmButton: true
                                    })
                                    .then(() => {
                                        return this.$router.push({name: 'home'});
                                    })

                            }, fail => {
                                this.$store.state.blockUI.setDefaults();
                            });

                        return;
                    }
                });

            },
            clearContactForm() {
            },
            onCaptchaVerify(response) {
                this.contact.captcha = response;
            },
            resetContacts() {
                this.contact = {
                    fullName: '',
                    email: '',
                    message: '',
                    captcha: ''
                };
            }
        }
    }
</script>

<style scoped>

</style>
