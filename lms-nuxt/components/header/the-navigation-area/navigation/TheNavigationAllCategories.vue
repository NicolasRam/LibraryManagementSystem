<template>
    <li class="menu-item-has-children menu-item-has-mega-menu">
        <a href="javascript:void(0);">All Categories </a>
        <div class="mega-menu">
            <ul class="tg-themetabnav" role="tablist">

                <li role="presentation" :class="{ 'active': index === 0 }" v-for="(category, index ) in categories" :key="category.id">
                    <a :href="'#' + category.slug" :aria-controls="key" role="tab"
                       data-toggle="tab">{{ category.name }}</a>
                </li>
            </ul>


            <div class="tab-content tg-themetabcontent">
                <div role="tabpanel" :class="[index === 0 ? 'active' : '', 'tab-pane']" :id="category.slug" v-for="(category, index) in categories" :key="category.id">
                    <ul v-if="category">
                        <li v-for="subCategoryGroup in subCategoryGroups(category)">
                            <div class="tg-linkstitle" v-if="false">
                                <h2>Art Forms</h2>
                            </div>

                            <ul>
                                <li v-for="(subCategory, index) in category.subCategories.slice(i * itemsPerRow, (i + 1) * itemsPerRow)" :key="subCategory.id">
                                    <a href="products.html">{{subCategory.name}}</a>
                                </li>
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
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        name: "TheNavigationAllCategories",

        data() {
            return {
                itemsPerRow: 5,
            }
        },

        props: {
            categories: {
                type: Array,
                default: []
            },
        },

        computed: {
            subCategoryGroups (category) {
                return category ? Array.from(Array(Math.ceil(category.subCategories.length / this.itemsPerRow)).keys()) : 0;
            }
        },
    }
</script>

<style scoped>

</style>
