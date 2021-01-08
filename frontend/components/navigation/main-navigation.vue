<template>
    <div class="c-main-navigation container mx-auto">
        <div class="c-main-navigation__logo">
            <nuxt-link to="/"
                ><img src="~/assets/logo.png" alt="Anderwijs"
            /></nuxt-link>
        </div>
        <div class="c-main-navigation__navigation">
            <ul>
                <navigation-item
                    v-for="navItem in navigation"
                    :navItem="navItem"
                    :key="navItem.id"
                    :isMain="true"
                ></navigation-item>
            </ul>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { mapMutations } from 'vuex';
import navigationItem from '@/components/navigation/navigation-item';
export default {
    watch: {
        $route() {
            this.setRoute(this.$route);
        },
    },
    components: { navigationItem },
    computed: {
        ...mapGetters({
            navigation: 'navigation/mainItems',
        }),
    },
    methods: {
        ...mapMutations({
            setRoute: 'navigation/setRoute',
        }),
    },
};
</script>

<style scoped lang="scss">
.c-main-navigation {
    @apply flex flex-wrap;

    div {
        @apply w-full;
    }

    &__logo {
        @apply flex-shrink-0;
        @apply text-center;
        @apply flex;
        @apply justify-center;

        img {
            @apply m-4 ml-0;
            @apply h-20;
        }
    }

    &__navigation {
        @apply self-end;
        @apply flex;
        @apply justify-center;
        @apply pb-2;
    }

    ul {
        @apply list-none flex;
    }

    @screen md {
        div {
            @apply w-auto;
        }

        &__navigation {
            @apply ml-20;
        }
    }
}
</style>
