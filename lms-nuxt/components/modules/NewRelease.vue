<template>
  <section class="tg-sectionspace tg-haslayout">
    <div class="container">
      <div class="row">
        <div class="tg-newrelease">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="tg-sectionhead">
              <h2><span>Du nouveau dans nos librairies</span>Nouveaux livres</h2>
            </div>

            <div class="tg-description">
              <p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p>
            </div>

            <div class="tg-btns">
              <a class="tg-btn tg-active" href="javascript:void(0);">View All</a>
              <a class="tg-btn" href="javascript:void(0);">Read More</a>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="row">
              <div class="tg-newreleasebooks">
                <div class="col-xs-4 col-sm-4 col-md-6 col-lg-4" v-for="(book, index) in newReleaseBooks" :key="index">
                  <div class="tg-postbook">
                    <figure class="tg-featureimg" v-if="book.hasOwnProperty('image') && book.image.hasOwnProperty('path')">
                      <div class="tg-bookimg">
                        <div class="tg-frontcover">
                          <img :src="book.image.path" alt="image description">
                        </div>

                        <div class="tg-backcover">
                          <img :src="book.image.path" alt="image description">
                        </div>
                      </div>

                      <a class="tg-btnaddtowishlist" href="javascript:void(0);">
                        <i class="icon-heart"></i>
                        <span>Liste de Souhait</span>
                      </a>
                    </figure>

                    <div class="tg-postbookcontent">
                      <ul class="tg-bookscategories">
                        <li v-if="book.hasOwnProperty('subCategory') && book.subCategory.hasOwnProperty('name')">
                          <a href="javascript:void(0);">{{book.subCategory.name}}</a>
                        </li>

                        <li v-if="book.hasOwnProperty(subCategory) && book.subCategory.hasOwnProperty('category') && book.subCategory.category.hasOwnProperty('name')">
                          <a href="javascript:void(0);">{{book.subCategory.category.name}}</a>
                        </li>
                      </ul>

                      <div class="tg-booktitle" v-if="book.hasOwnProperty('title')">
                        <h3><a href="javascript:void(0);">{{book.title}}</a></h3>
                      </div>

                      <span class="tg-bookwriter" v-if="book.hasOwnProperty('author') && book.author.hasOwnProperty('firstName') && book.author.hasOwnProperty('lastName')">
                        par: <a href="javascript:void(0);">{{book.author.firstName + ' ' + book.author.lastName}}</a>
                      </span>

                      <span class="tg-stars" v-if="false"><span></span></span>
                    </div>
                  </div>
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
    name: 'NewRelease',

    props: {
      newReleaseBooks: {
        type: Array,
        default: []
      },
    },
  }
</script>
