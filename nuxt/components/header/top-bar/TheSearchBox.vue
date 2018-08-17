<template>
  <div class="tg-searchbox">
    <form class="tg-formtheme tg-formsearch">
      <fieldset>
        <input type="text" name="search" class="typeahead form-control" placeholder="Search by title, author, keyword, ISBN...">
        <button type="submit"><i class="icon-magnifier"></i></button>
      </fieldset>
      <a href="javascript:void(0);">+  Advanced Search</a>
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
