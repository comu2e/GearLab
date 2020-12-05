<template>
    <div class="container" >

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark"position="fixed">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link to="/gears" class="nav-link">ギアタイムライン</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/gears/create" class="nav-link">Gear+</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/likes" class="nav-link">いいねしたギア</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/follows" class="nav-link">フォローしているユーザー</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/registerd" class="nav-link">登録したギア</router-link>
                </li>
            </ul>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "App"

}
</script>
