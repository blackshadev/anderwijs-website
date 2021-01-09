<template>
    <div class="c-main">
        <a class="sr-only focus:not-sr-only" href="#content">Naar content</a>
        <header class="c-main__header">
            <main-navigation></main-navigation>
        </header>
        <article class="c-main__content">
            <div class="container mx-auto" id="content">
                <Nuxt />
            </div>
        </article>
        <footer class="c-main__footer">
            <div class="c-main__footer__container container mx-auto">
                <div class="c-main-footer__social">
                    <p>Hoe sjaal? Social!</p>
                    <social-icons></social-icons>
                </div>
            </div>
        </footer>
    </div>
</template>

<style lang="scss">
#__nuxt {
    @apply min-h-screen;
}
.c-main {
    @apply min-h-screen;
    @apply flex flex-col;

    &__header {
        @apply border-b-2 border-aw-green;
        @apply flex-shrink-0;
        @apply mb-3;

        &__container {
            @apply flex;
        }

        &__logo img {
            @apply self-center;
            @apply m-4 ml-0;
            @apply h-20;
        }

        &__navigation {
            @apply ml-10;
            @apply self-end;
            @apply pb-2;
        }
    }

    &__content {
        @apply flex-grow flex-shrink-0;
        @apply mb-10;
    }

    &__footer {
        p {
            @apply mb-2;
        }
        @apply flex-shrink-0;
        @apply w-full;
        @apply border-t-2 border-aw-green;
        @apply self-end justify-self-end;
        @apply text-sm;
        @apply py-5;
    }
}
body {
    @apply min-h-screen;
}
h1 {
    @apply font-bold text-3xl;
}
h2 {
    @apply font-bold text-xl;
}
</style>
<script>
import SocialIcons from '@/components/footer/social-icons';
export default {
    components: { SocialIcons },
};
</script>
