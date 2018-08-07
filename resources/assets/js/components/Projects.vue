<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Projects</h1>
            </div>
        </div>

        <div class="row pt-5" v-if="!isProjects">
            <div class="col-sm-12 text-center">
                <h2>We don't have any projects to show You now</h2>
            </div>
        </div>

        <div class="row pt-5" v-if="isProjects">
            <carousel class="col-sm-12" v-bind:perPage="this.$store.state.carousel.perPage">
                <slide v-for="project in data.data" :key="project.id">
                    <b-card @title="project.title"
                            v-bind:img-src="project.image"
                            img-alt="Project Image"
                            img-top>
                        <p class="card-text" v-text="project.description"></p>
                        <b-link v-bind:href="project.link" target="_blank">Take A Look</b-link>
                    </b-card>
                </slide>
            </carousel>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                data: {
                    data: []
                }
            }
        },
        name: "Projects",
        metaInfo: {
            title: 'Projects'
        },
        methods: {
            getProjects() {

            }
        },
        computed: {
            isProjects() {
                return this.data.data.length;
            },
            carouselPerPage() {
                return this.$store.state.carousel.perPage;
            }
        }
    }
</script>

<style scoped>

</style>
