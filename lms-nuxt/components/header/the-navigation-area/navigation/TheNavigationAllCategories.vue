<template>
    <li class="menu-item-has-children menu-item-has-mega-menu">
        <a href="javascript:void(0);">All Categories </a>
        <div class="mega-menu">
            <ul class="tg-themetabnav" role="tablist">

                <li role="presentation" class="active_" v-for="categories" v-for="(category, index) in categories" :key="category[index].id">
                    <a href="#{{category.slug}}" aria-controls="{{category.slug}}" role="tab" data-toggle="tab">{{category.name}}</a>
                </li>
            </ul>

            <div class="tab-content tg-themetabcontent">
                <div role="tabpanel" class="tab-pane active_" id="{{category.slug}}"
                     v-for="categories" v-for="category in categories" :key="category.id">
                    <ul>
                        <li>
                            <div class="tg-linkstitle">
                                <h2>{{category.name}}</h2>
                            </div>

                            <ul>
                                <li v-for="(subCategory, index) in category.subCategories">
                                    <a href="products.html">{{category.sub.slug}}</a>
                                </li>
                            </ul>
                            <a class="tg-btnviewall" href="products.html">View All</a>
                        </li>
                        <li>
                            <div class="tg-linkstitle">
                                <h2>Art Forms</h2>
                            </div>
                            <ul>
                                <li><a href="products.html">Consectetur adipisicing</a></li>
                                <li><a href="products.html">Aelit sed do eiusmod</a></li>
                                <li><a href="products.html">Tempor incididunt labore</a></li>
                                <li><a href="products.html">Dolore magna aliqua</a></li>
                                <li><a href="products.html">Ut enim ad minim</a></li>
                            </ul>
                            <a class="tg-btnviewall" href="products.html">View All</a>
                        </li>
                        <li>
                            <div class="tg-linkstitle">
                                <h2>History</h2>
                            </div>
                            <ul>
                                <li><a href="products.html">Veniam quis nostrud</a></li>
                                <li><a href="products.html">Exercitation</a></li>
                                <li><a href="products.html">Laboris nisi ut aliuip</a></li>
                                <li><a href="products.html">Commodo conseat</a></li>
                                <li><a href="products.html">Duis aute irure</a></li>
                            </ul>
                            <a class="tg-btnviewall" href="products.html">View All</a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <figure><img src="~assets/images/img-01.png" alt="image description"></figure>
                            <div class="tg-textbox">
                                <h3>More Than<span>12,0657,53</span>Books Collection</h3>
                                <div class="tg-description">
                                    <p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna
                                        aliqua enim.</p>
                                </div>
                                <a class="tg-btn" href="products.html">view all</a>
                            </div>
                        </li>
                    </ul>
                </div >
            </div>
        </div>
    </li>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "TheNavigationAllCategories",

        asyncData(context) {
            return axios
                .get("http://54.36.182.3/lms/public/index.php/api/categories")
                .then(res => {
                        return {
                            categories: res.data
                        }
                    }
                )
                .catch(e => context.error(e))
        }
    }
</script>

<style scoped>

</style>
