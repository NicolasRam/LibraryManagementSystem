<template>
    <div class="tg-home tg-homeone">
        <div id="tg-wrapper" class="tg-wrapper tg-haslayout">
            <the-header :categories="loadedCategories"/>
            <the-slider/>
            <nuxt/>
            <the-footer/>
        </div>
    </div>
</template>
<script>
    import TheHeader from "../components/TheHeader";
    import TheSlider from "../components/TheSlider";
    import TheFooter from "../components/TheFooter";

    export default {
        components: {
            TheFooter,
            TheSlider,
            TheHeader
        },

        computed: {
            loadedCategories() {
                return this.$store.getters.loadedCategories
            },
        }
    }
</script>
