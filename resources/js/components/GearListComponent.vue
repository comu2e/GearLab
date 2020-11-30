<template>
    <div class="container">
        <div align="center">

            <ul v-for="gear in gears" class="list-group">
                <li class="list-group-item">
                    <div align="center" scope="row">

                    <img alt="" v-bind:src='gear.image_url' width="30%">
                        <div align="right">

                            <div>{{'投稿者 : '+gear.user_id }}</div>
                            <div>{{'カテゴリ: ' + gear.gear_category }}</div>

                            <div>{{'お気にいりポイント : ' +gear.content }}</div>
                            <div>{{' 投稿日: ' +gear.updated_at }}</div>
                            <div>{{'メーカー名 : ' + gear.maker_name }}</div>
                            <div  class="btn btn-success btn-sm">{{'いいね数 : '+gear.likes_count }}</div>

                            <!--                            <a :href="{{ route('gear.unlike', ['id' => gear.id]) }}" class="btn btn-success btn-sm">いいね<span-->
                            <!--                                class="badge">{{gear.likes_count }}</span></a>-->

                            <div>
<!--                                <router-link v-bind:to="{name: 'gear.show', params: {gearId: gear.id }}">-->
<!--                                    <button class="btn btn-primary">Show</button>-->
<!--                                </router-link>-->
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
        deleteGear(id) {
            axios.delete('/api/gears/' + id)
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
