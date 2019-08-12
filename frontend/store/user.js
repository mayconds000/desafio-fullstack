export const state = () => ({
  list: [],
  pagination: {},
  user: null
})

export const getters = {
  list (state) {
    const list = state.list.map(item => item)
    list.sort((item1, item2) => {
      const date1 = new Date(item1.updated_at)
      const date2 = new Date(item2.updated_at)
      return date2 - date1
    })
    return list
  },
  user (state) {
    return state.user
  },
  pagination (state) {
    return state.pagination
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
  },
  SET_PAGINATION (state, pagination) {
    state.pagination = pagination
  }
}
