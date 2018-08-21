import Vue from 'vue'
import NuxtLoading from './components/nuxt-loading.vue'

import '../assets/css/bootstrap.min.css'

import '../assets/css/normalize.css'

import '../assets/css/font-awesome.min.css'

import '../assets/css/icomoon.css'

import '../assets/css/jquery-ui.css'

import '../assets/css/owl.carousel.css'

import '../assets/css/transitions.css'

import '../assets/css/main.css'

import '../assets/css/color.css'

import '../assets/css/responsive.css'


let layouts = {

  "_default": () => import('../layouts/default.vue'  /* webpackChunkName: "layouts/default" */).then(m => m.default || m)

}

let resolvedLayouts = {}

export default {
  head: {"title":"LMS","meta":[{"charset":"utf-8"},{"name":"viewport","content":"width=device-width, initial-scale=1"},{"hid":"description","name":"description","content":"Library Management System"}],"link":[{"rel":"icon","type":"image\u002Fx-icon","href":"~assets\u002Fcss\u002Ffavicon.ico"}],"script":[{"src":"js\u002Fvendor\u002Fmodernizr-2.8.3-respond-1.4.2.min.js"},{"src":"js\u002Fvendor\u002Fjquery-library.js"},{"src":"js\u002Fvendor\u002Fbootstrap.min.js"},{"src":"https:\u002F\u002Fmaps.google.com\u002Fmaps\u002Fapi\u002Fjs?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&language=en"},{"src":"js\u002Fowl.carousel.min.js"},{"src":"js\u002Fjquery.vide.min.js"},{"src":"js\u002Fcountdown.js"},{"src":"js\u002Fjquery-ui.js"},{"src":"js\u002Fparallax.js"},{"src":"js\u002FcountTo.js"},{"src":"js\u002Fappear.js"},{"src":"js\u002Fgmap3.js"},{"src":"js\u002Fmain.js"}],"bodyAttr":[{"class":"tg-home tg-homeone"}],"style":[]},
  render(h, props) {
    const loadingEl = h('nuxt-loading', { ref: 'loading' })
    const layoutEl = h(this.layout || 'nuxt')
    const templateEl = h('div', {
      domProps: {
        id: '__layout'
      },
      key: this.layoutName
    }, [ layoutEl ])

    const transitionEl = h('transition', {
      props: {
        name: 'layout',
        mode: 'out-in'
      }
    }, [ templateEl ])

    return h('div',{
      domProps: {
        id: '__nuxt'
      }
    }, [
      loadingEl,
      transitionEl
    ])
  },
  data: () => ({
    layout: null,
    layoutName: ''
  }),
  beforeCreate () {
    Vue.util.defineReactive(this, 'nuxt', this.$options.nuxt)
  },
  created () {
    // Add this.$nuxt in child instances
    Vue.prototype.$nuxt = this
    // add to window so we can listen when ready
    if (typeof window !== 'undefined') {
      window.$nuxt = this
    }
    // Add $nuxt.error()
    this.error = this.nuxt.error
  },
  
  mounted () {
    this.$loading = this.$refs.loading
  },
  watch: {
    'nuxt.err': 'errorChanged'
  },
  
  methods: {
    
    errorChanged () {
      if (this.nuxt.err && this.$loading) {
        if (this.$loading.fail) this.$loading.fail()
        if (this.$loading.finish) this.$loading.finish()
      }
    },
    
    setLayout (layout) {
      if (!layout || !resolvedLayouts['_' + layout]) layout = 'default'
      this.layoutName = layout
      let _layout = '_' + layout
      this.layout = resolvedLayouts[_layout]
      return this.layout
    },
    loadLayout (layout) {
      if (!layout || !(layouts['_' + layout] || resolvedLayouts['_' + layout])) layout = 'default'
      let _layout = '_' + layout
      if (resolvedLayouts[_layout]) {
        return Promise.resolve(resolvedLayouts[_layout])
      }
      return layouts[_layout]()
      .then((Component) => {
        resolvedLayouts[_layout] = Component
        delete layouts[_layout]
        return resolvedLayouts[_layout]
      })
      .catch((e) => {
        if (this.$nuxt) {
          return this.$nuxt.error({ statusCode: 500, message: e.message })
        }
      })
    }
  },
  components: {
    NuxtLoading
  }
}

