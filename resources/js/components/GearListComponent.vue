<template>
    <div class="container">
        <div></div>
        <div align="center">
            <!--            <div>User_id is {{ $route.params.value.id }}</div>-->
            <div class="form-group">
                <label for="category">気になるギアのカテゴリを選んでみましょう</label>
                <select id="category" class="form-control" v-model="category" @change="searchGear(category)">
                    <!--                    <option :value="null" disabled>Gearのカテゴリを選択してください。</option>-->
                    <option v-for="category in gear_category" :value="category">
                        {{ category }}
                    </option>
                </select>
            </div>
            <div>{{ category }}</div>
            <pagination :data="gears" @pagination-change-page="getResults" align="center"></pagination>
            <ul v-for="gear in gears.data" :key="gear.id" class="list-group">
                <li class="list-group-item">
                    <div align="center" scope="row">
                        <router-link :to="{ name: 'home'}" @click.native="getUserGears(gear.user.id)" class="nav-link" align="left">
                            <div>{{ '' + gear.user.name }}</div>

                        </router-link>
                        <div v-if="gear.user_id !== auth_user.id">
                            <follow-button-component :gear_id=gear.id :user_id=gear.user_id></follow-button-component>
                        </div>
                        <img alt="" v-bind:src='gear.image_url' width="30%">
                        <div align="right">

                            <div>{{ 'カテゴリ: ' + gear.gear_category }}</div>
                            <div>{{ 'ギア名: ' + gear.gear_name }}</div>

                            <div>{{ 'お気にいりポイント : ' + gear.content }}</div>
                            <div>{{ 'メーカー名 : ' + gear.maker_name }}</div>


                            <div v-if="gear.user_id !== auth_user.id">
                                <like :gear_id=gear.id></like>

                            </div>
                            <div align="left">{{gear.updated_at | moment(" 投稿日: YYYY年MM月DD日HH時mm分") }}</div>

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
                .then(res => {
                    this.gears = res.data.data;
                });
        },


        searchGear(category) {

            axios.get('/api/gears/category/' + category)
                .then((res) => {
                    this.gears = res.data.data;
                });
        },
        /**
         * ユーザーのギアタイムラインを出す
         */
        getUserGears($user_id) {
            axios.get('/api/user_id=' + $user_id)
                .then((res) => {
                    this.gears = res.data.data;
                });
        },

    },
    computed: {
        auth_user() {
            return this.$store.state.auth_user;
        },


    },
    mounted() {
        this.getResults();

    }
}
</script>

<style scoped>

</style>
