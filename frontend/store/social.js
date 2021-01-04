export const state = () => {
  return {
    social: {
        youtube: null,
        facebook: null,
        instagram: null,
        twitter: null,
    },
  };
};

export const mutations = {
  set(state, social) {
      state.social.youtube = social?.youtubeUrl;
      state.social.facebook = social?.facebookUrl;
      state.social.instagram = social?.instagramUrl;
      state.social.twitter = social?.twitterUrl;
  },
};

export const getters = {
  youtubeURL(state) {
    return state.social.youtube;
  },
  facebookURL(state) {
    return state.social.facebook;
  },
  instagramURL(state) {
    return state.social.instagram;
  },
  twitterURL(state) {
    return state.social.twitter;
  },
};
