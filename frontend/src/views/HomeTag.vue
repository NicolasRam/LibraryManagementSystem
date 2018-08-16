<template>
  <div class="home-tag">
    <RwvBookList :tag="tag"></RwvBookList>
  </div>
</template>
<script>
  import RwvBookList from '@/components/BookList'

  export default {
    name: 'RwvHomeTag',
    components: {
      RwvBookList
    },
    computed: {
      tag () {
        return this.$route.params.tag
      }
    }
  }
</script>
