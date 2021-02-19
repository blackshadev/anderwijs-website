<template>
    <article class="c-event">
        <!-- <img :src="image" :alt="name" /> -->
        <div class="c-event__content">
            <h1>{{ name }}</h1>
            <dl>
                <dt>Datum</dt>
                <dd>{{ startDate }} t/m {{ endDate }}</dd>

                <dt>Location</dt>
                <dd>
                    {{ location.name }}<br />
                    {{ location.address }}<br />
                    {{ location.zipcode }}<br />
                    {{ location.city }}<br />
                    {{ location.phone }}<br />
                    {{ location.website }}<br />
                </dd>

                <dt v-if="hasPricing">Prijs</dt>
                <dd v-if="hasPricing">
                    {{ pricing }}
                </dd>
            </dl>
            <p class="c-event__description">{{ description }}</p>
        </div>
    </article>
</template>

<script>
import { event as eventProvider } from '~/dataproviders/aas-event';
import dayjs from 'dayjs';

const DATE_FORMAT = 'DD-MM-YYYY HH:mm';

export default {
    async asyncData({ params, $dataprovider }) {
        const event = await $dataprovider.request(eventProvider, params.code);

        return event;
    },
    computed: {
        hasPricing() {
            return this.pricing.type !== 'none';
        },
        startDate() {
            return dayjs(this.dates.start).format(DATE_FORMAT);
        },
        endDate() {
            return dayjs(this.dates.end).format(DATE_FORMAT);
        },
        preparationDate() {
            return this.dates.preparation !== undefined
                ? dayjs(this.dates.preparation).format(DATE_FORMAT)
                : undefined;
        },
    },
};
</script>

<style lang="scss" scoped>
.c-event {
    &__content {
        @apply px-2;

        @screen sm {
            @apply px-0;
        }
    }
    img {
        @apply w-full;
        @apply mb-5;
    }

    h1 {
        @apply mb-2;
    }

    &__description {
        @apply whitespace-pre-wrap;
    }

    dl {
        @apply grid grid-cols-6 gap-5;

        dt {
            @apply font-bold;
            @apply col-start-1 col-end-3;
        }
        dd {
            @apply col-start-3 col-end-7;
        }
    }
}
</style>
