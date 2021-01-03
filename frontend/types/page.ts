import { IBloxItem } from "./Blox";

export interface IPage {
    title: string;
    slug: string;
    content: IBloxItem[];
}