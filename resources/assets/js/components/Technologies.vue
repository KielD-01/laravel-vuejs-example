<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Technologies</h1>
            </div>
        </div>

        <div class="row pt-5">

            <div class="col-sm-12 col-md-6 text-center">
                <h2>Known Programming Languages</h2>

                <div class="row languages-block">
                    <div class="col-md-4 pt-2 pb-2 tech-item" v-for="language in languages">
                        <b-img v-bind:src="language.image" blank-color="#fff" width="100" height="100"
                               v-bind:title="language.title"
                               class="m-1"></b-img>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-md-6 text-center">
                <h2>Known Frameworks</h2>

                <div class="row frameworks-block">
                    <div class="col-md-4 pt-2 pb-2 tech-item" v-for="framework in frameworks">
                        <b-img v-bind:src="framework.image" blank-color="#fff" width="100" height="100"
                               v-bind:title="framework.title"
                               class="m-1"></b-img>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-md-6 text-center pt-5">
                <h2>Known Tools</h2>

                <div class="row tools-block">
                    <div class="col-md-4 pt-2 pb-2 tech-item" v-for="tool in tools">
                        <b-img v-bind:src="tool.image" blank-color="#fff" width="100" height="100"
                               v-bind:title="tool.title"
                               class="m-1"></b-img>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-md-6 text-center pt-5">
                <h2>Known IDEs</h2>

                <div class="row ides-block">
                    <div class="col-md-4 pt-2 pb-2 tech-item" v-for="ide in ides">
                        <b-img v-bind:src="ide.image" blank-color="#fff" width="100" height="100"
                               v-bind:title="ide.title"
                               class="m-1"></b-img>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Technologies",
        metaInfo: {
            title: 'Which technologies do I use?'
        },
        data() {
            return {
                languages: [
                    {title: 'PHP', image: '/images/languages/php.png'},
                    {title: 'JavaScript', image: '/images/languages/js.png'},
                    {title: 'Java', image: '/images/languages/java.png'},
                    {title: 'Scala', image: '/images/languages/scala.png'},
                    {title: 'Visual Basic', image: '/images/languages/vb.png'},
                    {title: 'Python 3', image: '/images/languages/python3.png'},
                    {title: 'Java for Android', image: '/images/languages/android.png'},
                ],
                frameworks: [
                    {title: 'CakePHP 3.x', image: '/images/frameworks/cake.png'},
                    {title: 'Laravel 5.x', image: '/images/frameworks/laravel.png'},
                    {title: 'CodeIgniter 3', image: '/images/frameworks/ci.png'},
                    {title: 'Slim 3', image: '/images/frameworks/slim.png'},
                    {title: 'Lumen', image: '/images/frameworks/lumen.png'},
                    {title: 'Angular 1 / 2 / 4', image: '/images/frameworks/ng.png'},
                    {title: 'Ionic 1 / 2', image: '/images/frameworks/ionic.png'},
                    {title: 'Nativescript', image: '/images/frameworks/ns.png'},
                    {title: 'NodeJS', image: '/images/frameworks/node.png'}
                ],
                tools: [
                    {title: 'Git', image: '/images/tools/git.png'},
                    {title: 'AWS', image: '/images/tools/aws.png'},
                    {title: 'Digital Ocean', image: '/images/tools/do.png'},
                    {title: 'Forge Laravel', image: '/images/tools/forge.png'}
                ],
                ides: [
                    {title: 'PHPStorm', image: '/images/ides/php.png'},
                    {title: 'WebStorm', image: '/images/ides/web.png'},
                    {title: 'RubyMine', image: '/images/ides/rm.png'}
                ]
            }
        }
    }
</script>

<style scoped>

</style>
