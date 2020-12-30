<template>
    <li :class="{ 'c-menu': true, '-main': isMain }">
        <template v-if="navItem.type === 'submenu'">
            <a>{{ navItem.title }}</a>
            <ul>
                <menu
                    v-for="subItem in navItem.items"
                    :key="subItem.id"
                    :nav-item="subItem"
                ></menu>
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
    name: 'menu',
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
}
</script>

<style lang="scss">
.c-menu {
    @apply flex;
}
</style>
