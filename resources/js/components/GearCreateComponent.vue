<template>

<div class="container">
    <div align="center">
        <form v-on:submit.prevent="submit" >

            <div>


                <label>カテゴリー</label>

                <select v-model="selected">

                    <option>BackPack</option>
                    <option>Cut</option>
                    <option>Shelter</option>
                    <option>Kitchen</option>
                    <option>Bonfire</option>
                </select>
                {{selected}}
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
            isDrag: null


        }
    },
    props: {},
    methods: {
        submit() {
            axios.post('/api/gears', this.gear)
                .then((res) => {
                    this.$router.push({name: 'gear.list'});
                });
        }
    },

}

</script>

<style scoped>

</style>
