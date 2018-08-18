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
  import TheLogo from "@/components/header/top-bar/TheLogo";
  import TheWishList from "@/components/header/top-bar/TheWishList";
  import TheCart from "@/components/header/top-bar/TheCart";
  import TheSearchBox from "@/components/header/top-bar/TheSearchBox";

    export default {
        name: "TheMiddleContainer",

      components: {TheSearchBox, TheCart, TheWishList, TheLogo}
    }
</script>
