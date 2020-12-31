<template>
    <div>
        <div v-for="follow_list in follows">
            <div v-for="follow in follow_list">
                <div class="form-group row justify-content-center">
                    <span></span>

                    <div class="card w-75">
                        <div class="card-body">
                            <h5 class="card-title">{{follow.name}}</h5>
                            <p class="card-text">登録日:{{follow.created_at}}
                                content.</p>
                                <router-link :to="{ name: 'user_gears',params:{value:follow.id}}" class="nav-link btn-primary">
                                    {{follow.name}}のGear Labへ
                                </router-link>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>




</template>

<script>
export default {
    name: "FollowListComponent",
    data: function () {
        return {
            follows: []
        }
    },
    methods: {

        getAllFollow() {
            axios.get('/following/' + this.$store.state.auth_user.id)
                .then((res) => {
                    this.follows = res.data;
                });
        },


    },
    mounted() {
        this.getAllFollow();
    }
}
</script>

<style scoped>

</style>
