export const state = () => ({
  list: [],
  user: null
})

export const getters = {
  list (state) {
    return state.list
  },
  user (state) {
    return state.user
  }
}

//mutations
export const mutations = {
  ADD (state, user) {
    state.list.push(user)
  },
  UPDATE (state, user) {
    state.list = state.list.map(item => {
      if (item.id === user.id) {
        return user
      }
      return item
    })
  },
  REMOVE (state, userId) {
    state.list = state.list.filter(function (item) {
      return item.id != userId
    })
  },
  SET (state, user) {
    state.user = user
  },
  CLEAR (state) {
    state.user = null
  },
  SET_LIST (state, users) {
    state.list = users
  }
}