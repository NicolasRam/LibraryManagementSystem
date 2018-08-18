<template>
  <div>
    <the-slide-item-background/>
    <the-slide-item-tile/>
    <the-slide-item-sub-title/>
    <the-slide-item-description/>
    <the-slide-item-buttons/>
  </div>
</template>

<script>
    import TheSlideItemBackground from "@/components/slider/slide/TheSlideItemBackground";
    import TheSlideItemTile from "@/components/slider/slide/TheSlideItemTile";
    import TheSlideItemSubTitle from "@/components/slider/slide/TheSlideItemSubTitle";
    import TheSlideItemDescription from "@/components/slider/slide/TheSlideItemDescription";
    import TheSlideItemButtons from "@/components/slider/slide/TheSlideItemButtons";
    export default {
        name: "TheSlideItem",
      components: {
        TheSlideItemButtons,
        TheSlideItemDescription, TheSlideItemSubTitle, TheSlideItemTile, TheSlideItemBackground}
    }
</script>

<style scoped>

</style>
