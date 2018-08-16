<template>
  <div>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div id="tg-wrapper" class="tg-wrapper tg-haslayout">
      <TheHeader />

      <TheHomeSlider />

      <TheMain/>

      <TheFooter/>
    </div>
  </div>
</template>

<script>
  import TheHeader from '@/components/TheHeader.vue'
  import TheHomeSlider from '@/components/TheHomeSlider.vue'
  import TheMain from '@/components/TheMain.vue'
  import TheFooter from '@/components/TheFooter.vue'

  export default {
    // middleware: 'log',
    components: {
      TheHeader,
      TheHomeSlider,
      TheMain,
      TheFooter,
    },
    data() {
      return {
        // displaySidenav: false
      }
    }
  }
</script>
