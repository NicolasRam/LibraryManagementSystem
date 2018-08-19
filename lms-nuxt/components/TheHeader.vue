<template>
    <div id="tg-header" class="tg-header tg-haslayout">
        <the-top-bar/>
        <the-middle-container/>
        <the-navigation-area :categories="categories"/>
    </div>
</template>

<script>
    import TheTopBar from "@/components/header/TheTopBar";
    import TheMiddleContainer from "@/components/header/TheMiddleContainer";
    import TheNavigationArea from "@/components/header/TheNavigationArea";

    export default {
        name: "TheHeader",

        components: {TheNavigationArea, TheMiddleContainer, TheTopBar},

        props: {
            categories: {
                type: Array,
                default: []
            },
        }
    }
</script>

<style scoped>

</style>
