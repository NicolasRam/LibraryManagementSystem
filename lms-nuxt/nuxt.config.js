const pkg = require("./package");
const bodyParser = require("body-parser");
const axios = require("axios");

module.exports = {
    mode: "universal",

    /*
    ** Headers of the page
    */
    head: {
        title: 'LMS',
        meta: [
            {charset: "utf-8"},
            {name: "viewport", content: "width=device-width, initial-scale=1"},
            {
                hid: "description",
                name: "description",
                content: "Library Management System"
            }
        ],
        link: [
            {rel: "icon", type: "image/x-icon", href: "~assets/css/favicon.ico"},
        ],
        script: [
            {src: "js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"},
            {src: "js/vendor/jquery-library.js"},
            {src: "js/vendor/bootstrap.min.js"},
            {src: "https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&language=en"},
            {src: "js/owl.carousel.min.js"},
            {src: "js/jquery.vide.min.js"},
            {src: "js/countdown.js"},
            {src: "js/jquery-ui.js"},
            {src: "js/parallax.js"},
            {src: "js/countTo.js"},
            {src: "js/appear.js"},
            {src: "js/gmap3.js"},
            {src: "js/main.js"},
        ],

        bodyAttr: [
            {class: "tg-home tg-homeone"}
        ],
    },

    /*
    ** Customize the progress-bar color
    */
    loading: {color: "#fa923f", height: "4px", duration: 5000},
    loadingIndicator: {
        name: "circle",
        color: "#fa923f"
    },

    /*
    ** Global CSS
    */
    css: [
        "~assets/css/bootstrap.min.css",
        "~assets/css/normalize.css",
        "~assets/css/font-awesome.min.css",
        "~assets/css/icomoon.css",
        "~assets/css/jquery-ui.css",
        "~assets/css/owl.carousel.css",
        "~assets/css/transitions.css",
        "~assets/css/main.css",
        "~assets/css/color.css",
        "~assets/css/responsive.css"
    ],

    /*
    ** Plugins to load before mounting the App
    */
    plugins: [
        "~plugins/core-components.js",
        "~plugins/date-filter.js",
    ],

    /*
    ** Nuxt.js modules
    */
    modules: ["@nuxtjs/axios"],
    axios: {
        baseURL: process.env.BASE_URL || "http://localhost:8000/api",
        credentials: false
    },

    /*
    ** Build configuration
    */
    build: {
        // vendor: [
        //   "~assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js",
        //   "~assets/js/vendor/jquery-library.js",
        //   "~assets/js/vendor/bootstrap.min.js",
        //   // "https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&language=en",
        //   "~assets/js/owl.carousel.min.js",
        //   "~assets/js/jquery.vide.min.js",
        //   "~assets/js/countdown.js",
        //   "~assets/js/jquery-ui.js",
        //   "~assets/js/parallax.js",
        //   "~assets/js/countTo.js",
        //   "~assets/js/appear.js",
        //   "~assets/js/gmap3.js",
        //   "~assets/js/main.js"
        // ],
        /*
        ** You can extend webpack config here
        */
        extend(config, ctx) {
        }
    },
    env: {
        baseUrl: process.env.BASE_URL || "http://localhost:8000/api",
        fbAPIKey: ""
    },
    transition: {
        name: "fade",
        mode: "out-in"
    },

    // router: {
    //   middleware: 'log'
    // }

    serverMiddleware: [bodyParser.json(), "~/api"],

    generate: {
        routes: function () {
            return axios
                .get("http://localhost:8000/api/books")
                .then(res => {
                    const routes = [];
                    for (const key in res.data) {
                        routes.push({
                            route: "/books/" + key,
                            payload: {bookData: res.data[key]}
                        });
                    }
                    return routes;
                });
        }
    }
};
