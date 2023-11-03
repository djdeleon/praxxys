import { createStore } from "vuex";
import axiosClient from '../axios';

const store = createStore({
  state: {
    user: {
      data: JSON.parse(sessionStorage.getItem('USER')) || {},
      token: sessionStorage.getItem('TOKEN') || null
    },
    products: [],
    product: {},
    categories: [],
  },
  getters: {
    getUsers(state) {
      return state.products;
    },
    getUser(state) {
      return state.user;
    },
  },
  actions: {
    async register({ commit }, user) {
      return await axiosClient.post('/register', user)
        .then(({data}) => {
          commit('setUser', data);
          return data;
        })
    },
    async login({ commit }, user) {
      return await axiosClient.post('/login', user)
        .then(({data}) => {
          commit('setUser', data);
          return data;
        })
    },
    async logout({commit}) {
      return await axiosClient.post('/logout')
        .then(response => {
          commit('logout');
          sessionStorage.clear();
          return response;
        })
    },
    async products({commit}) {
      return await axiosClient.get('/products')
        .then(({data}) => {
          commit('setProducts', data.data);
        });
    },
    async product({commit}, id) {
      return await axiosClient.get(`/products/edit/${id}`)
        .then(({data}) => {
          commit('setProduct', data.data);
        });
    },
    async categories({commit}) {
      return await axiosClient.get('/categories')
        .then(({data}) => {
          commit('setCategories', data);
        });
    },
    async searchProduct({commit}, filters) {

      return await axiosClient.get(`/products/?search=${filters.search}&category=${filters.category}&${filters.link}`)
        .then(({data}) => {
          commit('setProducts', data.products);
        })
    },
    async createProduct({commit}, products) {
      return await axiosClient.post('/products/create', products, {
          headers: {
            'content-type': 'multipart/form-data'
          }
        })
        .then(({data}) => {
          commit('updateProducts', data)
        })
    },
    async editProduct({commit}, product) {
      return await axiosClient.put(`/products/${product.id}`, product)
        .then(({data}) => {
          commit('updateProducts', data)
        })
    },
    async deleteProduct({commit}, id) {{
      return await axiosClient.delete(`/products/${id}`)
        .then(() => {
          commit('deleteProducts', id)
        });
    }}
  },
  mutations: {
    logout: (state) => {
      state.user.data = {};
      state.user.token = null;
    },
    setUser: (state, data) => {
      state.user.token = data.token;
      state.user.data = data.user;
      if (data.token && data.user) {
        sessionStorage.setItem('TOKEN', data.token);
        sessionStorage.setItem('USER', JSON.stringify(data.user));
      }
    },
    setProducts: (state, data) => {
      if (data.total === 0) {
        return state.products = []
      }

      return state.products = data;
    },
    setProduct: (state, data) => {
      state.product = data;
    },
    setCategories: (state, data) => {
      state.categories = data;
    },
    updateProducts: (state, data) => {
      state.products = [...state.products.data, data];
    },
    deleteProducts: (state, data) => {
      state.products.data = state.products.data.filter((product) => product.id !== data)
    }
  },
});

export default store;
