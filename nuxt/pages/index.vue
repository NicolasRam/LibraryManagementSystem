<template>
  <div>
    <TheAllStatus/>

    <TheBestSelling/>

    <TheFeaturedItem/>

    <TheNewRelease/>

    <TheCollectionCount/>

    <ThePickedByAuthor/>

    <TheTestimonials/>

    <TheAuthors/>

    <TheCallToAction/>

    <TheLastestNews/>
  </div>
</template>


<script>
  import TheAllStatus from '@/components/TheAllStatus.vue'
  import TheBestSelling from '@/components/TheBestSelling.vue'
  import TheFeaturedItem from '@/components/TheFeaturedItem.vue'
  import TheNewRelease from '@/components/TheNewRelease.vue'
  import TheCollectionCount from '@/components/TheCollectionCount.vue'
  import ThePickedByAuthor from '@/components/ThePickedByAuthor.vue'
  import TheTestimonials from '@/components/TheTestimonials.vue'
  import TheAuthors from '@/components/TheAuthors.vue'
  import TheCallToAction from '@/components/TheCallToAction.vue'
  import TheLastestNews from '@/components/TheLastestNews.vue'

  export default {
    // middleware: 'log',
    components: {
      TheAllStatus,
      TheBestSelling,
      TheFeaturedItem,
      TheNewRelease,
      TheCollectionCount,
      ThePickedByAuthor,
      TheTestimonials,
      TheAuthors,
      TheCallToAction,
      TheLastestNews,
    },
    data() {
      return {
        // displaySidenav: false
      }
    }
  }
</script>
