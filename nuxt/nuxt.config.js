const pkg = require("./package");
const bodyParser = require("body-parser");
const axios = require("axios");

module.exports = {
  /*
  ** Headers of the page
  */
  head: {
    title: 'LMS',
    meta: [
      { charset: 'utf-8' },
        { httpEquiv: "X-UA-Compatible"/*, content='IE=edge'*/ },
        { hid: "description", name: "description", content: "Library Management System" },
        { name: "viewport", content: "width=device-width, initial-scale=1" }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  /*
  ** Customize the progress bar color
  */
  loading: { color: '#3B8070' },

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
   ** Nuxt.js modules
   */
  modules: ["@nuxtjs/axios"],
  axios: {
    baseURL: process.env.BASE_URL || "http://54.36.182.3/lms/public/index.php/api",
    credentials: false
  },

  /*
  ** Build configuration
  */
  build: {
    /*
    ** Run ESLint on save
    */
    extend (config, { isDev, isClient }) {
      if (isDev && isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }
    }
  },

  env: {
    baseUrl: process.env.BASE_URL || 'http://54.36.182.3/lms/public/index.php/api'
  },
  transition: {
    name: "fade",
    mode: "out-in"
  },
  // router: {
  //   middleware: 'log'
  // }
  // serverMiddleware: [bodyParser.json(), "~/api"],
  generate: {
    routes: function() {
      return axios
        .get("http://54.36.182.3/lms/public/index.php/api")
        .then(res => {
          const routes = [];
          for (const key in res.data) {
            routes.push({
              route: "/categories/" + key,
              payload: {postData: res.data[key]}
            });
          }
          return routes;
        });
    }
  }
};

