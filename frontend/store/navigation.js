export const state = () => {
  return {
    navigation: {},
  };
}

export const mutations = {
  set(state, nav) {
    state.navigation = nav;
  }
}

export const getters = {
  mainItems(state) {
    return state.navigation.item;
  }
};
