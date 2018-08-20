<template>
    <section class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-sectionhead">
                        <h2><span>People’s Choice</span>Bestselling Books</h2>
                        <a class="tg-btn" href="javascript:void(0);">View All</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="tg-bestsellingbooksslider"
                         class="tg-bestsellingbooksslider tg-bestsellingbooks owl-carousel">
                        <div class="item" v-for="(book, index) in bestSellingBooks" :key="index">
                            <div class="tg-postbook">
                                <figure class="tg-featureimg">
                                    <div class="tg-bookimg">
                                        <div class="tg-frontcover"><img :src="book.image.path"
                                                                        alt="image description"></div>
                                        <div class="tg-backcover"><img :src="book.image.path"
                                                                       alt="image description"></div>
                                    </div>

                                    <a class="tg-btnaddtowishlist" href="javascript:void(0);">
                                        <i class="icon-heart"></i>
                                        <span>add to wishlist</span>
                                    </a>
                                </figure>

                                <div class="tg-postbookcontent">
                                    <ul class="tg-bookscategories">
                                        <li><a href="javascript:void(0);">Adventure</a></li>
                                        <li><a href="javascript:void(0);">Fun</a></li>
                                    </ul>

                                    <div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>

                                    <div class="tg-booktitle">
                                        <h3><a href="javascript:void(0);">{{book.title}}</a></h3>
                                    </div>

                                    <span class="tg-bookwriter">Par: <a href="javascript:void(0);">{{ book.author.firstName }}</a></span>

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
    </section>
</template>

<script>
    import {mapGetters} from 'vuex'
    import axios from 'axios'

    export default {
        name: 'BestSelling',

        computed: {
            ...mapGetters([
                'currentUser',
                'isAuthenticated'
            ])
        },

        data: {
            author : null
        },

        methods: {
            getAuthor: function (url) {
                return axios.get('http://54.36.182.3' + url)
                    .then((response) => {
                        alert(response.data);
                        return response.data;
                    })
                    .catch(error => {
                        alert('http://54.36.182.3' + url);
                        alert(error);
                        console.log(error)
                    });
            }
        },

        props: {
            bestSellingBooks: {
                type: Array,
                default: []
            },
        }
    }
</script>
