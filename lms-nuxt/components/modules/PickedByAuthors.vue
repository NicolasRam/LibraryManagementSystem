<template>
  <section class="tg-sectionspace tg-haslayout">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="tg-sectionhead">
            <h2><span>Some Great Books</span>Picked By Authors</h2>
            <a class="tg-btn" href="javascript:void(0);">View All</a>
          </div>
        </div>
        <div id="tg-pickedbyauthorslider" class="tg-pickedbyauthor tg-pickedbyauthorslider owl-carousel">
          <div class="item" v-for="(book, index) in pickedByAuthors" :key="index">
            <div class="tg-postbook">
              <figure class="tg-featureimg">
                <div class="tg-bookimg" >
                  <div class="tg-frontcover" v-if="book.hasOwnProperty('image') && book.image.hasOwnProperty('path')">
                    <img :src="book.image.path" alt="image description">
                  </div>

                  <div class="tg-bookimg" v-else>
                    <div class="tg-frontcover"><img src="http://exprostudio.com/html/book_library/images/books/img-10.jpg" alt="image description"></div>
                  </div>
                </div>

                <div class="tg-hovercontent">
                  <div class="tg-description" v-if="book.hasOwnProperty('resume')">
                    <p>{{book.resume}}</p>
                  </div>

                  <strong class="tg-bookpage" v-if="book.hasOwnProperty('pageNumber')">Pages: {{book.pageNumber}}</strong>

                  <strong class="tg-bookcategory" v-if="book.hasOwnProperty('subCategory') && book.subCategory.hasOwnProperty('name')">Catégory: {{book.subCategory.name}}</strong>

                  <strong class="tg-bookprice" v-if="book.hasOwnProperty('price')">Prix: {{book.price}}</strong>

                  <div class="tg-ratingbox" v-if="false"><span class="tg-stars"><span></span></span></div>
                </div>
              </figure>

              <div class="tg-postbookcontent">
                <div class="tg-booktitle" v-if="book.hasOwnProperty('title')">
                  <h3><a href="javascript:void(0);">{{book.title}}</a></h3>
                </div>

                <span class="tg-bookwriter" v-if="book.hasOwnProperty('author') && book.author.hasOwnProperty('firstName') && book.author.hasOwnProperty('lastName')">
                  Par: <a href="javascript:void(0);">{{book.author.firstName + ' ' + book.author.lastName}}</a>
                </span>

                <a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
                  <i class="fa fa-shopping-basket"></i>
                  <em>Ajouter au Panier</em>
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
    name: 'PickedByAuthors',

    props: {
      pickedByAuthors: {
        type: Array,
        default: []
      },
    },

  }
</script>
