<template>
    <div>
        <main-navigation></main-navigation>
        <div class="c-main-container container mx-auto">
            <Nuxt />
        </div>
    </div>
</template>

<style lang="scss">
.c-main-container {
    @apply pt-3;
}
h1 {
    @apply font-bold text-3xl;
}
h2 {
    @apply font-bold text-xl;
}
</style>