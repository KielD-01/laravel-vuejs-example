<template>
    <div class="row">
        <div class="col-sm-12">
            <BlockUI :message="this.$store.state.blockUI.message" :html="this.$store.state.blockUI.html"
                     v-show="this.$store.state.blockUI.visible"></BlockUI>

            <b-button class="mb-4" variant="outline" @click="showAdminTour"><i class="fa fa-question-circle-o"></i> Help
            </b-button>

            <vue2-sidebar heading="Portfolio Admin" :links="sidebar.links" :header-links="sidebar.header"
                          class="admin-sidebar">
                <router-view></router-view>
            </vue2-sidebar>
        </div>

        <v-tour name="adminPanel" :steps="tours.adminPanel"></v-tour>

    </div>
</template>

<script>
    export default {
        name: "Layout",
        methods: {
            showAdminTour() {
                this.tour = 'adminPanel';
                this.steps = this.tours.adminPanel;
                this.$tours['adminPanel'].start();
            }
        },
        data() {
            return {
                sidebar: {
                    links: [
                        {label: 'Dashboard', to: {name: 'admin.dashboard'}, icon: 'fa-dashboard',},
                        {label: 'Users', to: {name: 'admin.users'}, icon: 'fa-users'},
                        {label: 'Projects', to: {name: 'admin.projects'}, icon: 'fa-tasks'},
                        {label: 'Articles', to: {name: 'admin.articles'}, icon: 'fa-newspaper-o'},
                        {label: 'Technologies', to: {name: 'admin.tech'}, icon: 'fa-wrench'},
                        {label: 'Feedback List', to: {name: 'admin.feedback'}, icon: 'fa-envelope-o'},
                    ],
                    header: []
                },
                tour: '',
                steps: [],
                tours: {
                    adminPanel: [
                        {
                            target: 'div.wrapper.admin-sidebar',
                            content: 'This is the Admin Panel',
                            params: {
                                placement: 'bottom'
                            }
                        },
                        {
                            target: 'div.wrapper.admin-sidebar ul li:nth-child(1)',
                            content: 'This is a link to the Dashboard, where the statistic is'
                        },
                        {
                            target: 'div.wrapper.admin-sidebar ul li:nth-child(2)',
                            content: 'This is a link to the Users list, where You can do CRUD on a users'
                        },
                        {
                            target: 'div.wrapper.admin-sidebar ul li:nth-child(3)',
                            content: 'This is a link to the Projects list'
                        },
                        {
                            target: 'div.wrapper.admin-sidebar ul li:nth-child(4)',
                            content: 'This is a link to the Articles list'
                        },
                        {
                            target: 'div.wrapper.admin-sidebar ul li:nth-child(5)',
                            content: 'This is a link to the Technologies Stack'
                        },
                        {
                            target: 'div.wrapper.admin-sidebar ul li:nth-child(6)',
                            content: 'This is a link to the Feedback List'
                        },
                    ]
                }
            }
        }
    }
</script>

<style scoped>

</style>
