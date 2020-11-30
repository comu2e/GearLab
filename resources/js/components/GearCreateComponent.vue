<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        <label class="col-md-4 col-form-label text-md-right"> ギアの写真</label>
                        <input class="form-control" type="file" @change="confirmImage" v-if="view"/>


                        <!-- 確認用画像 -->
                        <p v-if="confirmedImage">
                            <img class="img" :src="confirmedImage"/>
                        </p>

                        <label class="col-md-4 col-form-label text-md-right">ギアの名前
                            <input class="form-control" type="text" v-model="gear_name"/>
                        </label>


                        <label class="col-md-4 col-form-label text-md-right">メーカー名
                            <input class="form-control" type="text" v-model="maker_name"/>
                        </label>
                        <label class="col-md-4 col-form-label text-md-right">ギアのお気に入りポイント：
                            <input class="form-control">
                        </label>


                        <p>{{ message }}</p>

                        <p>
                            <button @click="uploadImage" class="btn btn-primary">道具を登録する</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            message: "",
            file: "",
            maker_name: "",
            gear_name: "",
            user_id: "",
            content: "",
            view: true,
            gears: {},
            confirmedImage: ""
        };
    },
    created: function () {
        this.getImage();
    },
    methods: {
        getImage() {
            axios
                .get("/api/gears/")
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
        uploadImage() {
            let data = new FormData();
            data.append("file", this.file);
            data.append("maker_name", this.maker_name);
            data.append("gear_name", this.gear_name);
            data.append("content", this.content);
            data.append("user", this.user_id);

            axios
                .post("/api/gears/", data)
                .then(response => {
                    this.getImage();
                    this.message = response.data.success;
                    this.confirmedImage = "";
                    this.maker_name = "";
                    this.gear_name = "";
                    this.content = "";
                    this.file = "";

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
    }
};
</script>

<style>
.img {
    width: 100px;
}
</style>
