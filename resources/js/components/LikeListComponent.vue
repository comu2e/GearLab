<template>
    <div class="container">
        <div align="center">

            <ul v-for="gear in this.gears" class="list-group">
                <li class="list-group-item">
                    <div align="center" scope="row">

                        <a  v-bind:href='gear.image_url' data-lightbox="demo"><img v-bind:src='gear.image_url' width="300"></a>
                        <div align="right">

                            <div class="card-title">{{ gear.gear_category }}</div>
                            <div class="card-title">{{ gear.maker_name }}</div>

                            <div class="card-title">{{ gear.gear_name }}</div>

                            <div class="card-text text-muted" align="center">{{ gear.content }}</div>

                            <div v-if="gear.user_id !== auth_user.id">
                                <like :gear_id=gear.id></like>

                            </div>
                            <p class="card-text text-muted" align="center">
                                参考にしたサイト: <span v-html="gear.ref_url"></span>
                            </p>
                            <div class="card-footer">
                                <small class="text-muted">{{
                                        gear.updated_at | moment(" 投稿日: YYYY年MM月DD日HH時mm分")
                                    }}</small>
                            </div>

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
    name: "LikeListComponent",
    created: function () {
        this.user = this.$route.params.value;
    },
    data: function () {

        return {
            gears: [],
            user:'',
            date: this.$moment().format(),

        }
    },
    computed:{
        auth_user() {
            return this.$store.state.auth_user;
        },
    },
    methods: {
        getLikedGear() {
            axios.get('/gears/'+this.$store.state.auth_user.id+'/liked')
                .then((res) => {
                    this.gears = res.data['data'];
                    this.user = res.data['user'];
                });
        },
    },
    mounted() {
        this.getLikedGear();
    }
}
</script>

<style scoped>
img {
    border-radius: 25px; /* ちょっとだけ角丸 */
}
</style>
