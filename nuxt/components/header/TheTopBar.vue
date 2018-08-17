<template>
  <div class="tg-middlecontainer">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <the-logo/>

          <div class="tg-wishlistandcart">
            <the-wish-list/>
            <the-cart/>
          </div>

          <the-search-box/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import TheLogo from "./top-bar/TheLogo";
    import TheWishList from "./top-bar/TheWishList";
    import TheCart from "./top-bar/TheCart";
    import TheSearchBox from "./top-bar/TheSearchBox";
    export default {
        name: "TheTopBar",
      components: {TheSearchBox, TheCart, TheWishList, TheLogo}
    }
</script>

<style scoped>

</style>
