export interface ICraftElements<T> {
  data: T[],
  meta: {
    pagination: {
      total: number,
      count: number,
      per_page: number,
      current_page: number,
      total_pages: number,
      links: {}
    }
  }
}
