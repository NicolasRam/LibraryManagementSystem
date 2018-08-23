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

    <div class="tg-authorsgrid">
      <div class="container">
        <div class="row">
          <div class="tg-authors">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
              <div class="tg-sectionhead">
                <h2><span>Les auteurs les plus ppopulaire</span>Auteurs</h2>
              </div>
            </div>

            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2" v-for="(author, index) in loadedMostPopularAuthors">
              <div class="tg-author">
                <figure>
                  <a href="javascript:void(0);">
                    <img :src="'http://exprostudio.com/html/book_library/images/author/imag-0' + getRandomInt(1, 9) + '.jpg'" alt="image description">
                  </a>
                </figure>

                <div class="tg-authorcontent">
                  <h2><a href="javascript:void(0);">{{author.firstName + ' ' + author.lastName}}</a></h2>

                  <span>{{author.books.length}} Livres publié</span>

                  <ul class="tg-socialicons">
                    <li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                    <li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                    <li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                  </ul>
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
                return index < 9 ? index : this.getRandomInt(1,26);
            }
        }

    }
</script>
