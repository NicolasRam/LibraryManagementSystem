<template>
  <main id="tg-main" class="tg-main tg-haslayout">
    <all-status :booksCount="loadedBooksCount"/>
    <best-selling/>
    <featured-item/>
    <new-release/>
    <collection-count/>
    <picked-by-authors/>
    <testimonials/>
    <authors/>
    <call-to-action/>
    <latest-news/>
  </main>
</template>

<script>
  import AllStatus from "../components/modules/AllStatus";
  import BestSelling from "../components/modules/BestSelling";
  import FeaturedItem from "../components/modules/FeaturedItem";
  import NewRelease from "../components/modules/NewRelease";
  import CollectionCount from "../components/modules/CollectionCount";
  import PickedByAuthors from "../components/modules/PickedByAuthors";
  import Testimonials from "../components/modules/Testimonials";
  import Authors from "../components/modules/Authors";
  import CallToAction from "../components/modules/CallToAction";
  import LatestNews from "../components/modules/LatestNews";

  export default {
    components: {
      LatestNews,
      CallToAction,
      Authors,
      Testimonials,
      PickedByAuthors,
      CollectionCount,
      NewRelease,
      FeaturedItem,
      BestSelling,
      AllStatus
    },
    computed: {
      loadedBooksCount() {
        return this.$store.getters.loadedBooksCount
      }
    }
  }
</script>
