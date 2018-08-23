<template>
  <main id="tg-main" class="tg-main tg-haslayout">
    <div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="http://exprostudio.com/html/book_library/images/parallax/bgparallax-07.jpg">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-innerbannercontent">
              <h1>Auteurs</h1>
              <ol class="tg-breadcrumb">
                <li><nuxt-link to="/">Accueil</nuxt-link></li>
                <li class="tg-active">Auteurs</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="tg-sectionspace tg-haslayout">
      <div class="container">
        <div class="row">
          <div id="tg-twocolumns" class="tg-twocolumns">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div id="tg-content" class="tg-content">
                <div class="tg-products">
                  <div class="tg-sectionhead">
                    <h2><span>People’s Choice</span>Bestselling Books</h2>
                  </div>

                  <div class="tg-featurebook alert" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="tg-featureditm">
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-sm hidden-xs">
                          <figure><img src="images/img-04.png" alt="image description"></figure>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                          <div class="tg-featureditmcontent">
                            <div class="tg-themetagbox"><span class="tg-themetag">featured</span></div>
                            <div class="tg-booktitle">
                              <h3><a href="javascript:void(0);">Things To Know About Green Flat Design</a></h3>
                            </div>
                            <span class="tg-bookwriter">By: <a href="javascript:void(0);">Farrah Whisenhunt</a></span>
                            <span class="tg-stars"><span></span></span>
                            <div class="tg-priceandbtn">
                                <span class="tg-bookprice">
                                    <ins>$23.18</ins>
                                    <del>$30.20</del>
                                </span>
                              <a class="tg-btn tg-btnstyletwo tg-active" href="javascript:void(0);">
                                <i class="fa fa-shopping-basket"></i>
                                <em>Add To Basket</em>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tg-productgrid">
                    <div class="tg-refinesearch">
                      <span>1 à 8 su 20 au total</span>
                      <form class="tg-formtheme tg-formsortshoitems">
                        <fieldset>
                          <div class="form-group">
                            <label>sort by:</label>
                            <span class="tg-select">
																<select>
																	<option>name</option>
																	<option>name</option>
																	<option>name</option>
																</select>
															</span>
                          </div>
                          <div class="form-group">
                            <label>show:</label>
                            <span class="tg-select">
																<select>
																	<option>8</option>
																	<option>16</option>
																	<option>20</option>
																</select>
															</span>
                          </div>
                        </fieldset>
                      </form>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3" v-for="(book, index) in loadedBooks" :key="index">
                      <div class="tg-postbook" v-if="book">
                        <figure class="tg-featureimg">
                          <div class="tg-bookimg" v-if="book.hasOwnProperty('image') && book.image.hasOwnProperty('path')">
                            <div class="tg-frontcover"><img :src="book.image.path" alt="image description"></div>

                            <div class="tg-backcover"><img :src="book.image.path" alt="image description"></div>
                          </div>

                          <a class="tg-btnaddtowishlist" href="javascript:void(0);">
                            <i class="icon-heart"></i>
                            <span>ajouter à ma liste</span>
                          </a>
                        </figure>

                        <div class="tg-postbookcontent">
                          <ul class="tg-bookscategories" v-if="book.hasOwnProperty('subCategory') && book.subCategory.hasOwnProperty('name')">
                            <li><nuxt-link to="javascript:void(0);">{{book.subCategory.name}}</nuxt-link></li>
                          </ul>

                          <div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>

                          <div class="tg-booktitle">
                            <h3><nuxt-link :to="'/book/' + book.id ">{{book.title}}</nuxt-link></h3>
                          </div>

                          <span class="tg-bookwriter" v-if="book.hasOwnProperty('author') && book.author.hasOwnProperty('firstName') && book.author.hasOwnProperty('lastName')">
                            Par: <nuxt-link to="/author"> {{book.author.firstName + ' ' + book.author.lastName}}</nuxt-link>
                          </span>

                          <span class="tg-stars"><span></span></span>

                          <span class="tg-bookprice">
                              <ins>$25.18</ins>
                              <del>$27.20</del>
                          </span>
                          <a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
                            <i class="fa fa-shopping-basket"></i>
                            <em>Add To Basket</em>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
    export default {
        layout: "page",

        components: {
        },


        computed: {
            loadedBooks() {
                return this.$store.getters.loadedBooks
            },
            loadedCategories() {
                return this.$store.getters.loadedCategories
            },
            loadedBooksCount() {
                return this.$store.getters.loadedBooksCount
            },

            loadedMembersCount() {
                return this.$store.getters.loadedMembersCount
            },

            loadedLibrariesCount() {
                return this.$store.getters.loadedLibrariesCount
            },

            loadedBestSellingBooks() {
                return this.$store.getters.loadedBestSellingBooks
            },

            loadedFeaturedBook() {
                return this.$store.getters.loadedFeaturedBook
            },

            loadedNewReleaseBooks() {
                return this.$store.getters.loadedNewReleaseBooks
            },

            loadedCollectionCounts() {
                return this.$store.getters.loadedCollectionCounts
            },

            loadedPickedByAuthorBooks() {
                return this.$store.getters.loadedPickedByAuthorBooks
            },

            loadedTestimonials() {
                return this.$store.getters.loadedTestimonials
            },

            loadedMostPopularAuthors() {
                return this.$store.getters.loadedMostPopularAuthors
            },

            loadedCallToAction() {
                return this.$store.getters.loadedCallToAction
            },

            loadedLatestPosts() {
                return this.$store.getters.loadedLatestPosts
            },

            loadedBestSellingAuthors() {
                return this.$store.getters.loadedBestSellingAuthors
            },
        },


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
