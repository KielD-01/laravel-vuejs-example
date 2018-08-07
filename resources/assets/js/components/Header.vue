<template>
    <b-navbar toggleable="md" type="dark" variant="info">

        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

        <b-navbar-brand :to="{name: 'home'}">Portfolio</b-navbar-brand>

        <b-collapse is-nav id="nav_collapse">

            <b-navbar-nav>
                <b-nav-item :to="{name: 'projects'}">Projects</b-nav-item>
                <b-nav-item :to="{name: 'tech'}">Technologies</b-nav-item>
                <b-nav-item :to="{name: 'contact-me'}">Contact Me</b-nav-item>
            </b-navbar-nav>

            <b-navbar-nav class="ml-auto">
                <b-nav-item :to="{name: 'login'}" v-show="!isAuthorized">Login</b-nav-item>
                <b-nav-item v-show="isAuthorized" @click="logout">Logout</b-nav-item>
                <b-nav-item :to="{name: 'admin.dashboard'}"
                            v-show="isAuthorized && isAdmin">Admin
                </b-nav-item>
            </b-navbar-nav>

        </b-collapse>
    </b-navbar>
</template>

<script>
    export default {
        name: "Header",
        computed: {
            isAuthorized() {
                return this.$store.state.user !== null;
            },
            isAdmin() {
                return this.$store.state.user.role === 'su';
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout');

                const routeRegex = new RegExp(/(admin)/g);
                if (routeRegex.test(this.$router.currentRoute.name)) {
                    return this.$router.push({name: 'login'});
                }
            }
        }
    }
</script>

<style scoped>

</style>
