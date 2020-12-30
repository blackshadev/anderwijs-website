<template>
    <div
        :class="{
            'c-blox-row': true,
            '--horizontal': isHorizontal,
            '--vertical': isVertical,
        }"
    >
        <h2 v-if="title">{{ title }}</h2>
        <div class="c-blox-row__items --items-{{items.length}}">
            <blox-item
                v-for="item in items"
                :key="item.id"
                :type="item.type"
                :data="item"
            ></blox-item>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.c-blox-row {
    @apply mt-3;
    @apply w-full;

    &__items {
        @apply flex flex-col;
        @apply w-full;

        // blox-item {
        //     @apply w-
        // }
    }

    &.--horizontal &__items {
        @apply flex-row;
    }
}
</style>

<script>
export default {
    computed: {
        isHorizontal() {
            return this.data.direction === 'horizontal';
        },
        isVertical() {
            return this.data.direction !== 'horizontal';
        },
        title() {
            return this.data.title;
        },
        items() {
            return this.data.items;
        },
    },
    props: {
        data: {
            type: Object,
            required: true,
        },
    },
};
</script>
