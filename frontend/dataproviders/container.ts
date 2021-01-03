import { AxiosInstance } from "axios";
import { Env } from "~/types/env";
type IProviderFn<TResponse, T extends unknown[]> = (axios: AxiosInstance, env: Env, ...args: T) => TResponse;

export class DataProviderContainer {
    private axios: AxiosInstance;
    private env: Env;
    
    public constructor(axios: AxiosInstance, env: Env) {
        this.axios = axios;
        this.env = env;
    }

    public async request<TResponse, T extends unknown[]>(fn: IProviderFn<TResponse, T>, ...args: T): Promise<TResponse> {
        return await fn(this.axios, this.env, ...args);
    }
}