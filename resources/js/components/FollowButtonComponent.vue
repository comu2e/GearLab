<template>

</template>

<script>
import { Vue, Component, Prop } from 'vue-property-decorator'
import axios from 'axios'

@Component
export default class UserFollow extends Vue {
    @Prop({
        type: String,
        required: true
    })
    id!: string

    @Prop({
        type: Boolean,
        default: false
    })
    following!: boolean

    currentFollowing = this.following
    sending = false
    async follow() {
        if (this.sending) {
            return
        }
        this.sending = true
        const data = { id: this.id }
        await axios.post('/follow-users', data)
        this.currentFollowing = true
        this.sending = false
    }

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
