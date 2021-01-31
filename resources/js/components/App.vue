<template>

    <div class="container mt-5 mb-3">
        <nav class="navbar navbar-expand-sm bg-nav navbar-light justify-content-center sticky-top">

            <ul class="navbar-nav">
                <li class="nav-item-bar" v-on:click="change('1')" v-bind:class="{'active': isActive === '1'}">
                    <router-link :to="{ name: 'home'}" class="nav-link">ギアタイムライン</router-link>
                </li>

                <li class="nav-item-bar" v-on:click="change('2')" v-bind:class="{'active': isActive === '2'}">
                    <router-link :to="{ name: 'likes',param:{value:this.$store.state.auth_user}}" class="nav-link">
                        使ってみたいギア
                    </router-link>
                </li>
                <li class="nav-item-bar"v-on:click="change('3')" v-bind:class="{'active': isActive === '3'}">
                    <router-link to="/follows" class="nav-link">フォローしているユーザー</router-link>
                </li>
                <li class="nav-item-bar"v-on:click="change('4')" v-bind:class="{'active': isActive === '4'}" >
                    <router-link :to="{ name: 'registerd'}" class="nav-link">登録したギア
                    </router-link>
                </li>
            </ul>
        </nav>

        <transition mode="out-in">
            <router-view>

            </router-view>
        </transition>
        <div class="fixed-bottom">
            <nav class="navbar navbar-expand-sm justify-content-center bg-dark navbar-dark w-40">
                <router-link :to="{ name: 'create'}" class="nav-link pull-right">
                        <h3>Gear+ </h3>
                </router-link>

            </nav>
        </div>


    </div>
</template>

<script>
export default {
    name: "App",
    props: ['user'],
    data() {
        return{
            isActive: '1'
        }
    },
    methods: {
        change: function (num) {
            this.isActive = num
        }
    },
    computed: {
        auth_user() {
            return this.$store.state.auth_user;
        }
    },
    mounted() {
        this.$store.commit("setter", this.$props.user);
    }
}
</script>

<style>
.v-enter-active, .v-leave-active {
    transition: opacity .5s;
}

bg-nav{
    color:#353a3f
}
a.nav-link.router-link-exact-active.router-link-exact-active{
    border-bottom: red;

}

li.nav-item-bar.active {
    color: #fff;
    font-weight: 700;
    opacity: 1;
    border-bottom: solid 2px #0069d9;

}
.v-enter, .v-leave-to {
    opacity: 0;
}
</style>
