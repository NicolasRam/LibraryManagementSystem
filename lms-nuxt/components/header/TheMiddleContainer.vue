<template>
  <div class="tg-middlecontainer">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <the-logo/>

          <div class="tg-wishlistandcart" v-if="member !== null">
            <the-wish-list/>
            <the-cart/>
          </div>

          <div class="tg-wishlistandcart" v-else>
            <the-login/>
            <the-subscription/>
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
  import TheLogin from "./top-bar/TheLogin";
  import TheSubscription from "./top-bar/TheSubscription";

    export default {
        name: "TheMiddleContainer",

      components: {TheSubscription, TheLogin, TheSearchBox, TheCart, TheWishList, TheLogo},

      props: {
        member: {
          type: Object,
          default: null
        },
      },
    }
</script>
