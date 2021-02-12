<template>
    <article class="c-event">
        <img :src="image" :alt="title" />
        <div class="c-event__content">
            <h1>{{ title }}</h1>
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
                    {{ location.site }}<br />
                </dd>

                <dt v-if="price">Prijs</dt>
                <dd v-if="price">
                    {{ price }}
                </dd>
            </dl>
            <p class="c-event__description">{{ description }}</p>
        </div>
    </article>
</template>

<script>
import { event as eventProvider } from '~/dataproviders/aas-event';

export default {
    async asyncData({ params, $dataprovider }) {
        const event = await $dataprovider.request(eventProvider, params.code);

        return {
            title: event.naam,
            image: 'https://www.anderwijs.nl/wp-content/uploads/frontpage-images-original/bijles-1.png',
            description: event.beschrijving,
            preparationDate: `${event.datum_voordag} ${event.tijd_voordag}`,
            startDate: `${event.datum_start} ${event.tijd_start}`,
            endDate: `${event.datum_eind} ${event.tijd_eind}`,
            price: event.prijs,
            location: {
                name: event.kamphuis_naam,
                address: event.kamphuis_adres,
                zipcode: event.kamphuis_postcode,
                city: event.kamphuis_plaats,
                phone: event.kamphuis_telefoon,
                site: event.kamphuis_website
            }
        };
    },
}
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
