export interface ICraftElements<T> {
  data: T[],
  meta?: ICraftMetadata
}

export type ICraftOneElement<T> = T;

export interface ICraftMetadata {
  pagination: {
    total: number,
    count: number,
    per_page: number,
    current_page: number,
    total_pages: number,
    links: {}
  }
}
