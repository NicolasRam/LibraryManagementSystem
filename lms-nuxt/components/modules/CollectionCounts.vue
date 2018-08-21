<template>
  <section class="tg-parallax tg-bgcollectioncount tg-haslayout" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="http://exprostudio.com/html/book_library/images/parallax/bgparallax-04.jpg">
    <div class="tg-sectionspace tg-collectioncount tg-haslayout">
      <div class="container">
        <div class="row">
          <div id="tg-collectioncounters" class="tg-collectioncounters">
            <div :class="'tg-collectioncounter' + ' ' + colors[index]" v-for="(collection, index) in collectionCounts" :key="index">
              <div class="tg-collectioncountericon">
                <i :class="icons[index]"></i>
              </div>

              <br/>
              <br/>

              <div class="tg-titlepluscounter">
                <center>
                  <h2>{{collection.name}}</h2>
                  <h3 data-from="0" :data-to="collection.count" data-speed="8000" data-refresh-interval="50">{{collection.count}}</h3>
                </center>
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
    name: 'CollectionCount',

    data () {
      return {
        icons: [ "icon-bubble", "icon-heart-pulse", "icon-heart", "icon-star" ],
        colors: [ "tg-drama", "tg-horror", "tg-romance", "tg-fashion" ],
      }
    },

    props: {
      collectionCounts: {
        type: Array,
        default: []
      },
    },
  }
</script>
