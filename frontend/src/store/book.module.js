import Vue from 'vue'
import { BooksService, CommentsService, FavoriteService } from '@/common/api.service'
import {
  FETCH_BOOK,
  FETCH_COMMENTS,
  COMMENT_CREATE,
  COMMENT_DESTROY,
  FAVORITE_ADD,
  FAVORITE_REMOVE,
  BOOK_PUBLISH,
  BOOK_EDIT,
  BOOK_EDIT_ADD_TAG,
  BOOK_EDIT_REMOVE_TAG,
  BOOK_DELETE,
  BOOK_RESET_STATE
} from './actions.type'
import {
  RESET_STATE,
  SET_BOOK,
  SET_COMMENTS,
  TAG_ADD,
  TAG_REMOVE,
  UPDATE_BOOK_IN_LIST
} from './mutations.type'

const initialState = {
  book: {
    author: {},
    title: '',
    description: '',
    body: '',
    tagList: []
  },
  comments: []
}

export const state = Object.assign({}, initialState)

export const actions = {
  [FETCH_BOOK] (context, bookSlug, prevBook) {
    // avoid extronuous network call if book exists
    if (prevBook !== undefined) {
      return context.commit(SET_BOOK, prevBook)
    }
    return BooksService.get(bookSlug)
      .then(({ data }) => {
        context.commit(SET_BOOK, data.book)
        return data
      })
  },
  [FETCH_COMMENTS] (context, bookSlug) {
    return CommentsService.get(bookSlug)
      .then(({ data }) => {
        context.commit(SET_COMMENTS, data.comments)
      })
  },
  [COMMENT_CREATE] (context, payload) {
    return CommentsService
      .post(payload.slug, payload.comment)
      .then(() => { context.dispatch(FETCH_COMMENTS, payload.slug) })
  },
  [COMMENT_DESTROY] (context, payload) {
    return CommentsService
      .destroy(payload.slug, payload.commentId)
      .then(() => {
        context.dispatch(FETCH_COMMENTS, payload.slug)
      })
  },
  [FAVORITE_ADD] (context, payload) {
    return FavoriteService
      .add(payload)
      .then(({ data }) => {
        // Update list as well. This allows us to favorite an book in the Home view.
        context.commit(
          UPDATE_BOOK_IN_LIST,
          data.book,
          { root: true }
        )
        context.commit(SET_BOOK, data.book)
      })
  },
  [FAVORITE_REMOVE] (context, payload) {
    return FavoriteService
      .remove(payload)
      .then(({ data }) => {
        // Update list as well. This allows us to favorite an book in the Home view.
        context.commit(
          UPDATE_BOOK_IN_LIST,
          data.book,
          { root: true }
        )
        context.commit(SET_BOOK, data.book)
      })
  },
  [BOOK_PUBLISH] ({ state }) {
    return BooksService.create(state.book)
  },
  [BOOK_DELETE] (context, slug) {
    return BooksService.destroy(slug)
  },
  [BOOK_EDIT] ({ state }) {
    return BooksService.update(state.book.slug, state.book)
  },
  [BOOK_EDIT_ADD_TAG] (context, tag) {
    context.commit(TAG_ADD, tag)
  },
  [BOOK_EDIT_REMOVE_TAG] (context, tag) {
    context.commit(TAG_REMOVE, tag)
  },
  [BOOK_RESET_STATE] ({ commit }) {
    commit(RESET_STATE)
  }
}

/* eslint no-param-reassign: ["error", { "props": false }] */
export const mutations = {
  [SET_BOOK] (state, book) {
    state.book = book
  },
  [SET_COMMENTS] (state, comments) {
    state.comments = comments
  },
  [TAG_ADD] (state, tag) {
    state.book.tagList = state.book.tagList.concat([tag])
  },
  [TAG_REMOVE] (state, tag) {
    state.book.tagList = state.book.tagList.filter(t => t !== tag)
  },
  [RESET_STATE] () {
    for (let f in state) {
      Vue.set(state, f, initialState[f])
    }
  }
}

const getters = {
  book (state) {
    return state.book
  },
  comments (state) {
    return state.comments
  }
}

export default {
  state,
  actions,
  mutations,
  getters
}
