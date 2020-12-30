import {Env} from "~/types/env";
import {NuxtAxiosInstance} from "@nuxtjs/axios";
import {Commit} from "vuex"
import {AxiosResponse} from "axios"
import {INavigation} from "~/types/navigation";
import {ICraftElements} from "~/types/craft";

type ApiResponse = ICraftElements<INavigation>;
export default async function({ commit }: { commit: Commit }, { env, $axios }: { env: Env, $axios: NuxtAxiosInstance }) {
  const content = await $axios.get<void, AxiosResponse<ApiResponse>>(`${env.CMS_URL}/navigation.json`);
  console.log(JSON.stringify(content.data.data[0].item, null, 4));
  commit('navigation/set', content.data.data[0]);
}
