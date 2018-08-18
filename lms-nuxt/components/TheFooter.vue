<template>
  <footer id="tg-footer" class="tg-footer tg-haslayout">
    <the-footer-area/>
    <the-news-letter/>
    <the-footer-bar/>
  </footer>
</template>

<script>
    import TheFooterArea from "@/components/footer/TheFooterArea";
    import TheNewsLetter from "@/components/footer/TheNewsLetter";
    import TheFooterBar from "@/components/footer/TheFooterBar";
    export default {
        name: "TheFooter",
      components: {TheFooterBar, TheNewsLetter, TheFooterArea}
    }
</script>

<style scoped>

</style>
