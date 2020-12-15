<template>
    <div class="container">
        <div align="center">

            <ul v-for="gear in this.gears" class="list-group">
                <li class="list-group-item">
                    <div align="center" scope="row">

                        <img alt="" v-bind:src='gear.image_url' width="30%">
                        <div align="right">

                            <div>{{'投稿者 : '+gear.user_name }}</div>
                            <div>{{'カテゴリ: ' + gear.gear_category }}</div>

                            <div>{{'お気にいりポイント : ' +gear.content }}</div>
                            <div>{{' 投稿日: ' +gear.updated_at }}</div>
                            <div>{{'メーカー名 : ' + gear.maker_name }}</div>
                            <like-component :post="gear"></like-component>


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
            user:''
        }
    },
    methods: {
        getLikedGear() {
            axios.get('/gears/'+this.$store.state.auth_user.id+'/favorited')
                .then((res) => {
                    this.gears = res.data['data'];
                });
        },
    },
    mounted() {
        this.getLikedGear();
        console.log(this.gears);
    }
}
</script>

<style scoped>

</style>
