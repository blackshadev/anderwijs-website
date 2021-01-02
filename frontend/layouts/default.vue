<template>
    <div class="c-main">
        <div class="c-main__header">
            <div class="c-main__header__container container mx-auto">
                <div class="c-main__header__logo">
                    <nuxt-link to="/"
                        ><img src="~/assets/logo.png" alt="Anderwijs"
                    /></nuxt-link>
                </div>
                <div class="c-main__header__navigation">
                    <main-navigation></main-navigation>
                </div>
            </div>
        </div>
        <div class="c-main__container container mx-auto">
            <Nuxt />
        </div>
    </div>
</template>

<style lang="scss">
.c-main {
    &__header {
        @apply border-b-2 border-aw-green;

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

    &__container {
        @apply pt-3;
    }
}

h1 {
    @apply font-bold text-3xl;
}
h2 {
    @apply font-bold text-xl;
}
</style>
