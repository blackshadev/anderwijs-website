<template>
    <page :title="page.title" :hide-title="!page.showTitle" :items="page.content"></page>
</template>

<script>
import pageProvider from '~/dataproviders/page';

export default {
    async asyncData({ params, $dataprovider }) {
        const page = await $dataprovider.request(pageProvider, params.page);

        return {
            page,
        };
    },
};
</script>
