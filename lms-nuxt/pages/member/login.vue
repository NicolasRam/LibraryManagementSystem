<template>
  <div class="tg-sectionspace tg-haslayout">
    <div class="container">
      <div class="row">
        <div class="tg-404error">
          <div class="col-xs-12 col-sm-12 col-md-8 col-md-push-2 col-lg-6 col-lg-push-3">
            <form class="tg-formtheme tg-formsearch" @submit.prevent="onSubmit">
              <fieldset>
                <input
                  type="email"
                  class="typeahead form-control"
                  placeholder="Identifiant"
                  v-model="email"
                  style="text-transform: unset !important;"
                >

                <button type="submit"><i class="icon-user"></i></button>
              </fieldset>

              <fieldset>
                <input
                  type="password"
                  name="search"
                  class="typeahead form-control"
                  placeholder="Mot de passe"
                  v-model="password"
                  style="text-transform: unset !important;"
                >

                <button type="submit"><i class="icon-lock"></i></button>
              </fieldset>

              <div class="tg-gobackhome">
                <span>Vous n'etes pas encore inscrit </span>

                <nuxt-link to="/member/subscription"> Inscrivez-vous</nuxt-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "LoginPage",
    layout: "login",
    data() {
      return {
        email: "",
        password: ""
      };
    },

    methods: {
      onSubmit() {
        this.$store.dispatch("memberLogin", {
          isLogin: this.isLogin,
          email: this.email,
          password: this.password
        })
          .then(() => {
            this.$router.push('/');
          });
      }
    }
  }
</script>
