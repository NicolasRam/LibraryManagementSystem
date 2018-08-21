<template>
  <section class="tg-sectionspace tg-haslayout">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="tg-sectionhead">
            <h2><span>Choix des membres</span>Meilleur ventes</h2>

            <a class="tg-btn" href="javascript:void(0);">Voir tout</a>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div id="tg-bestsellingbooksslider"
               class="tg-bestsellingbooksslider tg-bestsellingbooks owl-carousel">
            <div class="item" v-for="(book, index) in bestSellingBooks" :key="index">
              <div class="tg-postbook">
                <figure class="tg-featureimg">
                  <div class="tg-bookimg">
                    <div class="tg-frontcover">
                      <img :src="book.image.path" :alt="book.image.path">
                    </div>
                    <div class="tg-backcover"><img :src="book.image.path"
                                                   alt="image description"></div>
                  </div>

                  <a class="tg-btnaddtowishlist" href="javascript:void(0);">
                    <i class="icon-heart"></i>
                    <span>ajouter à la liste de souhait</span>
                  </a>
                </figure>

                <div class="tg-postbookcontent">
                  <ul class="tg-bookscategories">
                    <li><a href="javascript:void(0);">{{book.subCategory.name}}</a></li>
                  </ul>

                  <div class="tg-themetagbox" v-if="book.sale"><span class="tg-themetag">Sold</span></div>

                  <div class="tg-booktitle">
                    <h3><a href="javascript:void(0);">{{book.title}}</a></h3>
                  </div>

                  <span class="tg-bookwriter">Par: <a href="javascript:void(0);">{{ book.author.lastName }}</a></span>

                  <span class="tg-stars" v-if="false"><span></span></span>

                  <span class="tg-bookprice">
                      <ins v-if="book.hasOwnProperty('price')">{{book.price}}</ins>
                      <del v-if="book.hasOwnProperty('salePrice') && book.salePrice">{{book.price}}</del>
                  </span>

                  <a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
                    <i class="fa fa-shopping-basket"></i>
                    <em>Panier</em>
                  </a>
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
    name: 'BestSelling',

    props: {
      bestSellingBooks: {
        type: Array,
        default: []
      },
    }
  }
</script>
