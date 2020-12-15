<template>
    <div>
        <div v-for="follow_list in follows">
            <div v-for="follow in follow_list">
                <div class="form-group row justify-content-center">
                    <span></span>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{follow.name}}</h5>
                                    <p class="card-text">User情報</p>
                                        <router-link :to="{ name: 'user_gears',params:{value:follow.id}}" class="nav-link">
                                            <button class="btn btn-primary btn-sm">{{follow.name}}のGear Labへ </button>
                                        </router-link>
                                </div>
                            </div>
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
