<template>
    <div>

        <button v-if="currentFollowing" type="button" class="btn btn-danger" @click="unfollow">
            <div v-if="sending" class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Sending...</span>
            </div>
            <div v-else>フォロー中</div>
        </button>
        <button v-else type="button" class="btn btn-primary" @click="follow">
            <div v-if="sending" class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Sending...</span>
            </div>
            <div v-else>
                フォローする
                <i class="material-icons">add</i>
            </div>
        </button>
    </div>
</template>
<script>

export default {
    props: {
        'id': "",
        'followable_user':"",
    },
    data() {
        return {
            currentFollowing: '',
            sending: '',
            following: false,
        }
    },
    methods: {
        follow: function () {
            if (this.sending) {
                return
            }
            this.sending = true
            const data = {id: this.id}
            axios.post('/api/follow-users/'+this.id, data)
            this.currentFollowing = true
            this.sending = false
        },

        unfollow: function () {
            if (this.sending) {
                return
            }
            const data = {user: this.followable_user}

            this.sending = true
            axios.delete(`/api/follow-users/${this.id}`)
            this.currentFollowing = false
            this.sending = false
        }
    }

}

</script>

<style scoped>

</style>
