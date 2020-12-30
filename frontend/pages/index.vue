<template>
    <div>test</div>
</template>

<script>
export default {
    middleware({ redirect }) {
        return redirect('/homepage');
    },
};
</script>
