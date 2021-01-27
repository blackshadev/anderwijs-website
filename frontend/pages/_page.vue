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
    computed: {
        pageTitle() {
            const pageTitle = this.page.pageTitle ?? this.page.title;
            return pageTitle + ' | Anderwijs';
        },
    },
    head() {
        return {
            title: this.pageTitle,
            meta: [
                {
                    hid: 'description',
                    name: 'description',
                    content: this.page.description,
                }
            ]
        };
    },
};
</script>
