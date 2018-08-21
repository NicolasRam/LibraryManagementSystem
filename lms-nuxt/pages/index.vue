<template>
    <main id="tg-main" class="tg-main tg-haslayout">
        <all-status
                :booksCount="loadedBooksCount"
                :membersCount="loadedMembersCount"
                :librariesCount="loadedLibrariesCount"
        />

        <best-selling :bestSellingBooks="loadedBestSellingBooks"/>
        <featured-item :bestFeaturedBook="loadedFeaturedBook"/>
        <new-release :newReleaseBooks="loadedNewReleaseBooks"/>
        <collection-counts :collectionCounts="loadedCollectionCounts"/>
        <picked-by-authors :pickedByAuthors="loadedPickedByAuthorBooks"/>
        <testimonials :testimonials="loadedTestimonials"/>
        <authors :mostPopularAuthors="loadedMostPopularAuthors"/>
        <call-to-action :callToAction="loadedCallToAction"/>
        <latest-news :latestPosts="loadedLatestPosts"/>
    </main>
</template>

<script>
    import AllStatus from "../components/modules/AllStatus";
    import BestSelling from "../components/modules/BestSelling";
    import FeaturedItem from "../components/modules/FeaturedItem";
    import NewRelease from "../components/modules/NewRelease";
    import CollectionCounts from "../components/modules/CollectionCounts";
    import PickedByAuthors from "../components/modules/PickedByAuthors";
    import Testimonials from "../components/modules/Testimonials";
    import Authors from "../components/modules/Authors";
    import CallToAction from "../components/modules/CallToAction";
    import LatestNews from "../components/modules/LatestNews";

    export default {
        components: {
            LatestNews,
            CallToAction,
            Authors,
            Testimonials,
            PickedByAuthors,
            CollectionCounts,
            NewRelease,
            FeaturedItem,
            BestSelling,
            AllStatus
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
