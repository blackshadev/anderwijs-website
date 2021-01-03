export type IBloxItem = IBloxImage | IBloxRichText | IBloxRow;

export interface IBloxImage {
    id: number;
    type: 'image'
    title: string;
    url: string;
}
export interface IBloxRichText {
    id: number;
    type: 'richtext';
    body: string;
}
export interface IBloxRow {
    id: number;
    type: 'row';
    direction: 'horizontal'|'vertical';
    title?: string;
}