import Vuex from "vuex";
import Cookie from "js-cookie";

let axiosConfig = {
  headers: {
    'Content-Type': 'application/json',
  }
};

const createStore = () => {
  return new Vuex.Store({
    state: {
      loadedBooks: [],

      loadedBestSellingBooks: [],
      loadedFeaturedBook: null,
      loadedNewReleaseBooks: [],
      loadedCollectionCounts: [],
      loadedPickedByAuthorBooks: [],
      loadedTestimonials: [],
      loadedMostPopularAuthors: [],
      loadedCallToAction: [],
      loadedLatestPosts: [],
      loadedBestSellingAuthors: [],

      loadedCategories: [],
      loadedBooksCount: 0,
      loadedMembersCount: 0,
      loadedLibrariesCount: 0,
      token: null
    },

    mutations: {
      setBooks(state, books) {
        state.loadedBooks = books;
      },
      addBook(state, book) {
        state.loadedBooks.push(book);
      },
      editBook(state, editedBook) {
        const bookIndex = state.loadedBooks.findIndex(
          book => book.id === editedBook.id
        );
        state.loadedBooks[bookIndex] = editedBook;
      },

      setBestSellingBooks(state, bestSellingBooks) {
        state.loadedBestSellingBooks = bestSellingBooks;
      },
      addBestSellingBook(state, bestSellingBook) {
        state.loadedBestSellingBooks.push(bestSellingBook);
      },
      editBestSellingBook(state, editedBestSellingBook) {
        const bestSellingBookIndex = state.loadedBestSellingBooks.findIndex(
          bestSellingBook => bestSellingBook.id === editedBestSellingBook.id
        );
        state.loadedBestSellingBooks[bestSellingBookIndex] = editedBestSellingBook;
      },

      setFeatureBook(state, featureBook) {
        state.loadedFeatureBook = featureBook;
      },
      addFeatureBook(state, featureBook) {
        state.loadedFeatureBook.push(featureBook);
      },
      editFeatureBook(state, editedFeatureBook) {
        const featureBookIndex = state.loadedFeatureBook.findIndex(
          featureBook => featureBook.id === editedFeatureBook.id
        );
        state.loadedFeatureBook[featureBookIndex] = editedFeatureBook;
      },

      setNewReleaseBooks(state, newReleaseBooks) {
        state.loadedNewReleaseBooks = newReleaseBooks;
      },
      addNewReleaseBook(state, newReleaseBook) {
        state.loadedNewReleaseBooks.push(newReleaseBook);
      },
      editNewReleaseBook(state, editedNewReleaseBook) {
        const newReleaseBookIndex = state.loadedNewReleaseBooks.findIndex(
          newReleaseBook => newReleaseBook.id === editedNewReleaseBook.id
        );
        state.loadedNewReleaseBooks[newReleaseBookIndex] = editedNewReleaseBook;
      },

      setCollectionCounts(state, collectionCounts) {
        state.loadedCollectionCounts = collectionCounts;
      },
      addCollectionCount(state, collectionCount) {
        state.loadedCollectionCounts.push(collectionCount);
      },
      editCollectionCount(state, editedCollectionCount) {
        const collectionCountIndex = state.loadedCollectionCounts.findIndex(
          collectionCount => collectionCount.id === editedCollectionCount.id
        );
        state.loadedCollectionCounts[collectionCountIndex] = editedCollectionCount;
      },

      setPickedByAuthorBooks(state, pickedByAuthorBooks) {
        state.loadedPickedByAuthorBooks = pickedByAuthorBooks;
      },
      addPickedByAuthorBook(state, pickedByAuthorBook) {
        state.loadedPickedByAuthorBooks.push(pickedByAuthorBook);
      },
      editPickedByAuthorBook(state, editedPickedByAuthorBook) {
        const pickedByAuthorBookIndex = state.loadedPickedByAuthorBooks.findIndex(
          pickedByAuthorBook => pickedByAuthorBook.id === editedPickedByAuthorBook.id
        );
        state.loadedPickedByAuthorBooks[pickedByAuthorBookIndex] = editedPickedByAuthorBook;
      },

      setTestimonials(state, testimonials) {
        state.loadedTestimonials = testimonials;
      },
      addTestimonial(state, testimonial) {
        state.loadedTestimonials.push(testimonial);
      },
      editTestimonial(state, editedTestimonial) {
        const testimonialIndex = state.loadedTestimonials.findIndex(
          testimonial => testimonial.id === editedTestimonial.id
        );
        state.loadedTestimonials[testimonialIndex] = editedTestimonial;
      },

      setMostPopularAuthors(state, mostPopularAuthors) {
        state.loadedMostPopularAuthors = mostPopularAuthors;
      },
      addMostPopularAuthor(state, mostPopularAuthor) {
        state.loadedMostPopularAuthors.push(mostPopularAuthor);
      },
      editMostPopularAuthor(state, editedMostPopularAuthor) {
        const mostPopularAuthorIndex = state.loadedMostPopularAuthors.findIndex(
          mostPopularAuthor => mostPopularAuthor.id === editedMostPopularAuthor.id
        );
        state.loadedMostPopularAuthors[mostPopularAuthorIndex] = editedMostPopularAuthor;
      },

      setCallToAction(state, callToAction) {
        state.loadedCallToAction = callToAction;
      },
      addCallToAction(state, callToAction) {
        state.loadedCallToAction.push(callToAction);
      },
      editCallToAction(state, editedCallToAction) {
        const callToActionIndex = state.loadedCallToAction.findIndex(
          callToAction => callToAction.id === editedCallToAction.id
        );
        state.loadedCallToAction[callToActionIndex] = editedCallToAction;
      },

      setLatestPosts(state, latestPosts) {
        state.loadedLatestPosts = latestPosts;
      },
      addLatestPost(state, latestPost) {
        state.loadedLatestPosts.push(latestPost);
      },
      editLatestPost(state, editedLatestPost) {
        const latestPostIndex = state.loadedLatestPosts.findIndex(
          latestPost => latestPost.id === editedLatestPost.id
        );
        state.loadedLatestPosts[latestPostIndex] = editedLatestPost;
      },

      setBestSellingAuthors(state, bestSellingAuthors) {
        state.loadedBestSellingAuthors = bestSellingAuthors;
      },
      addBestSellingAuthor(state, bestSellingAuthor) {
        state.loadedBestSellingAuthors.push(bestSellingAuthor);
      },
      editBestSellingAuthor(state, editedBestSellingAuthor) {
        const bestSellingAuthorIndex = state.loadedBestSellingAuthors.findIndex(
          bestSellingAuthor => bestSellingAuthor.id === editedBestSellingAuthor.id
        );
        state.loadedBestSellingAuthors[bestSellingAuthorIndex] = editedBestSellingAuthor;
      },

      setFeaturedBook(state, featuredBook) {
        state.loadedFeaturedBook = featuredBook;
      },
      addFeaturedBook(state, featuredBook) {
        state.loadedFeaturedBook.push(featuredBook);
      },
      editFeaturedBook(state, editedFeaturedBook) {
        const featuredBookIndex = state.loadedFeaturedBook.findIndex(
          featuredBook => featuredBook.id === editedFeaturedBook.id
        );
        state.loadedFeaturedBook[featuredBookIndex] = editedFeaturedBook;
      },

      setCategories(state, categories) {
        state.loadedCategories = categories;
      },
      addCategory(state, category) {
        state.loadedCategories.push(category);
      },
      editCategory(state, editedCategory) {
        const categoryIndex = state.loadedCategories.findIndex(
          category => category.id === editedCategory.id
        );
        state.loadedCategories[categoryIndex] = editedCategory;
      },

      setBooksCount(state, booksCount) {
        state.loadedBooksCount = booksCount;
      },

      setMembersCount(state, membersCount) {
        state.loadedMembersCount = membersCount;
      },

      setLibrariesCount(state, librariesCount) {
        state.loadedLibrariesCount = librariesCount;
      },

      setToken(state, token) {
        state.token = token;
      },
      clearToken(state) {
        state.token = null;
      }
    },

    actions: {
      nuxtServerInit(vuexContext, context) {
        context.app.$axios
          .$get("/books/count")
          .then(data => {
            vuexContext.commit("setBooksCount", data.booksCount);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/members/count")
          .then(data => {
            vuexContext.commit("setMembersCount", data.membersCount);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/libraries/count")
          .then(data => {
            vuexContext.commit("setLibrariesCount", data.librariesCount);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/books/best-sellers", [], {headers: {'Content-Type': 'application/json'}})
          .then(data => {
            vuexContext.commit("setBestSellingBooks", data['hydra:member']);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/books/featured")
          .then(data => {
            vuexContext.commit("setFeaturedBook", data.book);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/books/new-releases", [], {headers: {'Content-Type': 'application/json'}})
          .then(data => {
            vuexContext.commit("setNewReleaseBooks", data['hydra:member']);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/books/picked-by-author", [], {headers: {'Content-Type': 'application/json'}})
          .then(data => {
            vuexContext.commit("setPickedByAuthorBooks", data['hydra:member']);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/testimonials", [], {headers: {'Content-Type': 'application/json'}})
          .then(data => {
            vuexContext.commit("setTestimonials", data['hydra:member']);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/authors/most-populars", [], {headers: {'Content-Type': 'application/json'}})
          .then(data => {
            vuexContext.commit("setMostPopularAuthors", data['hydra:member']);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/books/call-to-action")
          .then(data => {
            vuexContext.commit("setCallToAction", data.actions);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/books/latest-posts")
          .then(data => {
            vuexContext.commit("setLatestPosts", data.posts);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/authors/best-selling", [], {headers: {'Content-Type': 'application/json'}})
          .then(data => {
            vuexContext.commit("setBestSellingAuthors", data['hydra:member']);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/sub-categories/counts", [], {headers: {'Content-Type': 'application/json'}})
          .then(data => {
            vuexContext.commit("setCollectionCounts", data);
          })
          .catch(e => context.error(e));

        context.app.$axios
          .$get("/categories", [], {headers: {'Content-Type': 'application/json'}})
          .then(data => {
            vuexContext.commit("setCategories", data['hydra:member']);
          })
          .catch(e => context.error(e));

        return context.app.$axios
          .$get("/books")
          .then(data => {

            const booksArray = [];
            for (const key in data) {
              booksArray.push({...data[key], id: key});
            }
            vuexContext.commit("setBooks", booksArray);
          })
          .catch(e => context.error(e));
      },

      addBook(vuexContext, book) {
        const createdBook = {
          ...book,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/books?auth=" +
            vuexContext.state.token,
            createdBook
          )
          .then(data => {
            vuexContext.commit("addBook", {...createdBook, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editBook(vuexContext, editedBook) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/books/" +
            editedBook.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedBook
          )
          .then(res => {
            vuexContext.commit("editBook", editedBook);
          })
          .catch(e => console.log(e));
      },
      setBooks(vuexContext, books) {
        vuexContext.commit("setBooks", books);
      },

      addCategory(vuexContext, category) {
        const createdCategory = {
          ...category,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/categories",
            createdCategory, {
              headers: {
                //'Content-type': 'application/json',
                'Authorization': 'Bearer ' + vuexContext.state.token
              }
            }
          )
          .then(data => {
            vuexContext.commit("addCategory", {...createdCategory, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editCategory(vuexContext, editedCategory) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/categories/" +
            editedCategory.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedCategory
          )
          .then(res => {
            vuexContext.commit("editCategory", editedCategory);
          })
          .catch(e => console.log(e));
      },
      setCategories(vuexContext, categories) {
        vuexContext.commit("setCategories", categories);
      },

      addBestSellingBook(vuexContext, bestSellingBook) {
        const createdBestSellingBook = {
          ...bestSellingBook,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/bestSellingBooks?auth=" +
            vuexContext.state.token,
            createdBestSellingBook
          )
          .then(data => {
            vuexContext.commit("addBestSellingBook", {...createdBestSellingBook, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editBestSellingBook(vuexContext, editedBestSellingBook) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/bestSellingBooks/" +
            editedBestSellingBook.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedBestSellingBook
          )
          .then(res => {
            vuexContext.commit("editBestSellingBook", editedBestSellingBook);
          })
          .catch(e => console.log(e));
      },
      setBestSellingBooks(vuexContext, bestSellingBooks) {
        vuexContext.commit("setBestSellingBooks", bestSellingBooks);
      },

      addFeaturedBook(vuexContext, featuredBook) {
        const createdFeaturedBook = {
          ...featuredBook,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/featuredBook?auth=" +
            vuexContext.state.token,
            createdFeaturedBook
          )
          .then(data => {
            vuexContext.commit("addFeaturedBook", {...createdFeaturedBook, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editFeaturedBook(vuexContext, editedFeaturedBook) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/featuredBook/" +
            editedFeaturedBook.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedFeaturedBook
          )
          .then(res => {
            vuexContext.commit("editFeaturedBook", editedFeaturedBook);
          })
          .catch(e => console.log(e));
      },
      setFeaturedBook(vuexContext, featuredBook) {
        vuexContext.commit("setFeaturedBook", featuredBook);
      },

      addNewReleaseBook(vuexContext, newReleaseBook) {
        const createdNewReleaseBook = {
          ...newReleaseBook,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/newReleaseBooks?auth=" +
            vuexContext.state.token,
            createdNewReleaseBook
          )
          .then(data => {
            vuexContext.commit("addNewReleaseBook", {...createdNewReleaseBook, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editNewReleaseBook(vuexContext, editedNewReleaseBook) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/newReleaseBooks/" +
            editedNewReleaseBook.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedNewReleaseBook
          )
          .then(res => {
            vuexContext.commit("editNewReleaseBook", editedNewReleaseBook);
          })
          .catch(e => console.log(e));
      },
      setNewReleaseBooks(vuexContext, newReleaseBooks) {
        vuexContext.commit("setNewReleaseBooks", newReleaseBooks);
      },

      addCollectionCount(vuexContext, collectionCount) {
        const createdCollectionCount = {
          ...collectionCount,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/collectionCounts?auth=" +
            vuexContext.state.token,
            createdCollectionCount
          )
          .then(data => {
            vuexContext.commit("addCollectionCount", {...createdCollectionCount, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editCollectionCount(vuexContext, editedCollectionCount) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/collectionCounts/" +
            editedCollectionCount.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedCollectionCount
          )
          .then(res => {
            vuexContext.commit("editCollectionCount", editedCollectionCount);
          })
          .catch(e => console.log(e));
      },
      setCollectionCounts(vuexContext, collectionCounts) {
        vuexContext.commit("setCollectionCounts", collectionCounts);
      },

      addPickedByAuthorBook(vuexContext, pickedByAuthorBook) {
        const createdPickedByAuthorBook = {
          ...pickedByAuthorBook,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/pickedByAuthorBooks?auth=" +
            vuexContext.state.token,
            createdPickedByAuthorBook
          )
          .then(data => {
            vuexContext.commit("addPickedByAuthorBook", {...createdPickedByAuthorBook, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editPickedByAuthorBook(vuexContext, editedPickedByAuthorBook) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/pickedByAuthorBooks/" +
            editedPickedByAuthorBook.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedPickedByAuthorBook
          )
          .then(res => {
            vuexContext.commit("editPickedByAuthorBook", editedPickedByAuthorBook);
          })
          .catch(e => console.log(e));
      },
      setPickedByAuthorBooks(vuexContext, pickedByAuthorBooks) {
        vuexContext.commit("setPickedByAuthorBooks", pickedByAuthorBooks);
      },

      addTestimonial(vuexContext, testimonial) {
        const createdTestimonial = {
          ...testimonial,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/testimonials?auth=" +
            vuexContext.state.token,
            createdTestimonial
          )
          .then(data => {
            vuexContext.commit("addTestimonial", {...createdTestimonial, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editTestimonial(vuexContext, editedTestimonial) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/testimonials/" +
            editedTestimonial.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedTestimonial
          )
          .then(res => {
            vuexContext.commit("editTestimonial", editedTestimonial);
          })
          .catch(e => console.log(e));
      },
      setTestimonials(vuexContext, testimonials) {
        vuexContext.commit("setTestimonials", testimonials);
      },

      addMostPopularAuthor(vuexContext, mostPopularAuthor) {
        const createdMostPopularAuthor = {
          ...mostPopularAuthor,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/mostPopularAuthors?auth=" +
            vuexContext.state.token,
            createdMostPopularAuthor
          )
          .then(data => {
            vuexContext.commit("addMostPopularAuthor", {...createdMostPopularAuthor, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editMostPopularAuthor(vuexContext, editedMostPopularAuthor) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/mostPopularAuthors/" +
            editedMostPopularAuthor.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedMostPopularAuthor
          )
          .then(res => {
            vuexContext.commit("editMostPopularAuthor", editedMostPopularAuthor);
          })
          .catch(e => console.log(e));
      },
      setMostPopularAuthors(vuexContext, mostPopularAuthors) {
        vuexContext.commit("setMostPopularAuthors", mostPopularAuthors);
      },

      addCallToAction(vuexContext, callToAction) {
        const createdCallToAction = {
          ...callToAction,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/callToAction?auth=" +
            vuexContext.state.token,
            createdCallToAction
          )
          .then(data => {
            vuexContext.commit("addCallToAction", {...createdCallToAction, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editCallToAction(vuexContext, editedCallToAction) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/callToAction/" +
            editedCallToAction.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedCallToAction
          )
          .then(res => {
            vuexContext.commit("editCallToAction", editedCallToAction);
          })
          .catch(e => console.log(e));
      },
      setCallToAction(vuexContext, callToAction) {
        vuexContext.commit("setCallToAction", callToAction);
      },

      addLatestPost(vuexContext, latestPost) {
        const createdLatestPost = {
          ...latestPost,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/latestPosts?auth=" +
            vuexContext.state.token,
            createdLatestPost
          )
          .then(data => {
            vuexContext.commit("addLatestPost", {...createdLatestPost, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editLatestPost(vuexContext, editedLatestPost) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/latestPosts/" +
            editedLatestPost.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedLatestPost
          )
          .then(res => {
            vuexContext.commit("editLatestPost", editedLatestPost);
          })
          .catch(e => console.log(e));
      },
      setLatestPosts(vuexContext, latestPosts) {
        vuexContext.commit("setLatestPosts", latestPosts);
      },

      addBestSellingAuthor(vuexContext, bestSellingAuthor) {
        const createdBestSellingAuthor = {
          ...bestSellingAuthor,
          updatedDate: new Date()
        };
        return this.$axios
          .$post(
            "http://localhost:8000/api/bestSellingAuthors?auth=" +
            vuexContext.state.token,
            createdBestSellingAuthor
          )
          .then(data => {
            vuexContext.commit("addBestSellingAuthor", {...createdBestSellingAuthor, id: data.name});
          })
          .catch(e => console.log(e));
      },
      editBestSellingAuthor(vuexContext, editedBestSellingAuthor) {
        return this.$axios
          .$put(
            "http://localhost:8000/api/bestSellingAuthors/" +
            editedBestSellingAuthor.id +
            ".json?auth=" +
            vuexContext.state.token,
            editedBestSellingAuthor
          )
          .then(res => {
            vuexContext.commit("editBestSellingAuthor", editedBestSellingAuthor);
          })
          .catch(e => console.log(e));
      },
      setBestSellingAuthors(vuexContext, bestSellingAuthors) {
        vuexContext.commit("setBestSellingAuthors", bestSellingAuthors);
      },

      setBooksCount(vuexContext, booksCount) {
        vuexContext.commit("setBooksCount", booksCount);
      },

      setMembersCount(vuexContext, membersCount) {
        vuexContext.commit("setMembersCount", membersCount);
      },

      setLibrariesCount(vuexContext, librariesCount) {
        vuexContext.commit("setLibrariesCount", librariesCount);
      },

      memberLogin(vuexContext, data) {
        return this.$axios
          .$post(
              "http://localhost:8000/login_check", {
              username: data.email,
              password: data.password,
              returnSecureToken: true
            }
          )
          .then(result => {
            vuexContext.commit("setToken", result.token);
            localStorage.setItem("token", result.token);
            Cookie.set("jwt", result.token);
            return this.$axios.$get('http://localhost:3000/api/member/current', {'token': result.token})
          })
          .catch(e => console.log(e));
      },

      memberSubscribe(vuexContext, data) {
        return this.$axios
          .$post(
              "http://localhost:8000/api/member/subscribe", {
              firstName: data.firstName,
              lastName: data.lastName,
              username: data.email,
              password: data.password
            }
          )
          .then(result => {
            alert(result);
            vuexContext.commit("setToken", result.token);
            localStorage.setItem("token", result.token);
            Cookie.set("jwt", result.token);
            return this.$axios.$post('http://localhost:3000/api/track-data', {data: 'Authenticated!'})
          })
          .catch(e => console.log(e));
      },
      initAuth(vuexContext, req) {
        let token;
        let expirationDate;
        if (req) {
          if (!req.headers.cookie) {
            return;
          }
          const jwtCookie = req.headers.cookie
            .split(";")
            .find(c => c.trim().startsWith("jwt="));
          if (!jwtCookie) {
            return;
          }
          token = jwtCookie.split("=")[1];
          expirationDate = req.headers.cookie
            .split(";")
            .find(c => c.trim().startsWith("expirationDate="))
            .split("=")[1];
        } else if (process.client) {
          token = localStorage.getItem("token");
          expirationDate = localStorage.getItem("tokenExpiration");
        }
        if (new Date().getTime() > +expirationDate || !token) {
          console.log("No token or invalid token");
          vuexContext.dispatch("logout");
          return;
        }
        vuexContext.commit("setToken", token);
      },
      logout(vuexContext) {
        vuexContext.commit("clearToken");
        Cookie.remove("jwt");
        Cookie.remove("expirationDate");
        if (process.client) {
          localStorage.removeItem("token");
          localStorage.removeItem("tokenExpiration");
        }
      }
    },

    getters: {
      loadedBooks(state) {
        return state.loadedBooks;
      },

      loadedBestSellingBooks(state) {
        return state.loadedBestSellingBooks;
      },

      loadedFeaturedBook(state) {
        return state.loadedFeaturedBook;
      },

      loadedNewReleaseBooks(state) {
        return state.loadedNewReleaseBooks;
      },

      loadedCollectionCounts(state) {
        return state.loadedCollectionCounts;
      },

      loadedPickedByAuthorBooks(state) {
        return state.loadedPickedByAuthorBooks;
      },

      loadedTestimonials(state) {
        return state.loadedTestimonials;
      },

      loadedMostPopularAuthors(state) {
        return state.loadedMostPopularAuthors;
      },

      loadedCallToAction(state) {
        return state.loadedCallToAction;
      },

      loadedLatestPosts(state) {
        return state.loadedLatestPosts;
      },

      loadedBestSellingAuthors(state) {
        return state.loadedBestSellingAuthors;
      },

      loadedCategories(state) {
        return state.loadedCategories;
      },

      loadedBooksCount(state) {
        return state.loadedBooksCount;
      },

      loadedMembersCount(state) {
        return state.loadedMembersCount;
      },

      loadedLibrariesCount(state) {
        return state.loadedLibrariesCount;
      },

      isAuthenticated(state) {
        return state.token != null;
      }
    }
  });
};

export default createStore;
