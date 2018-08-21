<template>
  <section class="tg-sectionspace tg-haslayout">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="tg-sectionhead">
            <h2><span>Strong Minds Behind Us</span>Les Auteurs les plus populaire</h2>
            <a class="tg-btn" href="javascript:void(0);">View All</a>
          </div>
        </div>

        <div id="tg-authorsslider" class="tg-authors tg-authorsslider owl-carousel">
          <div class="item tg-author" v-for="(author, index) in mostPopularAuthors" :key="index">
            <figure><a href="javascript:void(0);"><img src="http://exprostudio.com/html/book_library/images/author/imag-03.jpg" alt="image description"></a></figure>

            <div class="tg-authorcontent">
              <h2><a href="javascript:void(0);">{{author.firstName + " " + author.lastName}}</a></h2>

              <span>{{author.books.length}} Livres Publié</span>

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
  </section>
</template>

<script>
  export default {
    name: 'Authors',

    props: {
      mostPopularAuthors: {
        type: Array,
        default: []
      },
    }
  }
</script>
