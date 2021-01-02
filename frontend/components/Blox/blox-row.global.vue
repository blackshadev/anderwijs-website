<template>
    <div
        :class="{
            'c-blox-row': true,
            '--horizontal': isHorizontal,
            '--vertical': isVertical,
        }"
    >
        <h2 v-if="title">{{ title }}</h2>
        <div :class="['c-blox-row__items', itemsClass]">
            <div
                class="c-blox-row__items__item"
                v-for="item in items"
                :key="item.id"
            >
                <blox-item :type="item.type" :data="item"></blox-item>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.c-blox-row {
    @apply mt-3;
    @apply w-full;

    &__items {
        @apply flex flex-col content-between flex-wrap;
        @apply w-full;

        &__item {
            @apply flex-grow flex-shrink;
            @apply p-2;
        }

        &.--items-1 &__item {
            @apply w-full;
        }

        &.--items-2 &__item {
            @apply w-1/2;
        }

        &.--items-3 &__item {
            @apply w-1/3;
        }

        &.--items-4 &__item {
            @apply w-1/4;
        }

        &.--items-5 &__item {
            @apply w-1/5;
        }
    }

    &.--horizontal &__items {
        @apply flex-row;
    }
}
</style>

<script>
export default {
    computed: {
        itemsClass() {
            return '--items-' + Math.min(this.items.length, 5);
        },
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
