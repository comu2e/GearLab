<template>
    <div class="container">
        <div align="center">

                <div class="form-group">
                    <label for="category">気になるギアのカテゴリ</label>
                    <select id="category" class="form-control" v-model="category">
                        <!--                    <option :value="null" disabled>Gearのカテゴリを選択してください。</option>-->
                        <option v-for="category in gear_category" :value="category">
                            {{ category }}
                        </option>
                    </select>
                </div>

            <div>{{ category }}</div>
            <pagination :data="gears" @pagination-change-page="getUserGears()" align="center"></pagination>

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
    name: "UserGearComponent",
    components: {FollowButtonComponent},

    created() {
        this.getUserGears(this.$route.params.value);
    },
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

            var temp_gear = [];

            if (this.category !== 'All') {
                /*
                                temp_gearを初期化
                                 */

                temp_gear = [];
                for (var i in this.gears) {

                    var gear = this.gears[i];

                    if (gear.gear_category.indexOf(this.category) !== -1) {

                        gears.push(gear);
                    }


                }
            }
            if(this.category =='All'){
                temp_gear = this.gears;
                console.log(temp_gear);
            }

            return temp_gear;
        }
    },

}
</script>

<style scoped>

</style>
