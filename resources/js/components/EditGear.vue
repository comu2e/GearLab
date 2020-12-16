<template>
    <div class="container">
        <form v-on:submit.prevent="submit">
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
                                             size="middle"
                                             placeholder="ギア写真をここにドラッグする"
                                             bottom-text="ファイルをドロップするかここをクリックしてください"
                                             :imgSrc="gear.image_url"
                                />

                            </div>
                            <label class="col-md-4 col-form-label text-md-right">カテゴリ
                                <div class="col-xs-3">
                                    <select class="form-control" v-model="gear.gear_category">
                                        <option value="BonFire">Bonfire</option>
                                        <option value="BackPack">BackPack</option>
                                        <option value="Cutting">Cutting</option>
                                        <option value="Shelter">Shelter</option>
                                        <option value="Kitchen">Kitchen</option>
                                    </select>
                                </div>
                            </label>


                            <label class="col-md-4 col-form-label text-md-right">ギアの名前
                                <input class="form-control" type="text" v-model="gear.gear_name"/>
                            </label>


                            <label class="col-md-4 col-form-label text-md-right">メーカー名
                                <input class="form-control" type="text" v-model="gear.maker_name"/>

                            </label>
                            <label class="col-md-4 col-form-label text-md-right">ギアのお気に入りポイント：
                                <input class="form-control" v-model="gear.content">

                            </label>


                            <p>{{ message }}</p>

                            <p>
                                <button type="submit" class="btn btn-primary">道具を登録する</button>
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
            axios.put('/api/gears/' + this.$route.params.gearId, this.gear)
                .then((res) => {
                    this.$router.push({name: 'home'});
                });
        }
    },
    mounted() {
        this.getGearById(this.$route.params.gearId);
    }
}

</script>
