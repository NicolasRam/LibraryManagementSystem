<template>
  <section class="tg-sectionspace tg-haslayout">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="tg-sectionhead">
            <h2><span>Nouvelles &amp; Articles</span>Actualité à la une des médias</h2>

            <a class="tg-btn" href="javascript:void(0);">Voir Tous</a>
          </div>
        </div>

        <div id="tg-postslider" class="tg-postslider tg-blogpost owl-carousel">
          <article class="item tg-post" v-for="(post, index) in latestPosts" :key="index">
            <figure>
              <a href="javascript:void(0);">
                <img src="http://exprostudio.com/html/book_library/images/blog/img-01.jpg" alt="image description">
              </a>
            </figure>

            <div class="tg-postcontent">
              <ul class="tg-bookscategories">
                <li v-if="post.hasOwnProperty('subCategory') && post.subCategory.hasOwnProperty('name')">
                  <a href="javascript:void(0);">{{post.subCategory.name}}</a>
                </li>

                <li v-if="post.hasOwnProperty(subCategory) && post.subCategory.hasOwnProperty('category') && post.subCategory.category.hasOwnProperty('name')">
                  <a href="javascript:void(0);">{{post.subCategory.category.name}}</a>
                </li>
              </ul>

              <div class="tg-themetagbox" v-if="post.hasOwnProperty('featured') && post.featured === true">
                <span class="tg-themetag">En vedette</span>
              </div>

              <div class="tg-posttitle">
                <h3><a href="javascript:void(0);" v-if="post.hasOwnProperty('title')">{{post.title}}</a></h3>
              </div>

              <span class="tg-bookwriter" v-if="post.hasOwnProperty('author') && post.author.hasOwnProperty('firstName') && post.author.hasOwnProperty('lastName')">
                Par: <a href="javascript:void(0);">{{post.author.firstName + " " + post.author.lastName}}</a>
              </span>

              <ul class="tg-postmetadata">
                <li><a href="javascript:void(0);"><i class="fa fa-comment-o"></i><i>{{getRandomInt(2500, 1000 )}} Comments</i></a></li>

                <li><a href="javascript:void(0);"><i class="fa fa-eye"></i><i>{{getRandomInt(2500, 1000 )}} Views</i></a></li>
              </ul>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  export default {
    name: 'LatestNews',

    props: {
      latestPosts: {
        type: Array,
        default: []
      },
    },

    methods: {
      getRandomInt( min, max ){
        return Math.floor(Math.random() * (max - min + 1) + min);
      }
    }
  }
</script>
