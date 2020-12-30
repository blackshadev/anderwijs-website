<template>
    <li :class="{ 'c-navigation-item': true, '-main': isMain }">
        <template v-if="navItem.type === 'submenu'">
            <a>{{ navItem.title }}</a>
            <ul>
                <navigation-item
                    v-for="subItem in navItem.items"
                    :key="subItem.id"
                    :nav-item="subItem"
                ></navigation-item>
            </ul>
        </template>
        <template v-if="navItem.type === 'pageLink'">
            <nuxt-link :to="navItem.page">{{ navItem.title }}</nuxt-link>
        </template>
        <template v-if="navItem.type === 'externalLink'">
            <a :href="navItem.href">{{ navItem.title }}</a>
        </template>
    </li>
</template>
<script>
export default {
    name: 'navigation-item',
    props: {
        navItem: {
            type: Object,
            required: true,
        },
        isMain: {
            type: Boolean,
            default: false,
        },
    },
};
</script>

<style lang="scss">
.c-navigation-item {
    @apply p-2;

    a {
        @apply cursor-pointer;
    }

    ul {
        @apply absolute hidden;
    }

    &:hover ul {
        @apply block bg-white border border-t-0 border-gray-300;
    }
}
</style>
