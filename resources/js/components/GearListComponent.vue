<template>
    <div class="container">
        <div align="center">

            <div class="form-group">
                <label for="category">気になるギアのカテゴリを選んでみましょう</label>
                <select id="category" class="form-control" v-model="category">
                    <option :value="null" disabled>Gearのカテゴリを選択してください。</option>
                    <option v-for="category in gear_category" :value="category">
                        {{ category }}
                    </option>
                </select>
            </div>
            <div>{{ category }}</div>
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
                            <follow-button-component></follow-button-component>

                        </div>

                    </div>
                </li>

            </ul>
        </div>
    </div>
</template>

<script>
import FollowButtonComponent from "./FollowButtonComponent";

const category = ['All', 'Cutting', 'Shelter', 'Kitchen', 'BackPack']
export default {
    name: "GearListComponent",
    components: {FollowButtonComponent},
    data: function () {
        return {
            keyword: '',
            category: '',
            gears: [],
            gear: [],
            gear_category: ['All', "Kitchen", "Cutting", "BackPack", "Shelter", "Bonfire"],
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
        filteredGears: function () {
            var gears = [];
            if (this.category !== "All") {
                for (var i in this.gears) {
                    var gear = this.gears[i];
                    if (gear.gear_name.indexOf(this.keyword) !== -1) {
                        gears.push(gear);
                        return gears;

                    }
                }
            } else {
                this.getGears();
                return gears;

            }
        },
        categorizeGears: function () {

            var gears = [];

            if (this.category !== 'All') {

                for (var i in this.gears) {

                    var gear = this.gears[i];

                    if (gear.gear_category.indexOf(this.category) !== -1) {

                        gears.push(gear);
                    }


                }
            }
            // if(this.category ==='All'){
            //     this.getGears();
            //     console.log(this.gears);
            // }


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
