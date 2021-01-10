<template>
    <div class="c-call-to-action">
        <img class="c-call-to-action__image" :src="image" alt="Call to action" />
        <div class="c-call-to-action__content">
            <div class="c-call-to-action__text">
                <h2 class="c-call-to-action__title">{{ title }}</h2>
                <p class="c-call-to-action__sub-title" v-if="subTitle" v-html="subTitle"></p>
            </div>
            <div class="c-call-to-action__buttons">
                <NuxtLink
                    class="c-call-to-action__button"
                    v-for="(button, index) in buttons"
                    :key="index"
                    :to="button.page"
                >{{button.title}}</NuxtLink>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        title() {
            return this.data.title;
        },
        subTitle() {
            return this.data.subTitle;
        },
        image() {
            return this.data.image;
        },
        imageUrl() {
            return `url(${this.image})`;
        },
        hasButtons() {
            return this.data.buttons.length > 0;
        },
        buttons() {
            return this.data.buttons;
        },
        imageRatio() {
            console.log(this.data);
            return `${Math.round(this.data.imageDimensionRatio * 100)}%`;
        }
    },
    props: {
        data: {
            type: Object,
        },
    },
};
</script>

<style lang="scss" scoped>
.c-call-to-action {
    @apply relative;

    &__image {
        @apply w-full;
    }

    &__content {
        @apply absolute top-0 left-0 p-10 flex w-full h-full items-center;
    }

    &__text {
        @apply flex-1;
    }

    &__title {
        @apply text-4xl;
    }
    &__sub-title {
        @apply text-lg;
    }

    &__buttons {
        @apply flex flex-col flex-grow-0;
    }
    &__button {
        @apply bg-aw-green;
        @apply rounded;
        @apply p-2 m-1;
    }
}
</style>
