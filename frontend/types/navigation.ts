export interface INavigation {
  title: string;
  item: NavigationItem[]
}

type NavigationItem = INavigationSubmenu|INavigationPage|INavigationLink;
export interface INavigationSubmenu {
  type: 'submenu',
  title: string,
  items: NavigationItem[];
}
export interface INavigationPage {
  type: 'page',
  title: string,
  page: string,
}
export interface INavigationLink {
  type: 'link',
  title: string,
  url: string
}
