import {Env} from "~/types/env";
import {NuxtAxiosInstance} from "@nuxtjs/axios";
import {Commit} from "vuex"
import {AxiosResponse} from "axios"
import {INavigation} from "~/types/navigation";
import {ICraftElements} from "~/types/craft";
import {IRoute} from "~/types/nuxtRoute";

type ApiResponse = ICraftElements<INavigation>;
export default async function({ commit }: { commit: Commit }, { env, $axios, route }: { env: Env, $axios: NuxtAxiosInstance, route: IRoute }) {
  const naviation = await $axios.get<void, AxiosResponse<ApiResponse>>(`${env.CMS_URL}/navigation.json`);
  commit('navigation/set', naviation.data.data[0]);
  commit('navigation/setRoute', { name: route.name, params: route.params, path: route.path });

  const socials = await $axios.get<void, AxiosResponse<ApiResponse>>(`${env.CMS_URL}/socials.json`);
  commit('social/set', socials.data);
}
