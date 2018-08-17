<template>
  <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
    <ul>
      <the-navigation-all-categories/>
      <the-navigation-item/>
      <the-navigation-items/>
    </ul>
  </div>
</template>

<script>
    import TheNavigationAllCategories from "./navigation/TheNavigationAllCategories";
    import TheNavigationItem from "./navigation/TheNavigationItem";
    import TheNavigationItems from "./navigation/TheNavigationItems";
    export default {
        name: "TheNavigation",
      components: {TheNavigationItems, TheNavigationItem, TheNavigationAllCategories}
    }
</script>

<style scoped>

</style>
