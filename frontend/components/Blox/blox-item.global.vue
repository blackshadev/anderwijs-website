<template>
    <component :is="componentName" :data="data"></component>
</template>
<script>
export default {
    computed: {
        componentName() {
            return 'blox-' + this.type.toLowerCase();
        },
    },
    props: {
        type: {
            type: String,
            required: true,
        },
        data: {
            type: Object,
            required: true,
        },
    },
};
</script>