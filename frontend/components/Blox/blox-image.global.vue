<template>
    <img :src="url" :alt="title" />
</template>

<script>
export default {
    computed: {
        url() {
            return this.data.url;
        },
        title() {
            return this.data.title;
        },
    },
    props: {
        data: {
            type: Object,
        },
    },
};
</script>