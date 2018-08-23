<template>
  <section class="tg-parallax tg-bgtestimonials tg-haslayout" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="http://exprostudio.com/html/book_library/images/parallax/bgparallax-05.jpg">
    <div class="tg-sectionspace tg-haslayout">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-push-2">
            <div id="tg-testimonialsslider" class="tg-testimonialsslider tg-testimonials owl-carousel">
              <div class="item tg-testimonial" v-for="(testimonial, index) in testimonials">
                <figure>
                  <img
                    :src="'http://exprostudio.com/html/book_library/images/author/imag-0' + getRandomInt(1,9) + '.jpg'"
                    alt="image description">
                </figure>

                <blockquote>
                  <q>{{testimonial.message}}</q>
                </blockquote>

                <div class="tg-testimonialauthor" v-if="testimonial.hasOwnProperty(member) && testimonial.member">
                  <h3 v-if="testimonial.member.hasOwnProperty('firstName') && testimonial.member.hasOwnProperty('lastName')">
                    {{testimonial.member.firstName + " " + testimonial.member.lastName}}
                  </h3>

                  <span v-if="false">Manager @ CIFP</span>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  export default {
    name: 'Testimonials',

    props: {
      testimonials: {
        type: Array,
        default: []
      },
    },


    methods: {
      getRandomInt( min, max ){
        return Math.floor(Math.random() * (max - min + 1) + min);
      },
    }
  }
</script>
