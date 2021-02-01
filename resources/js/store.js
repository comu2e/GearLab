import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        auth_user: "Vuex State"
    },
    mutations:{
        setter(state,user){
            state.auth_user = user;
        }
    },
    computed:{
        auth_user(){
            return this.$store.state.auth_user;
        }
    }
})
