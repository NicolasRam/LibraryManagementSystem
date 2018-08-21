<template>
  <section class="tg-parallax tg-bgcalltoaction tg-haslayout" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="http://exprostudio.com/html/book_library/images/parallax/bgparallax-06.jpg">
    <div class="tg-sectionspace tg-haslayout">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-calltoaction">
              <h2>{{callToAction.title}}</h2>

              <h3>{{callToAction.content}}</h3>

              <a class="tg-btn tg-active" href="javascript:void(0);">Lire la suite</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  export default {
    name: 'CallToAction',

    props: {
      callToAction: {
        type: Array,
        default: []
      },
    }
  }
</script>
