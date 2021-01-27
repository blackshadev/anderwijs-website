<template>
    <Timeline
        :id="handle"
        sourceType="profile"
        :options="{ tweetLimit: limit }"
    />
</template>
<script>
import { Timeline } from 'vue-tweet-embed';

export default {
    components: {
        Timeline,
    },
    computed: {
        handle() {
            return this.data.handle;
        },
        limit() {
            return this.data.limit;
        },
    },
    props: {
        data: {
            type: Object,
        },
    },
};
</script>
