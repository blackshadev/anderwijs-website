import {AxiosInstance, AxiosResponse} from "axios";
import {Env} from "~/types/env";

export async function events(axios: AxiosInstance, env: Env): Promise<IRawEvent[]> {
    const { data } = await axios.get<void, AxiosResponse<IRawEvent[]>>(`${env.AAS_URL}/cal/part`);
    return data;
}

export async function eventsAsUrl(axios: AxiosInstance, env: Env): Promise<string[]> {
    const data = await events(axios, env);
    return data.map((e) => `/kamp/${e.code}`);
}

export async function event(axios: AxiosInstance, env: Env, code: string): Promise<IRawEvent|undefined> {
    const { data } = await axios.get<void, AxiosResponse<IRawEvent[]>>(`${env.AAS_URL}/cal/part`);
    return data.filter(d => d.code === code)[0];
}
