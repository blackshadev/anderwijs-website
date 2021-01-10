<template>
    <component :is="componentName" :data="data"></component>
</template>
<script>
export default {
    computed: {
        componentName() {
            const type = this.type[0].toLocaleLowerCase() + this.type.substr(1);
            return 'blox-' + type.replace(/[A-Z]/g, letter => `-${letter.toLowerCase()}`);
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
