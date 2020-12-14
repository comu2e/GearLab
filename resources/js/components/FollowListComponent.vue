<template>
      <div>{{follows}}</div>
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
        // getFollow() {
        //     axios.get('/follow-users/'+this.$store.state.auth_user.id)
        //         .then((res) => {
        //             this.follows = res.data['data'];
        //         });
        // },
        getAllFollow() {
            axios.get('/follow-users/'+this.$store.state.auth_user.id)
                .then((res) => {
                    this.follows = res.data['data'];
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
