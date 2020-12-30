<template>
    <ul>
        <menu
            v-for="navItem in navigation"
            :navItem="navItem"
            :key="navItem.id"
            :isMain="true"
        ></menu>
    </ul>
</template>

<script>
import { mapGetters } from 'vuex'
import menu from '@/components/navigation/menu'
export default {
    components: { menu },
    computed: {
        ...mapGetters({
            navigation: 'navigation/mainItems',
        }),
    },
}
</script>

<style scoped lang="scss">
ul {
    @apply list-none flex;
}
</style>
