export const state = () => {
  return {
    navigation: {},
    activeRoute: '/',
  };
}

export const mutations = {
  set(state, nav) {
    state.navigation = nav;
  },
  setRoute(state, route) {
    state.activeRoute = route;
  }
}

export const getters = {
  mainItems(state) {
    return state.navigation.item;
  },
  activeRoute(state) {
    return state.activeRoute;
  }
};
