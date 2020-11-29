<template>

<div class="container">
    <div align="center">
        <form v-on:submit.prevent="submit" >
            <div class="content">
                <h1>File Upload</h1>
                <p><input type="file" v-on:change="fileSelected"></p>
                <button v-on:click="fileUpload">アップロード</button>
                <p v-show="showUserImage"><img v-bind:src="user.file_path"></p>
            </div>
            <div>


                <label>カテゴリー</label>

                <select id="gear_category" v-model="gear.gear_category">

                    <option>BackPack</option>
                    <option>Cut</option>
                    <option>Shelter</option>
                    <option>Kitchen</option>
                    <option>Bonfire</option>
                </select>
            </div>
            <div class="form-group">
                <label>ギアの名前</label>
                <input id="gear_name" v-model="gear.gear_name"  type="text">
            </div>
            <div class="form-group"><label>内容</label>
                <input id="content" v-model="gear.content"  type="text">
            </div>
            <div class="form-group"><label>メーカー名</label>
                <input id="maker_name" v-model="gear.maker_name"  type="text">
            </div>

            <!--                <div>-->
            <!--                    <input type="file"  v-model="gear.image_url"  name="image_url">-->

            <!--                </div>-->
            <div>
                <button class="btn btn-primary" type="submit">Submit</button>

            </div>


        </form>
    </div>

</div>

</template>

<script>

export default {
    name: 'GearCreateComponent',
    data: function () {
        return {
            gear: {},
            fileInfo: '',
            user: '',
            showUserImage: false        }
    },
    props: {},
    methods: {
        submit() {
            axios.post('/api/gears', this.gear)
                .then((res) => {
                    this.$router.push({name: 'gear.list'});
                });
        },
        fileSelected(event){
            this.fileInfo = event.target.files[0]
        },
        fileUpload(){
            const formData = new FormData()

            formData.append('file',this.fileInfo)

            axios.post('/api/file_upload',formData).then(response =>{
                this.user = response.data
                console.log(this.user)
                console.log(this.gear)
                // this.gear['image_url'] = response.data.file_path
                if(response.data.file_path) this.showUserImage = true
            });
        }
    },



}

</script>

<style scoped>

</style>
