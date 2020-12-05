<template>
    <div class="container">
        <div align="center">

            <ul v-for="gear in likes" class="list-group">
                <li class="list-group-item">
                    <div align="center" scope="row">

                        <img alt="" v-bind:src='gear.image_url' width="30%">
                        <div align="right">

                            <div>{{ '投稿者 : ' + gear.user_name }}</div>
                            <div>{{ 'カテゴリ: ' + gear.gear_category }}</div>

                            <div>{{ 'お気にいりポイント : ' + gear.content }}</div>
                            <div>{{ ' 投稿日: ' + gear.updated_at }}</div>
                            <div>{{ 'メーカー名 : ' + gear.maker_name }}</div>
                            <div class="btn btn-success btn-sm">{{ 'いいね数 : ' + gear.likes_count }}</div>

                            <div>
                                <button class="btn btn-danger" v-on:click="deleteGear(gear.id)">Delete</button>

                            </div>

                        </div>

                    </div>
                </li>

            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "FollowListComponent",
    data: function () {
        return {
            followed: []
        }
    },
    methods: {
        getFollow() {
            axios.get('/api/follows')
                .then((res) => {
                    this.follows = res.data['data'];
                });
        },

    },
    mounted() {
        this.getFollow();
    }
}
</script>

<style scoped>

</style>
