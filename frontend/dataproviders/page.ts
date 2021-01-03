import { AxiosInstance, AxiosResponse } from "axios";
import { ICraftOneElement } from "~/types/craft";
import { Env } from "~/types/env";
import { IPage } from "~/types/page";

export default async function page(axios: AxiosInstance, env: Env, slug: string): Promise<IPage> {
    const { data } = await axios.get<void, AxiosResponse<ICraftOneElement<IPage>>>(`${env.CMS_URL}/pages/${slug}.json`);
    return data;
}