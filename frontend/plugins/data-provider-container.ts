import { Inject } from "@nuxt/types/app";
import { NuxtAxiosInstance } from "@nuxtjs/axios";
import { DataProviderContainer } from "~/dataproviders/container";
import { Env } from "~/types/env";

export default ({ $axios, env }: { $axios: NuxtAxiosInstance, env: Env }, inject: Inject) => {
    inject('dataprovider', new DataProviderContainer($axios, env));
};