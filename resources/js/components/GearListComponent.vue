<template>
    <div class="container">
        <div align="center">
            <!--            <div>User_id is {{ $route.params.value.id }}</div>-->
            <div class="form-group">
                <div class="btn-select">

                    <p class="label">気になるギアのカテゴリ</p>
                    <select id="category" class="form-control select" v-model="category" @change="searchGear(category)">
                        <!--                    <option :value="null" disabled>Gearのカテゴリを選択してください。</option>-->
                        <option v-for="category in gear_category" :value="category">
                            <h2> {{ category }}</h2>
                        </option>
                    </select>
                </div>

            </div>
            <div>{{ category }}</div>
            <pagination :data="gears" @pagination-change-page="getResults" align="center"></pagination>
            <ul v-for="gear in gears.data" :key="gear.id" class="list-group">
                <!--                <div v-if="gears.data.length !== 0">-->
                <!--                    {{gears.data.length}}-->
                <li class="list-group-item">
                    <div align="center" scope="row">
                        <div align="left">
                            <router-link :to="{ name: 'home'}" @click.native="getUserGears(gear.user.id)"
                                         class="btn btn-primary mb-3" align="left">
                                <div>{{ gear.user.name + 'のページへ' }}</div>

                            </router-link>
                            <div v-if="gear.user_id !== auth_user.id">
                                <follow-button-component :gear_id=gear.id
                                                         :user_id=gear.user_id></follow-button-component>
                            </div>
                        </div>


                        <img alt="" v-bind:src='gear.image_url' width="35%">

                        <div  v-if="gear.youtube_url !== null">
<!--                            https://jp.vuejs.org/v2/guide/syntax.html でユーザーから与えられたコンテンツに対しては行ってはいけないので下記の使い方はしない-->
<!--                            <span v-html=getYoutubetag(gear.youtube_url)> </span>-->
                           {{getYoutubetag(gear.youtube_url)}}
                        </div>

                        <div align="right">

                            <div class="card-title">{{ gear.gear_category }}</div>
                            <div class="card-title">{{ gear.maker_name }}</div>

                            <div class="card-title">{{ gear.gear_name }}</div>

                            <div class="card-text text-muted" align="center">{{ gear.content }}</div>


                            <div v-if="gear.user_id !== auth_user.id">
                                <like :gear_id=gear.id></like>

                            </div>
                            <div class="card-footer">
                                <small class="text-muted">{{
                                        gear.updated_at | moment(" 投稿日: YYYY年MM月DD日HH時mm分")
                                    }}</small>
                            </div>

                        </div>
                    </div>

                </li>
                <!--                </div>-->

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
        getYoutubetag($youtube_url) {
            axios.get('api/createtag?youtube_url=' + $youtube_url)
                .then((res) => {
                   console.log(res.data);
                    return res.data;

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
body {
    text-align: center;
}

.btn-select {
    width: 300px;
    margin: 20px auto;
    position: relative;
    background: #333;
    border-radius: 6px;
    cursor: pointer; /* IEでcursorがチラついたので */
}

.label {
    color: #fff;

    position: absolute;
    width: 100%;
    z-index: 1;
}

.select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: block;
    cursor: pointer;
    width: 100%;
    border: none;
    padding: 20px;
    opacity: 0;
    position: relative;
    z-index: 2;
}

/* IE10以上で矢印を消す */
.select::-ms-expand {
    display: none;
}

/* フォーカス時 */
.select:focus {
    z-index: -1;
    opacity: 1;
}
</style>
