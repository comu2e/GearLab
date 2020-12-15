<template>
    <div>
        <div v-for="follow_list in follows">
            <div v-for="follow in follow_list">
                    <button @click="getUserGears(follow.id)" class='btn btn-primary'>Show Users gears</button>

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
    mounted() {
        this.getAllFollow();
    }
}
</script>

<style scoped>

</style>
