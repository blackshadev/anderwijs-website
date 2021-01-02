<template>
    <li :class="{ 'c-navigation-item': true, '-main': isMain }">
        <template v-if="navItem.type === 'submenu'">
            <a>{{ navItem.title }}</a>
            <ul class="c-navigation-item__submenu">
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
import { mapGetters } from 'vuex';

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
    computed: {
        ...mapGetters({
            activeRoute: 'navigation/activeRoute',
        }),
    },
};
</script>

<style lang="scss">
.c-navigation-item {
    @apply border-b-2 border-transparent;

    &:not(.-main):hover {
        @apply border-b-2 border-aw-green;
    }

    a {
        @apply inline-block;
        @apply py-2 px-4;
        @apply cursor-pointer;

        &.-active {
            @apply border-b-2 border-aw-green;
        }
    }

    &__submenu {
        @apply absolute hidden;
    }

    &:hover ul {
        @apply block bg-white border border-t-0 border-gray-300;
    }
}
</style>
