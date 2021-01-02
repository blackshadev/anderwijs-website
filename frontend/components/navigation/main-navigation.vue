<template>
    <ul>
        <navigation-item
            v-for="navItem in navigation"
            :navItem="navItem"
            :key="navItem.id"
            :isMain="true"
        ></navigation-item>
    </ul>
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
ul {
    @apply list-none flex;
}
</style>
