import Vue from "vue";
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import Cookies from 'js-cookie';
Vue.use(Vuex)


const store = new Vuex.Store({
    plugins: [createPersistedState({
        storage: {
            getItem: key => Cookies.get(key),
            setItem: (key, value) => Cookies.set(key, value, {
                expires: 365,
                secure: true
            }),
            removeItem: key => Cookies.remove(key)
        }
    })],
    state: {
        user: null,
        email: null,
        token: null,
    },
    getters: {
       getToken: state =>{
         return state.token;
       },
       getUser: state =>{
        return state.user;
      },
    },
    mutations: {
        saveToken(state, tk) {
            state.token = tk;
        },
        saveUser(state, user) {
            state.user = user;
        },
        resetUserState(state){
            state.token = null;
            state.user = null;
        }
    },
    actions: {

    }
})

export default store;
