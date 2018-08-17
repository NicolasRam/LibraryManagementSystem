<template>
  <div>
    <ul>
      <li v-for="category in categories" :key="category.id">{{category.name}}</li>
    </ul>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    asyncData(context) {
      return axios
        .get("http://54.36.182.3/lms/public/index.php/api/categories")
        .then( res => {
          return {
            categories: res.data
          }
          }
        )
        .catch(e => context.error(e))
    }
  }
</script>
