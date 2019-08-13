export const getters = {
  authenticated (state) {
    return state.loggedIn
  },
  authuser (state) {
    return state.user
  }
}