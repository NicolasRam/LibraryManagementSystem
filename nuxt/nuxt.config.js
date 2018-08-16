// const axios = require("axios");

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
  }
}

