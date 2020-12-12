<template>
    <div class="container">
        <div align="center">

            <div class="form-group">
                <label for="select1a">気になるギアのカテゴリを選んでみましょう</label>
                <select id="select1a" class="form-control" v-model="category">
                    <option selected>All</option>
                    <option>BackPack</option>
                    <option>Cutting</option>
                    <option>Shelter</option>
                    <option>Bonfire</option>
                    <option>Kitchen</option>
                </select>
            </div>
            <div>{{category}}</div>
            <ul v-for="gear in categorizeGears" class="list-group">
                <li class="list-group-item">
                    <div align="center" scope="row">

                        <img alt="" v-bind:src='gear.image_url' width="30%">
                        <div align="right">

                            <!--                            <div>{{// '投稿者 : '+gear.user_name }}</div>-->
                            <div>{{ 'カテゴリ: ' + gear.gear_category }}</div>
                            <div>{{ 'ギア名: ' + gear.gear_name }}</div>
                            <div>{{ 'ユーザーID: ' + gear.user_id }}</div>

                            <div>{{ 'お気にいりポイント : ' + gear.content }}</div>
                            <div>{{ ' 投稿日: ' + gear.updated_at }}</div>
                            <div>{{ 'メーカー名 : ' + gear.maker_name }}</div>
                            <div class="btn btn-success btn-sm">{{ 'いいね数 : ' + gear.likes_count }}</div>


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
    name: "GearListComponent",
    data: function () {
        return {
            keyword: '',
            category: '',
            gears: [],
            gear: []
        }
    },
    methods: {
        getGears() {
            axios.get('/api/gears')
                .then((res) => {
                    this.gears = res.data['data'];
                });
        },

        searchGear(category) {
            axios.get('/api/category=' + category)
                .then((res) => {
                    this.gears = res.data['data'];
                });
        },

    },
    computed: {
        filteredGears: function() {

            var gears = [];

            for(var i in this.gears) {

                var gear = this.gears[i];

                if(gear.gear_name.indexOf(this.keyword) !== -1) {

                    gears.push(gear);


                }

            }

            return gears;
        },
        categorizeGears: function() {

            var gears = [];

            for(var i in this.gears) {

                var gear = this.gears[i];

                if(gear.gear_category.indexOf(this.category) !== -1) {

                    gears.push(gear);


                }

            }

            return gears;
        }
    },
    mounted() {
        this.getGears();
    }
}
</script>

<style scoped>

</style>
