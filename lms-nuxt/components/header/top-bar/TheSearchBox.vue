<template>
  <div class="tg-searchbox">
    <form class="tg-formtheme tg-formsearch" v-if="false">
      <fieldset>
        <input type="text" name="search" class="typeahead form-control" placeholder="Chercher un livre par titre, ahteur, mot-clé, ISBN...">

        <button type="submit"><i class="icon-magnifier"></i></button>
      </fieldset>

      <a href="javascript:void(0);" v-if="false">+  Advanced Search</a>
    </form>
  </div>
</template>

<script>
    export default {
        name: "TheSearchBox"
    }
</script>

<style scoped>

</style>
