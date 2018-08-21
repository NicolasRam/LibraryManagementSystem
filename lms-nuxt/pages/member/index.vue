<template>
  <div></div>
</template>

<script>
    export default {
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
        }
    }
</script>
