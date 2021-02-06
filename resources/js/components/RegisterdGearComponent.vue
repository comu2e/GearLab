<template>
    <div class="container">
        <div align="center">
            <div v-for="n in 1" role="alert" v-if="is_post_success == true ">
                <p class="alert alert-success">
                    {{ 'ギアの登録を解除しました！' }}
                </p>

            </div>
            <pagination :data="gears" @pagination-change-page="getUserGears" align="center"></pagination>

            <ul v-for="gear in gears.data" class="list-group">

                <li class="list-group-item">
                    <div align="center" scope="row">

                        <a v-bind:href='gear.image_url' data-lightbox="demo"><img v-bind:src='gear.image_url'
                                                                                  width="200"></a>
                        <div align="right">

                            <div class="card-title">{{ gear.user.name }}</div>
                            <div class="card-title">{{ gear.gear_category }}</div>
                            <div class="card-title">{{ gear.maker_name }}</div>

                            <div class="card-title">{{ gear.gear_name }}</div>

                            <div class="card-text text-muted" align="center">{{ gear.content }}</div>

                            <p class="card-text text-muted" align="center">
                                参考にしたサイト: <span v-html="gear.ref_url"></span>

                            </p>
                            <div class="card-footer">
                                <small class="text-muted">{{
                                    gear.updated_at | moment(" 投稿日: YYYY年MM月DD日HH時mm分")
                                    }}</small>
                            </div>


                            <div class="mt-2 ml-1">
                                <!--                                削除する POST-->
                                <button class="btn btn-danger md-3" v-on:click="deleteGear(gear.id)">ギアの登録を解除する</button>
                                <!--                                Edit画面に飛ぶようにする-->
                                <router-link :to="{ name: 'edit', params: { gearId: gear.id}}">
                                    <button class="btn btn-primary md-3">ギアの説明を編集する</button>
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
    name: "RegisterdGearComponent",
    // created() {
    //     this.user = this.$route.params.value;
    // },
    data: function () {
        return {
            gears: {},
            is_post_success: null,
        }
    },
    methods: {
        getUserGears(page = 1) {
            axios.get('/api/user_id=' + this.$store.state.auth_user.id + '/?page=' + page)
                .then((res) => {
                    this.gears = res.data.data;
                });
        },
        deleteGear(id) {
            axios.delete('/api/gears/' + id)
                .then((res) => {
                    this.is_post_success = true;

                    this.getUserGears(this.$store.state.auth_user.id);

                });
        }
    },
    mounted() {
        this.getUserGears(1,this.$store.state.auth_user.id);
    }
}
</script>

<style scoped>
img {
    border-radius: 25px; /* ちょっとだけ角丸 */
}
</style>
