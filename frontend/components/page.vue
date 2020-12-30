<template>
    <div>
        <h1>{{ title }}</h1>
        <div class="c-page-content">
            <blox-item
                v-for="item in items"
                :key="item.id"
                :type="item.type"
                :data="item"
            ></blox-item>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        items: {
            type: Array,
            required: true,
        },
        title: {
            type: String,
        },
    },
};
</script>
