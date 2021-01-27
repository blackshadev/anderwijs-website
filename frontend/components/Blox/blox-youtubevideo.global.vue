<template>
    <div class="c-blox-youtube-video">
        <iframe
            :src="videoUrl"
            allowfullscreen
        ></iframe>
    </div>
</template>

<script>
    export default {
         computed: {
            videoUrl() {
                return `https://www.youtube-nocookie.com/embed/${this.videoId}`
            },
            videoId() {
                return this.data.videoId;
            }
        },
        props: {
            data: {
                type: Object,
                required: true,
            },
        },
    }
</script>

<style lang="scss" scoped>
.c-blox-youtube-video {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%;

    iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
}
</style>
