<template>
    <div class="container">
        <div align="center">

            <ul v-for="gear in gears" class="list-group">
                <li class="list-group-item">
                    <div align="center" scope="row">

                        <img alt="" v-bind:src='gear.image_url' width="30%">
                        <div align="right">

                            <!--                            <div>{{// '投稿者 : '+gear.user_name }}</div>-->
                            <div>{{'カテゴリ: ' + gear.gear_category }}</div>
                            <div>{{'ギア名: ' + gear.gear_name }}</div>
                            <div>{{'ユーザーID: ' + gear.user_id }}</div>

                            <div>{{'お気にいりポイント : ' +gear.content }}</div>
                            <div>{{' 投稿日: ' +gear.updated_at }}</div>
                            <div>{{'メーカー名 : ' + gear.maker_name }}</div>
                            <div class="btn btn-success btn-sm">{{'いいね数 : '+gear.likes_count }}</div>

                            <div>
                                <!--                                削除する POST-->
                                <button class="btn btn-danger" v-on:click="deleteGear(gear.id)">Delete</button>
                                <!--                                Edit画面に飛ぶようにする-->
                                <button class="btn btn-primary" v-on:click="getGearById(gear.id)">Edit</button>
                                <router-link v-bind:to="{name: 'gear.edit', params: {gearId: gear.id }}">
                                    <button class="btn btn-success">Edit</button>
                                </router-link>
                            </div>


                        </div>

                    </div>
                </li>

            </ul>
        </div>
    </div>
</template>

<script>
const category = ['All', 'Cutting', 'Shelter', 'Kitchen', 'BackPack']
export default {
    name: "GearListComponent",
    data: function () {
        return {
            gears: []
        }
    },
    methods: {
        getGears() {
            axios.get('/api/gears')
                .then((res) => {
                    this.gears = res.data['data'];
                });
        },
        getGearById(id) {
            axios.get('/api/gears/' + id)
                .then((res) => {
                    this.gears = res.data['data'];
                });
        },
        deleteGear(id) {
            axios.delete('/api/gears/' + id)
                .then((res) => {
                    this.getGears();
                });
        },
        UpdateGear(id) {
            axios.put('/api/gears/' + id)
                .then((res) => {
                    this.getGears();
                });
        }
    },
    mounted() {
        this.getGears();
    }
}
</script>

<style scoped>

</style>
