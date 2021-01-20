<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!--                    <div>User_id is {{ $route.params.value.id }}</div>-->
                    <!--                    <div>User_id is {{ $route.params }}</div>-->
                    <div class="card-body　d-flex justify-content-center">
                        <div align="center">
                            <label> ギアの写真</label>
                            <!--                        <input class="form-control" type="file" @change="confirmImage" v-if="view"/>-->
                            <div class="justify-content-center">
                                <img-inputer v-model="file"
                                             theme="light"
                                             size="middle"
                                             placeholder="ギア写真をここにドラッグする"
                                             bottom-text="ファイルをドロップするかここをクリックしてください"
                                             auto-update="true"/>

                            </div>
                        </div>


                        <!-- 確認用画像 -->
                        <!--                        <p v-if="confirmedImage">-->
                        <!--                            <img class="img" :src="confirmedImage"/>-->
                        <!--                        </p>-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">ギアカテゴリ</label>
                            </div>
                            <select class="form-control" v-model="gear_category">
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
                            <input type="text" class="form-control" aria-label="gear_maker" v-model="maker_name">

                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ギア名</span>
                            </div>
                            <input type="text" class="form-control" aria-label="gear_name" v-model="gear_name">

                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">お気に入りポイント</span>
                            </div>
                            <textarea class="form-control" aria-label="ギアのお気に入りポイント" v-model="content"></textarea>
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
                            <button @click="uploadImage" class="btn btn-primary btn-lg ">Gear+</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    // user: Number,
    mounted() {
        console.log('Create Component is mouted')
            // console.log(this.$store.state.auth_user)
    },
    data() {
        return {
            message: "",
            file: "",
            maker_name: "",
            gear_name: "",
            gear_category: "",
            user_id: "",
            is_post_success:null,
            content: "",
            view: true,
            gears: {},
            confirmedImage: ""
        };
    },
    created: function () {
        this.getGears();
    },

    methods: {
        getGears() {
            axios.get("/api/gears")
                .then(response => {
                    this.gears = response.data;
                })
                .catch(err => {
                    this.message = err;
                });
        },


        //画像、コメント投稿用のvue側のaxios通信
        uploadImage() {
            let data = new FormData();
            data.append("file", this.file);
            data.append("maker_name", this.maker_name);
            data.append("gear_name", this.gear_name);
            data.append("gear_category", this.gear_category);
            data.append("content", this.content);
            //Vuexのstoreからauth_user情報を呼び出す
            data.append("user_id", this.$store.state.auth_user.id);
            console.log('dataの表示')
            console.log(data);

            NProgress.start();
            axios.post("/api/gears", data)
            // axios.post("/gears", data)
                .then(response => {
                    setTimeout(()=>{
                    // this.getGears();
                    console.log('responseの表示')

                    console.log(response);
                    this.message = response.data.success;
                    this.confirmedImage = "";
                    this.maker_name = "";
                    this.gear_name = "";
                    this.gear_category = "";
                    this.content = "";
                    this.file = "";
                    // this.user_id = $route.params;
                    this.message = 'success'
                        //ファイルを選択のクリア
                    this.view = false;
                    this.is_post_success = true;
                    this.$nextTick(function () {
                        this.view = true;
                    });
                    NProgress.done();
                },3000);
                })
                .catch(err => {
                    console.log('errorの表示')

                    console.log(err)
                    this.message = err.response.data.errors;
                    this.is_post_success = false;
                });
        }
        //    ここまで
    }
};
</script>

<style>
.img {
    width: 100px;
}
</style>
