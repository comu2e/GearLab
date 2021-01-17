<template>
    <div class="container">
        <form v-on:submit.prevent="submit">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div>編集画面</div>
                        <div class="card-body　d-flex justify-content-center">
                            <div align="center">
                                <label class="col-md-4 col-form-label text-md-right"> ギアの写真</label>
                                <!--                        <input class="form-control" type="file" @change="confirmImage" v-if="view"/>-->
                                <div class="justify-content-center">
                                    <img-inputer v-model="file"
                                                 theme="light"
                                                 size="large"
                                                 placeholder="ギア写真をここにドラッグする"
                                                 bottom-text="ファイルをドロップするかここをクリックしてください"
                                                 auto-update="true"
                                                 :imgSrc="gear.image_url"/>

                                </div>
                            </div>


                            <!-- 確認用画像 -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">ギアカテゴリ</label>
                                </div>
                                <select class="form-control" v-model="gear.gear_category">
                                    <option value="Fire" selected="selected">焚き火ーFire</option>

                                    <option value="BackPack" selected="selected">バックパック-BackPack-</option>
                                    <option value="Cutting">ナイフ -Cutting-</option>
                                    <option value="Shelter" selected="selected">シェルタ -Shelter-</option>
                                    <option value="Kitchen" selected="selected">料理 -Kitchen-</option>
                                </select>
                            </div>


                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">ギアメーカー</span>
                                </div>
                                <input type="text" class="form-control" aria-label="gear_maker" v-model="gear.maker_name">

                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">ギア名</span>
                                </div>
                                <input type="text" class="form-control" aria-label="gear_name" v-model="gear.gear_name">

                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">お気に入りポイント</span>
                                </div>
                                <textarea class="form-control" aria-label="ギアのお気に入りポイント" v-model="gear.content"></textarea>
                            </div>

                            <div v-for="err in message" role="alert" v-if="is_post_success == false ">
                                <p class="alert alert-warning">
                                    {{ err }}
                                </p>

                            </div>
                            <div v-for="n in 1"role="alert" v-if="is_post_success == true ">
                                <p class="alert alert-success" >
                                    {{ 'ギアを登録できました！' }}
                                </p>
                            </div>
                            <p>
                                <button @click="submit" class="btn btn-primary btn-lg ">編集内容を登録する</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {

    created() {
        this.gearId = this.$route.params.gearId;
    }
    ,
    data() {
        return {
            gear: {},
            gearId: Number,
            message: "",
            file: "",
            maker_name: "",
            gear_name: "",
            gear_category: "",
            is_post_success:null,
            user_id: "",
            content: "",
            view: true,
            gears: {},
            confirmedImage: ""
        };
    }
    ,
    methods: {
        getGearById(id) {
            axios.get('/api/gears/' + id)
                .then((res) => {
                    this.gear = res.data['data'];

                });
        }
        ,
        getGears() {
            axios.get('/api/gears')
                .then((res) => {
                    this.gears = res.data['data'];
                });
        }
        ,

        deleteGear(id) {
            axios.delete('/api/gears/' + id)
                .then((res) => {
                    this.getGears();
                });
        }
        ,

        //画像、コメント投稿用のvue側のaxios通信
        submit() {
            axios.put('/gears' + this.$route.params.gearId, this.gear)
                .then((res) => {
                    this.$router.push({name: 'home'});
                    this.is_post_success = true;

                }) .catch(err => {
                this.message = err.response.data.errors;
                this.is_post_success = false;
            });
        }
    },
    mounted() {
        this.getGearById(this.$route.params.gearId);
    }
}

</script>
