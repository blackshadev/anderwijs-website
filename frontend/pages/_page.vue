<template>
    <page :title="page.title" :items="page.content"></page>
</template>

<script>
export default {
    async asyncData({ params, env, $axios }) {
        const response = await $axios.get(
            `${env.CMS_URL}/pages/${params.page}.json`
        );

        const page = response.data;
        return {
            page,
        };
    },
};
</script>
