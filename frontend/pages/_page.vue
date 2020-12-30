<template>
    <div>
        <h1>{{ content.title }}</h1>
        {{ content }}
    </div>
</template>

<script>
export default {
    async asyncData({ params, env, $axios }) {
        const response = await $axios.get(
            `${env.CMS_URL}/pages/${params.page}.json`
        );

        const content = response.data;
        return {
            content,
        };
    },
};
</script>
