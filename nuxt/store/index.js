import Vuex from "vuex";
import Cookie from "js-cookie";

const createStore = () => {
  return new Vuex.Store({
    state: {
      loadedCategories: [],
      token: null
    },
    mutations: {
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
      setToken(state, token) {
        state.token = token;
      },
      clearToken(state) {
        state.token = null;
      }
    },
    actions: {
      nuxtServerInit(vuexContext, context) {
        // return context.app.$axios
        return this.$axios
          .$get("/categories")
          .then(data => {
            const categoriesArray = [];
            for (const key in data) {
              categoriesArray.push({ ...data[key], id: key });
            }
            vuexContext.commit("setCategories", categoriesArray);
          })
          .catch(e => context.error(e));
      },
      addCategory(vuexContext, category) {
        const createdCategory = {
          ...category,
          updatedDate: new Date()
        };
        return this.$axios
          .$category(
            "http://54.36.182.3/lms/public/index.php/api/categories",
            createdCategory
          )
          .then(data => {
            vuexContext.commit("addCategory", { ...createdCategory, id: data.name });
          })
          .catch(e => console.log(e));
      },
      editCategory(vuexContext, editedCategory) {
        return this.$axios
          .$put(
            "http://54.36.182.3/lms/public/index.php/api/categories",
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
          .$category(authUrl, {
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
            return this.$axios.$category('http://localhost:3333/api/track-data', {data: 'Authenticated!'})
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
      loadedCategories(state) {
        return state.loadedCategories;
      },
      isAuthenticated(state) {
        return state.token != null;
      }
    }
  });
};

export default createStore;
