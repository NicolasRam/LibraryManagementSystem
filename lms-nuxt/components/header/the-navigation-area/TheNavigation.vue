<template>
  <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
    <ul>
      <li>
        <nuxt-link to="/">Accueil</nuxt-link>
      </li>

      <the-navigation-all-categories :categories="categories"/>
      <!--<the-navigation-item/>-->
      <!--<the-navigation-items/>-->

      <li>
        <nuxt-link to="/books">Livres</nuxt-link>
      </li>
    </ul>
  </div>
</template>

<script>
  import TheNavigationAllCategories
    from "@/components/header/the-navigation-area/navigation/TheNavigationAllCategories";
  import TheNavigationItem from "@/components/header/the-navigation-area/navigation/TheNavigationItem";
  import TheNavigationItems from "@/components/header/the-navigation-area/navigation/TheNavigationItems";

  export default {
    name: "TheNavigation",

    components: {TheNavigationItems, TheNavigationItem, TheNavigationAllCategories},

    props: {
      categories: {
        type: Array,
        default: []
      },
    }
  }
</script>

<style scoped>

</style>
