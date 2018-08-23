<template>
  <figure class="tg-authorimg">
    <a href="javascript:void(0);">
      <img
        :src="'http://exprostudio.com/html/book_library/images/author/imag-0' + getRandomInt(1, 9) + '.jpg'"
        alt="image description">
    </a>
  </figure>
</template>

<script>
    export default {
      name: "TheSlideItemBackground",


      methods: {
        getRandomInt( min, max ){
          return Math.floor(Math.random() * (max - min + 1) + min);
        },
        getAuthorImageIndex(){
          return index < 9 ? index : this.getRandomInt(1,9);
        }
      }
    }
</script>

<style scoped>

</style>
