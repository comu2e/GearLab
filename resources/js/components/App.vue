<template>
    <div class="container">

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark" position="fixed">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link :to="{ name: 'home', params: { value: user}}" class="nav-link">ギアタイムライン</router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'create', params: { value: user}}" class="nav-link">Gear+</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/likes" class="nav-link">いいねしたギア</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/follows" class="nav-link">フォローしているユーザー</router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'registerd', params: { value: user}}" class="nav-link">登録したギア
                    </router-link>
                </li>
            </ul>
        </nav>
        <transition mode="out-in">
            <router-view>

            </router-view>
        </transition>
    </div>
</template>

<script>
export default {
    name: "App",
    props: ['user'],
    mounted() {
        console.log('App is called')
        console.log(this.$props.user)
        this.$store.commit("setter",this.$props.user);
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
