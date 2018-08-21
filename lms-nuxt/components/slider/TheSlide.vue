<template>
  <div class="item" data-vide-bg="poster: http://exprostudio.com/html/book_library/images/slider/img-01.jpg" data-vide-options="position: 0% 50%">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">
          <div class="tg-slidercontent">
            <the-slide-item/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import TheSlideItem from "@/components/slider/slide/TheSlideItem";

    export default {
        name: "TheSlide",
        components: {TheSlideItem},
    }
</script>

<style scoped>

</style>
