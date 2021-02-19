import {AxiosInstance, AxiosResponse} from "axios";
import {Env} from "~/types/env";

export async function allEventsRaw(axios: AxiosInstance, env: Env): Promise<IRawEvent[]> {
    const { data } = await axios.get<void, AxiosResponse<IRawEvent[]>>(`${env.AAS_URL}/api/camp`);
    return data;
}

export async function allEvents(axios: AxiosInstance, env: Env): Promise<IEvent[]> {
    const events = await allEventsRaw(axios, env);
    return events.map(event => {
        return {
            code: event.code,
            dates: {
                preparation: new Date(event.dates.preparation),
                start: new Date(event.dates.start),
                end: new Date(event.dates.end),
            },
            pricing: event.pricing,
            description: event.description,
            location: event.location,
            name: event.name,
        };

    });
}

export async function eventsAsUrl(axios: AxiosInstance, env: Env): Promise<string[]> {
    const data = await allEventsRaw(axios, env);
    return data.map((e) => `/kamp/${e.code}`);
}

export async function event(axios: AxiosInstance, env: Env, code: string): Promise<IEvent|undefined> {
    const data = await allEvents(axios, env);
    return data.filter( (e: IEvent) => e.code === code)[0];
}
