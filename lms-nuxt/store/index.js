import Vuex from "vuex";
import Cookie from "js-cookie";

const createStore = () => {
    return new Vuex.Store({
        state: {
            loadedBooks: [],
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
                        "http://54.36.182.3/lms/public/index.php/api/books?auth=" +
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
                        "http://54.36.182.3/lms/public/index.php/api/books/" +
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

            setBooksCount(vuexContext, booksCount) {
                vuexContext.commit("setBooksCount", booksCount);
            },

            setMembersCount(vuexContext, membersCount) {
                vuexContext.commit("setMembersCount", membersCount);
            },

            setLibrariesCount(vuexContext, librariesCount) {
                vuexContext.commit("setLibrariesCount", librariesCount);
            },

            authenticateUser(vuexContext, authData) {
                let authUrl =
                    "https://www.googleapis.com/identitytoolkit/v3/relyingparty/verifyPassword?key=" +
                    process.env.fbAPIKey;
                if (!authData.isLogin) {
                    authUrl =
                        "https://www.googleapis.com/identitytoolkit/v3/relyingparty/signupNewUser?key=" +
                        process.env.fbAPIKey;
                }
                return this.$axios
                    .$post(authUrl, {
                        email: authData.email,
                        password: authData.password,
                        returnSecureToken: true
                    })
                    .then(result => {
                        vuexContext.commit("setToken", result.idToken);
                        localStorage.setItem("token", result.idToken);
                        localStorage.setItem(
                            "tokenExpiration",
                            new Date().getTime() + Number.parseInt(result.expiresIn) * 1000
                        );
                        Cookie.set("jwt", result.idToken);
                        Cookie.set(
                            "expirationDate",
                            new Date().getTime() + Number.parseInt(result.expiresIn) * 1000
                        );
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
