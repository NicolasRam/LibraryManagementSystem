<template>
  <main id="tg-main" class="tg-main tg-haslayout">
    <all-status/>
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
import {mapGetters} from 'vuex'

import RwvTag from '@//components/VTag'

import AllStatus from '@//modules/AllStatus'
import BestSelling from '@//modules/BestSelling'
import FeaturedItem from '@//modules/FeaturedItem'
import NewRelease from '@//modules/NewRelease'
import CollectionCount from '@//modules/CollectionCount'
import PickedByAuthors from '@//modules/PickedByAuthors'
import Testimonials from '@//modules/Testimonials'
import Authors from '@//modules/Authors'
import CallToAction from '@//modules/CallToAction'
import LatestNews from '@//modules/LatestNews'

import {FETCH_TAGS} from '@/store/actions.type'

export default {
  name: 'home',
  components: {
    AllStatus,
    BestSelling,
    FeaturedItem,
    NewRelease,
    CollectionCount,
    PickedByAuthors,
    Testimonials,
    Authors,
    CallToAction,
    LatestNews,
    RwvTag
  },
  mounted () {
    this.$store.dispatch(FETCH_TAGS)
  },
  computed: {
    ...mapGetters([
      'isAuthenticated',
      'tags'
    ]),
    tag () {
      return this.$route.params.tag
    }
  }
}
</script>
