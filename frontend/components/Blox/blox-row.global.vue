<template>
    <div
        :class="{
            'c-blox-row': true,
            '--horizontal': isHorizontal,
            '--vertical': isVertical,
        }"
    >
        <h2 v-if="title">{{ title }}</h2>
        <div :class="['c-blox-row__group', itemsClass]">
            <div
                class="c-blox-row__cell"
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
    @apply mb-3;
    @apply w-full;

    &__group {

        @apply flex flex-col content-between flex-wrap;
        @apply w-full;

    }
    &__cell {
        @apply flex-grow flex-shrink;
        @apply p-2;
        @apply w-full;
    }

    $root: &;

    &.--horizontal &__group {
        @apply flex-row;

        &.--c-1 #{$root}__cell {
            @apply w-full;
        }

        @for $i from 2 through 5 {
            &.--c-#{$i} #{$root}__cell {
                @apply w-1/#{$i};
            }
        }

        @supports (display: grid) {
            @apply grid gap-0;

            &__cell {
                @apply p-0;
            }

            @for $i from 1 through 5 {
                &.--c-#{$i} {
                    @apply grid-cols-#{$i};

                    #{$root}__cell {
                        @apply w-full;
                    }
                }
            }
        }
    }
}
</style>

<script>
export default {
    computed: {
        itemsClass() {
            return '--c-' + Math.min(this.items.length, 5);
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
