<template>
    <div id="tg-homeslider" class="tg-homeslider tg-haslayout owl-carousel">
      <the-slide/>
      <the-slide/>
      <the-slide/>
    </div>
</template>

<script>
    import TheSlide from "@/components/slider/TheSlide";

    export default {
      name: "TheSlider",

      components: {TheSlide},
    }
</script>
