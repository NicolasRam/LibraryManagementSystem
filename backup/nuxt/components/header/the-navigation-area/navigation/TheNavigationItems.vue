<template>
  <li class="menu-item-has-children current-menu-item">
    <a href="javascript:void(0);"><i class="icon-menu"></i></a>
    <ul class="sub-menu">
      <li class="menu-item-has-children">
        <a href="aboutus.html">Products</a>
        <ul class="sub-menu">
          <li><a href="products.html">Products</a></li>
          <li><a href="productdetail.html">Product Detail</a></li>
        </ul>
      </li>
      <li><a href="aboutus.html">About Us</a></li>
      <li><a href="404error.html">404 Error</a></li>
      <li><a href="comingsoon.html">Coming Soon</a></li>
    </ul>
  </li>

</template>

<script>
    export default {
        name: "TheNavigationItems"
    }
</script>

<style scoped>

</style>
