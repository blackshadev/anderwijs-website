import { AxiosInstance, AxiosResponse } from "axios";
import { IPageIndex, IPageIndexEntry } from "~/types/pages";
import { ICraftElements } from "~/types/craft";
import { Env } from "~/types/env";

export default async function pageIndex(axios: AxiosInstance, env: Env): Promise<IPageIndex> {
    const { data } = await axios.get<void, AxiosResponse<ICraftElements<IPageIndexEntry>>>(`${env.CMS_URL}/pages.json`);
    return data.data;
}