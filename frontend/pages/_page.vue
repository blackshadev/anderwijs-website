<template>
    <div>
        <h1>{{ page.title }}</h1>
        <div class="c-page-content">
            <blox-item
                v-for="item in page.content"
                :key="item.id"
                :type="item.type"
                :data="item"
            ></blox-item>
        </div>
    </div>
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
