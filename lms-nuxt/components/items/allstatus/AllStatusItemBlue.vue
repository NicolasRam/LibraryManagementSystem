<template>
  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="tg-parallax tg-bgbookwehave" data-z-index="2" data-appear-top-offset="600" data-parallax="scroll" data-image-src="static/images/parallax/bgparallax-01.jpg">
      <div class="tg-status">
        <div class="tg-statuscontent">
          <span class="tg-statusicon"><i class="icon-book"></i></span>
          <h2>Nombre de Livres<span>{{booksCount}}</span></h2>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'AllStatusItemBlue',

    props: {
      booksCount: {
        type: Number,
        default: 0
      }
    }
  }
</script>
