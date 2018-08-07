<template>
    <div class="container-fluid">
        <BlockUI :message="this.$store.state.blockUI.message" :html="this.$store.state.blockUI.html"
                 v-show="this.$store.state.blockUI.visible"></BlockUI>
        <p-header></p-header>

        <div class="content-center pt-4 pb-4">
            <transition name="page" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>

        <p-footer></p-footer>
    </div>
</template>

<script>
    export default {
        metaInfo: {
            titleTemplate: 'Roman Kozin Portfolio | %s',
            meta: [
                {name: 'lang', content: 'en'}
            ]
        }
    }
</script>
