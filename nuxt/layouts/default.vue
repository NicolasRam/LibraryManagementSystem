<template>
  <div>
    <the-header/>
    <the-slider/>
    <nuxt/>
    <the-footer/>
  </div>
</template>
<script>
  import TheHeader from "../components/TheHeader";
  import TheSlider from "../components/TheSlider";
  import TheFooter from "../components/TheFooter";
  export default {
    components: {TheFooter, TheSlider, TheHeader}
  }
</script>
