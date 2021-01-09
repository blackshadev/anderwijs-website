<template>
    <li
        :class="{
            'c-navigation-item': true,
            '-main': isMain,
            '-partial-active': isPartialActive,
        }"
    >
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
            <nuxt-link
                class="c-navigation-item__page-link"
                :to="navItem.page"
                :aria-current="isActive ? 'page' : false"
                @focus.native="focusMenuItem(true)"
                @blur.native="focusMenuItem(false)"
                >{{ navItem.title }}</nuxt-link
            >
        </template>
        <template v-if="navItem.type === 'externalLink'">
            <a
                target="_blank"
                :href="navItem.href"
                @focus.native="focusMenuItem(true)"
                @blur.native="focusMenuItem(false)"
                >{{ navItem.title }}</a
            >
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
        activePage() {
            return this.activeRoute.params?.page;
        },
        isActive() {
            return this.navItem.page === this.activePage;
        },
        isPartialActive() {
            const activePage = this.activePage;
            function hasSubmenuItemWhichIsActive(navItem) {
                if (
                    navItem.type === 'pageLink' &&
                    navItem.page === activePage
                ) {
                    return true;
                }
                if (navItem.type !== 'submenu') {
                    return false;
                }

                for (const item of navItem.items) {
                    if (hasSubmenuItemWhichIsActive(item)) {
                        return true;
                    }
                }

                return false;
            }

            return hasSubmenuItemWhichIsActive(this.navItem);
        },
    },
    methods: {
        focusMenuItem(focus) {
            this.$el.parentElement.classList.toggle('focus', focus);
        },
    },
};
</script>

<style lang="scss">
.c-navigation-item {
    @mixin active-link {
        @apply border-b-2 border-aw-green;
    }

    &.-main.-partial-active {
        @apply border-t-2 border-aw-green;
    }

    a {
        @apply inline-block;
        @apply w-full;
        @apply py-2 px-4;
        @apply cursor-pointer;
        @apply border-b-2 border-transparent;

        &.-active {
            @include active-link;
        }
    }

    &:not(.-main).-partial-active a {
        @include active-link;
    }
    &:not(.-main) a:hover {
        @include active-link;
    }

    &__submenu {
        @apply sr-only;
        @apply shadow-lg;
    }

    &__submenu.focus,
    &:hover &__submenu {
        @apply not-sr-only absolute bg-white border border-t-0 border-gray-300;
    }
}
</style>
