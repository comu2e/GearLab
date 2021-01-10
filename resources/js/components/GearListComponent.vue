<template>
    <div class="container">
        <div></div>
        <div align="center">
            <!--            <div>User_id is {{ $route.params.value.id }}</div>-->
            <div class="form-group">
                <label for="category">気になるギアのカテゴリを選んでみましょう</label>
                <select id="category" class="form-control" v-model="category">
<!--                    <option :value="null" disabled>Gearのカテゴリを選択してください。</option>-->
                    <option v-for="category in gear_category" :value="category">
                        {{ category }}
                    </option>
                </select>
            </div>
            <div>{{ category }}</div>
<!--            <ul v-for="gear in categorizeGears" class="list-group">-->
<!--                <li class="list-group-item">-->
<!--                    <div align="center" scope="row">-->

<!--                        <img alt="" v-bind:src='gear.image_url' width="30%">-->
<!--                        <div align="right">-->

<!--                            &lt;!&ndash;                            <div>{{// '投稿者 : '+gear.user_na:e }}</div>&ndash;&gt;-->
<!--                            <div>{{ '登録者: ' + gear.user.name }}</div>-->

<!--                            <div>{{ 'カテゴリ: ' + gear.gear_category }}</div>-->
<!--                            <div>{{ 'ギア名: ' + gear.gear_name }}</div>-->

<!--                            <div>{{ 'お気にいりポイント : ' + gear.content }}</div>-->
<!--                            <div>{{gear.updated_at | moment(" 投稿日: YYYY年MM月DD日HH時mm分")  }}</div>-->
<!--                            <div>{{ 'メーカー名 : ' + gear.maker_name }}</div>-->

<!--                            <div v-if="gear.user_id !== auth_user.id">-->
<!--                                <follow-button-component :id=gear.user_id :following="gear.followers.length"></follow-button-component>-->
<!--                            </div>-->
<!--                           <div v-if="gear.user_id !== auth_user.id">-->
<!--                               <like :gear_id=gear.id></like>-->

<!--                           </div>-->
<!--                            <p class="card-text mb-0"><small class="text-muted">いいね数 {{gear.likes.length}}</small></p>-->
<!--                          -->
<!--&lt;!&ndash;                            <like-component :post="gear"></like-component>&ndash;&gt;-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->

<!--            </ul>-->


        </div>
        <ul>
            <li v-for="post in gears.data" :key="post.id">{{ post.maker_name }}</li>
        </ul>

        <pagination :data="gears" @pagination-change-page="getResults"></pagination>

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
            category: 'All',
            gears: {},
            gear: [],
            gear_category: ['All', "Kitchen", "Cutting", "BackPack", "Shelter", "Fire"],
            date: this.$moment().format(),


        }
    },
    methods: {
        getResults(page = 1) {
            axios.get('/api/gears/?page=' + page)
                .then(response => {
                    this.gears = response.data.data;
                });
        },
        // getGears() {
        //     axios.get('/api/gears')
        //         .then((res) => {
        //             this.gears = res.data['data'];
        //         });
        // },

        searchGear(category) {

            axios.get('/api/category=' + category)
                .then((res) => {
                    this.gears = res.data['data'];
                });
        },
        /**
         * ユーザーのギアタイムラインを出す
         */
        getUserGears($user_id) {
            axios.get('/api/user_id=' + $user_id)
                .then((res) => {
                    this.gears = res.data['data'];
                });
        },

    },
    computed: {
        auth_user() {
            return this.$store.state.auth_user;
        },
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
            /*
            temp_gearにはカテゴリ選択したギアを入れていく
             */
            var temp_gear = [];

            if (this.category !== 'All') {
                 /*
                 temp_gearを初期化
                  */

                 temp_gear = [];

                for (var i in this.gears) {

                    var gear = this.gears[i];

                    if (gear.gear_category.indexOf(this.category) !== -1) {

                        temp_gear.push(gear);
                    }


                }
            }
            if(this.category =='All'){
                temp_gear = this.gears;
            }


            return temp_gear;
        }
    },
    mounted() {
        this.getResults();

        // this.getGears();
    }
}
</script>

<style scoped>

</style>
