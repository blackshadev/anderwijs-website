<template>
  <div>test</div>
</template>

<script>

  export default {
    async asyncData({ env, $axios, params }) {
      console.log(env.CMS_URL);
      const content = await $axios.get(`${env.CMS_URL}/navigation.json`);
      console.log(content.data);
      return {
        content,
        params,
      }
    },
  }
</script>
