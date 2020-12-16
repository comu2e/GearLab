<template>

    <div class="container mt-5">
        <nav class="navbar navbar-expand-sm  bg-dark navbar-dark justify-content-center sticky-top w-90 ">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link :to="{ name: 'home'}" class="nav-link">ギアタイムライン</router-link>
                </li>

                <li class="nav-item">
                    <router-link :to="{ name: 'likes',param:{value:this.$store.state.auth_user}}" class="nav-link">
                        いいねしたギア
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/follows" class="nav-link">フォローしているユーザー</router-link>
                </li>
                <li class="nav-item">
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
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
                <router-link :to="{ name: 'create'}" class="nav-link pull-right">
                        <h2>Gear+ </h2>
                </router-link>

            </nav>
        </div>


    </div>
</template>

<script>
export default {
    name: "App",
    props: ['user'],
    computed: {
        auth_user() {
            return this.$store.state.auth_user;
        }
    },
    mounted() {
        console.log('App is called')
        console.log(this.$props.user)
        this.$store.commit("setter", this.$props.user);
        console.log(this.$store.state.auth_user);
    }
}
</script>

<style>
.v-enter-active, .v-leave-active {
    transition: opacity .5s;
}

.v-enter, .v-leave-to {
    opacity: 0;
}
</style>
