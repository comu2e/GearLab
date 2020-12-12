<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div>編集画面</div>
                    <div class="card-body">

                        <label class="col-md-4 col-form-label text-md-right"> ギアの写真</label>
                        <!--                        <input class="form-control" type="file" @change="confirmImage" v-if="view"/>-->
                        <div>
                            <img-inputer v-model="file"
                                         theme="light"
                                         size="large"
                                         placeholder="ギア写真をここにドラッグする"
                                         bottom-text="ファイルをドロップするかここをクリックしてください"
                            />

                        </div>
                        <div>{{ gear.id }}</div>
                        <label class="col-md-4 col-form-label text-md-right">カテゴリ
                            <div class="col-xs-3">
                                <select class="form-control" :value="gear.gear_category">
                                    <option value="BonFire">Bonfire</option>
                                    <option value="BackPack">BackPack</option>
                                    <option value="Cutting">Cutting</option>
                                    <option value="Shelter">Shelter</option>
                                    <option value="Kitchen">Kitchen</option>
                                </select>
                            </div>
                        </label>


                        <label class="col-md-4 col-form-label text-md-right">ギアの名前
                            <input class="form-control" type="text" :value="gear.gear_name"/>
                        </label>


                        <label class="col-md-4 col-form-label text-md-right">メーカー名
                            <input class="form-control" type="text" :value="gear.maker_name"/>
                        </label>
                        <label class="col-md-4 col-form-label text-md-right">ギアのお気に入りポイント：
                            <input class="form-control" :value="gear.content">
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

    created() {
        this.gearId = this.$route.params.gearId;
        this.getGearById(this.gearId);
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
        uploadImage() {
            let data = new FormData();
            data.append("file", this.file);
            data.append("maker_name", this.maker_name);
            data.append("gear_name", this.gear_name);
            data.append("gear_category", this.gear_category);
            data.append("content", this.content);
            data.append("user_id", this.user.id);

            axios.post("/api/gears/", data)
                .then(response => {
                    this.getImage();
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

    }
    ,
}

</script>
