<template>
  <div class="book-page">
    <div class="banner">
      <div class="container">
        <h1>{{ book.title }}</h1>
        <RwvBookMeta
          :book="book"
          :actions="true"
        ></RwvBookMeta>
      </div>
    </div>
    <div class="container page">
      <div class="row book-content">
        <div class="col-xs-12">
          <div v-html="parseMarkdown(book.body)"></div>
          <ul class="tag-list">
            <li
              v-for="(tag, index) of book.tagList"
              :key="tag + index">
              <RwvTag :name="tag" className="tag-default tag-pill tag-outline"></RwvTag>
            </li>
          </ul>
        </div>
      </div>
      <hr/>
      <div class="book-actions">
        <RwvBookMeta
          :book="book"
          :actions="true"
        ></RwvBookMeta>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2">
          <RwvCommentEditor
            v-if="isAuthenticated"
            :slug="slug"
            :userImage="currentUser.image">
          </RwvCommentEditor>
          <p v-else>
            <router-link :to="{name: 'login'}">Sign in</router-link>
            or
            <router-link :to="{ name: 'register' }">sign up</router-link>
            to add comments on this book.
          </p>
          <RwvComment
            v-for="(comment, index) in comments"
            :slug="slug"
            :comment="comment"
            :key="index">
          </RwvComment>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import marked from 'marked'
  import store from '@/store'
  import RwvBookMeta from '@/components/BookMeta'
  import RwvComment from '@/components/Comment'
  import RwvCommentEditor from '@/components/CommentEditor'
  import RwvTag from '@/components/VTag'
  import { FETCH_BOOK, FETCH_COMMENTS } from '@/store/actions.type'

  export default {
    name: 'rwv-book',
    props: {
      slug: {
        type: String,
        required: true
      }
    },
    components: {
      RwvBookMeta,
      RwvComment,
      RwvCommentEditor,
      RwvTag
    },
    beforeRouteEnter (to, from, next) {
      Promise.all([
        store.dispatch(FETCH_BOOK, to.params.slug),
        store.dispatch(FETCH_COMMENTS, to.params.slug)
      ]).then((data) => {
        next()
      })
    },
    computed: {
      ...mapGetters([
        'book',
        'currentUser',
        'comments',
        'isAuthenticated'
      ])
    },
    methods: {
      parseMarkdown (content) {
        return marked(content)
      }
    }
  }
</script>
