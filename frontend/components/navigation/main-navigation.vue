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
import { mapGetters } from 'vuex'
import navigationItem from '@/components/navigation/navigation-item'
export default {
    components: { navigationItem },
    computed: {
        ...mapGetters({
            navigation: 'navigation/mainItems',
        }),
    },
}
</script>

<style scoped lang="scss">
ul {
    @apply list-none flex w-full p-4;
    @apply border-b-2;
}
</style>
