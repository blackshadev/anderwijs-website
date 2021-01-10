<template>
    <div class="c-blox-richtext" v-html="body"></div>
</template>

<script>
export default {
    computed: {
        body() {
            return this.data.body;
        },
    },
    props: {
        data: {
            type: Object,
        },
    },
};
</script>