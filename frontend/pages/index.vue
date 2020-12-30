<template>
  <div>test</div>
</template>

<script>

  export default {
    async asyncData({ env, $axios, $nav}) {
      console.log($nav);
      // console.log(env.CMS_URL);
      // const content = await $axios.get(`${env.CMS_URL}/navigation.json`);
      // console.log(content.data);
      // return {
      //   content: content.data
      // }
    },
  }
</script>
