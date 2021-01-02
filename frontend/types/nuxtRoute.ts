export interface IRoute {
    name: string;
    meta: any;
    path: string;
    hash: string;
    query: any;
    params: { [name: string]: string };
    fullPath: string;
}