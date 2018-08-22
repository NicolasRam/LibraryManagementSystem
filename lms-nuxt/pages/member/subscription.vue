<template>
  <div class="tg-sectionspace tg-haslayout">
    <div class="container">
      <div class="row">
        <div class="tg-404error">
          <div class="col-xs-12 col-sm-12 col-md-8 col-md-push-2 col-lg-6">
            <form class="tg-formtheme tg-formsearch" @submit.prevent="onSubmit">
                <div class="form-group">
                  <fieldset>
                    <input type="text"  v-model="firstName" class="form-control" placeholder="Prénom*">
                    <button type="button"><i class="icon-user"></i></button>
                  </fieldset>

                  <fieldset>
                    <input type="text" v-model="lastName" class="form-control" placeholder="Nom*">
                    <button type="button"><i class="icon-user"></i></button>
                  </fieldset>
                </div>

                <div class="form-group">
                  <fieldset>
                    <input type="email" v-model="email" class="form-control" placeholder="Email*" style="text-transform: unset !important;">

                    <button type="button"><i class="icon-envelope"></i></button>
                  </fieldset>

                  <fieldset>
                    <input type="tel" v-model="phone" class="form-control" placeholder="Téléphone*" style="text-transform: unset !important;">

                    <button type="button"><i class="icon-phone"></i></button>
                  </fieldset>
                </div>

                <div class="form-group">
                  <fieldset class="col-md-6">
                    <input type="password" v-model="password" class="form-control" placeholder="Mot de passe*" style="text-transform: unset !important;">

                    <button type="button"><i class="icon-lock"></i></button>
                  </fieldset>

                  <fieldset class="col-md-6">
                    <input type="password" v-model="passwordConfirm" class="form-control" placeholder="Confirmer mot de passe*" style="text-transform: unset !important;">

                    <button type="button"><i class="icon-lock"></i></button>
                  </fieldset>
                </div>

               <div class="form-group">
                  <button type="submit" class="tg-btn tg-active" :disabled='!isComplete' v-if="isComplete">Souscrire</button>
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
    name: "SubscriptionPage",

    layout: "login",

    data() {
      return {
        firstName: "",
        lastName: "",
        email: "",
        phone: "",
        password: "",
        passwordConfirm: ""
      };
    },

    computed: {
      isComplete () {
        return this.firstName && this.lastName && this.email && this.phone && this.password && this.passwordConfirm && this.password === this.passwordConfirm;
      }
    },

    methods: {
      onSubmit() {
        alert( this.firstName );

        if(
          this.firstName !== ""
          && this.lastName !== ""
          && this.phone !== ""
          && this.email !== ""
          && this.password !== ""
          && this.password === this.passwordConfirm
        ) {
          alert( "After" );

          this.$store.dispatch("memberSubscribe", {
            email: this.email,
            password: this.password
          })
            .then(() => {
              this.$router.push('/');
            });
        } else {
          alert( "Le formulaire est incorrect" )
        }
      }
    }
  }
</script>
