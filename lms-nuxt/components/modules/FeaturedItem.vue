<template>
  <section class="tg-bglight tg-haslayout">
    <div class="container">
      <div class="row">
        <div class="tg-featureditm">
          <div
            class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-sm hidden-xs"
            v-if="bestFeaturedBook.hasOwnProperty('image') && bestFeaturedBook.image.hasOwnProperty('path')"
          >
            <figure><img :src="bestFeaturedBook.image.path" alt="image description"></figure>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="tg-featureditmcontent">
              <div class="tg-themetagbox"><span class="tg-themetag">à la une</span></div>

              <div class="tg-booktitle">
                <h3><a href="javascript:void(0);">{{bestFeaturedBook.title}}</a></h3>
              </div>

              <span class="tg-bookwriter"
                    v-if="bestFeaturedBook.hasOwnProperty('author') && bestFeaturedBook.author.hasOwnProperty('firstName') && bestFeaturedBook.author.hasOwnProperty('lastName')"
              >
                Par: <a href="javascript:void(0);">{{bestFeaturedBook.author.firstName + ' ' + bestFeaturedBook.author.lastName}}</a></span>

              <span class="tg-stars"><span></span></span>

              <div class="tg-priceandbtn">
                <span class="tg-bookprice">
                    <ins v-if="bestFeaturedBook.hasOwnProperty('salePrice')">{{bestFeaturedBook.salePrice}}</ins>

                    <del v-if="bestFeaturedBook.hasOwnProperty('price')">{{bestFeaturedBook.price}}</del>
                </span>

                <a class="tg-btn tg-btnstyletwo tg-active" href="javascript:void(0);">
                  <i class="fa fa-shopping-basket"></i>
                  <em>Ajouter au panier</em>
                </a>
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
    name: 'FeaturedItem',

    props: {
      bestFeaturedBook: {
        type: Object,
        default: []
      },
    }
  }
</script>
