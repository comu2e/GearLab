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
                                         auto-update="true"/>

                        </div>

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
                            <input class="form-control" type="text" v-model="gear_name"placeholder="gear.gear_name"/>
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
         props: {
                 gearId:Number
             }
     }
 </script>
