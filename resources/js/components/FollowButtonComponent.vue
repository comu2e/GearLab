<template>
    <div>
        <button v-if="currentFollowing" type="button" class="btn btn-point btn-raised" @click="unfollow">
            <div v-if="sending" class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Sending...</span>
            </div>
            <div v-else>フォロー中</div>
        </button>
        <button v-else type="button" class="btn btn-default btn-raised" @click="follow">
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
        'following': false
    },
    data() {
        return {
            currentFollowing : '',
            sending : '',
        }
    },

    async follow() {
        if (this.sending) {
            return
        }
        this.sending = true
        const data = {id: this.id}
        await axios.post('/follow-users', data)
        this.currentFollowing = true
        this.sending = false
    },

    async unfollow() {
        if (this.sending) {
            return
        }
        this.sending = true
        await axios.delete(`/follow-users/${this.id}`)
        this.currentFollowing = false
        this.sending = false
    }
}

</script>

<style scoped>

</style>
