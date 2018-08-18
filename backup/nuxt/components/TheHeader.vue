<template>
    <div id="tg-header" class="tg-header tg-haslayout">
      <the-top-bar/>
      <the-middle-container/>
      <the-navigation-area/>
    </div>
</template>

<script>
    import TheTopBar from "./header/TheTopBar";
    import TheMiddleContainer from "./header/TheMiddleContainer";
    import TheNavigationArea from "./header/TheNavigationArea";
    export default {
        name: "TheHeader",
      components: {TheNavigationArea, TheMiddleContainer, TheTopBar}
    }
</script>

<style scoped>

</style>
