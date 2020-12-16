<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
<!--                    <div>User_id is {{ $route.params.value.id }}</div>-->
<!--                    <div>User_id is {{ $route.params }}</div>-->
                    <div class="card-body">

                        <label class="col-md-4 col-form-label text-md-right"> ギアの写真</label>
                        <!--                        <input class="form-control" type="file" @change="confirmImage" v-if="view"/>-->
                        <div>
                            <img-inputer v-model="file"
                                         theme="light"
                                         size="middle"
                                         placeholder="ギア写真をここにドラッグする"
                                         bottom-text="ファイルをドロップするかここをクリックしてください"
                                         auto-update="true"/>

                        </div>

                        <!-- 確認用画像 -->
                        <!--                        <p v-if="confirmedImage">-->
                        <!--                            <img class="img" :src="confirmedImage"/>-->
                        <!--                        </p>-->
                        <label class="col-md-4 col-form-label text-md-right">カテゴリ
                            <div class="col-xs-3">
                                <select class="form-control" v-model="gear_category">
                                    <option value="BonFire" selected="selected">Bonfire</option>
                                    <option value="BackPack" selected="selected">BackPack</option>
                                    <option value="Cutting">Cutting</option>
                                    <option value="Shelter" selected="selected">Shelter</option>
                                    <option value="Kitchen" selected="selected">Kitchen</option>
                                </select>
                            </div>
                        </label>


                        <label class="col-md-4 col-form-label text-md-right">ギアの名前
                            <input class="form-control" type="text" v-model="gear_name"/>
                        </label>


                        <label class="col-md-4 col-form-label text-md-right">メーカー名
                            <input class="form-control" type="text" v-model="maker_name"/>
                        </label>
                        <label class="col-md-4 col-form-label text-md-right">ギアのお気に入りポイント：
                            <input class="form-control" type="text" v-model="content">
                        </label>


                        <p>{{ message }}</p>

                        <p>
                            <button @click="uploadImage" class="btn btn-primary">Gear+</button>
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
        console.log('Create Component is mouted'),
        console.log(this.$store.state.auth_user)
    },
    data() {
        return {
            message: "",
            file: "",
            maker_name: "",
            gear_name: "",
            gear_category: "",
            user_id: "",
            content: "",
            view: true,
            gears: {},
            confirmedImage: ""
        };
    },
    created: function () {
        this.getGears();
    },
    // computed: {
    //     auth_user(){
    //         return this.$store.state.auth_user;
    //     }
    // },
    methods: {
        getGears() {
            axios.get("/api/gears/")
                .then(response => {
                    this.gears = response.data;
                })
                .catch(err => {
                    this.message = err;
                });
        },
        confirmImage(e) {
            this.message = "";
            this.file = e.target.files[0];
            if (!this.file.type.match("image.*")) {
                this.message = "画像ファイルを選択して下さい";
                this.confirmedImage = "";
                return;
            }
            this.createImage(this.file);
        },
        createImage(file) {
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = e => {
                this.confirmedImage = e.target.result;
            };
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

            axios.post("/api/gears/", data)
                .then(response => {
                    this.getGears();
                    this.message = response.data.success;
                    this.confirmedImage = "";
                    this.maker_name = "";
                    this.gear_name = "";
                    this.gear_category = "";
                    this.content = "";
                    this.file = "";
                    // this.user_id = $route.params;

                    //ファイルを選択のクリア
                    this.view = false;
                    this.$nextTick(function () {
                        this.view = true;
                    });
                })
                .catch(err => {
                    this.message = err.response.data.errors;
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
