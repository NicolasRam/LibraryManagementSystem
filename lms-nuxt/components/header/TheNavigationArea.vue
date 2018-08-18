<template>
  <div class="tg-navigationarea">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <nav id="tg-nav" class="tg-nav">
            <the-navigation-header/>

            <the-navigation/>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import TheNavigationHeader from "@/components/header/the-navigation-area/TheNavigationHeader";
    import TheNavigation from "@/components/header/the-navigation-area/TheNavigation";
    export default {
        name: "TheNavigationArea",
      components: {TheNavigation, TheNavigationHeader}
    }
</script>

<style scoped>

</style>
