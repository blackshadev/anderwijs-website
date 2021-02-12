import {pagesAsURL} from "./dataproviders/page-index";
import {eventsAsUrl} from "./dataproviders/aas-event";
import {DataProviderContainer} from "./dataproviders/container";
import axios from 'axios';

const dataProviderContainer = new DataProviderContainer(axios, process.env);

export default {
    // Target (https://go.nuxtjs.dev/config-target)
    target: 'static',
    env: {
        CMS_URL: process.env.CMS_URL || 'https://cms.anderwijs.nl/api',
        AAS_URL: process.env.AAS_URL || 'https://aas.anderwijs.nl',

    },
    router: {
        linkActiveClass: '-active',
        linkExactActiveClass: null,
    },

    // Global page headers (https://go.nuxtjs.dev/config-head)
    head: {
        title: 'anderwijs-website',
        meta: [
            {charset: 'utf-8'},
            {name: 'viewport', content: 'width=device-width, initial-scale=1'},
            {hid: 'description', name: 'description', content: ''}
        ],
        link: [
            {rel: 'icon', type: 'image/x-icon', href: '/favicon.ico'}
        ]
    },

    // Global CSS (https://go.nuxtjs.dev/config-css)
    css: [
        "@/assets/css/fonts.css"
    ],

    // Plugins to run before rendering page (https://go.nuxtjs.dev/config-plugins)
    plugins: [
        '~/plugins/data-provider-container.ts'
    ],

    // Auto import components (https://go.nuxtjs.dev/config-components)
    components: true,

    // Modules for dev and build (recommended) (https://go.nuxtjs.dev/config-modules)
    buildModules: [
        '@nuxtjs/dotenv',
        // https://go.nuxtjs.dev/typescript
        '@nuxt/typescript-build',
        // https://go.nuxtjs.dev/stylelint
        '@nuxtjs/stylelint-module',
        // https://go.nuxtjs.dev/tailwindcss
        '@nuxtjs/tailwindcss',

        '@nuxtjs/global-components',

        '@nuxtjs/fontawesome',
    ],

    // Modules (https://go.nuxtjs.dev/config-modules)
    modules: [
        // https://go.nuxtjs.dev/axios
        '@nuxtjs/axios',
        '@nuxtjs/sitemap'
    ],

    // Axios module configuration (https://go.nuxtjs.dev/config-axios)
    axios: {},

    sitemap: {
        hostname: 'https://anderwijs.nl',
        async routes() {
            return [
                ...await dataProviderContainer.request(pagesAsURL),
                ...await dataProviderContainer.request(eventsAsUrl),
            ];
        }
    },
    generate: {
        async routes() {
            return [
                ...await dataProviderContainer.request(pagesAsURL),
                ...await dataProviderContainer.request(eventsAsUrl),
            ];
        }
    },
    fontawesome: {
        icons: {
            brands: ['faYoutube', 'faFacebook', 'faTwitter', 'faInstagram']
        },
    },

    // Build Configuration (https://go.nuxtjs.dev/config-build)
    build: {}
}
