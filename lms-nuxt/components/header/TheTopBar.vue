<template>
  <div class="tg-topbar">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <ul class="tg-addnav" v-if="false">
            <li>
              <a href="javascript:void(0);">
                <i class="icon-envelope"></i>
                <em>Contact</em>
              </a>
            </li>
            <li>
              <a href="javascript:void(0);">
                <i class="icon-question-circle"></i>
                <em>Help</em>
              </a>
            </li>
          </ul>

          <div class="dropdown tg-themedropdown tg-currencydropdown" v-if="false">
            <a href="javascript:void(0);" id="tg-currenty" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-earth"></i>
              <span>Currency</span>
            </a>
            <ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-currenty">
              <li>
                <a href="javascript:void(0);">
                  <i>£</i>
                  <span>British Pound</span>
                </a>
              </li>
              <li>
                <a href="javascript:void(0);">
                  <i>$</i>
                  <span>Us Dollar</span>
                </a>
              </li>
              <li>
                <a href="javascript:void(0);">
                  <i>€</i>
                  <span>Euro</span>
                </a>
              </li>
            </ul>
          </div>

          <div class="tg-userlogin" v-if="member !== null">
            <figure>
              <nuxt-link to="/member" v-if="member.hasOwnProperty(image) && member.image.hasOwnProperty('path')">
                <img :src="member.image.path" alt="image description">
              </nuxt-link>
              <nuxt-link to="/member" v-else>
                <img src="http://exprostudio.com/html/book_library/images/users/img-01.jpg" alt="image description">
              </nuxt-link>
            </figure>

            <span>Salut, {{member.firstName}}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      name: "TheTopBar",

      props: {
        member: {
          type: Object,
          default: null
        },
      },
    }
</script>
