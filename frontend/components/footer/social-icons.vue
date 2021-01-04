<template>
    <div class="c-social-icons">
        <a :href="youtubeURL" v-if="youtubeURL">
            <font-awesome-icon :icon="['fab', 'youtube']" class="c-social-icons__icon -youtube"></font-awesome-icon>
        </a>
        <a :href="facebookURL" v-if="facebookURL">
            <font-awesome-icon :icon="['fab', 'facebook']" class="c-social-icons__icon -facebook"></font-awesome-icon>
        </a>
        <a :href="instagramURL" v-if="instagramURL">
            <font-awesome-icon :icon="['fab', 'instagram']" class="c-social-icons__icon -instagram"></font-awesome-icon>
        </a>
        <a :href="twitterURL" v-if="twitterURL">
            <font-awesome-icon :icon="['fab', 'twitter']" class="c-social-icons__icon -twitter"></font-awesome-icon>
        </a>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
    computed: {
        ...mapGetters('social', ['youtubeURL', 'facebookURL', 'instagramURL', 'twitterURL'])
    }
};
</script>

<style lang="scss" scoped>
.c-social-icons {
    &__icon {
        @apply text-2xl;
    }
}
</style>
