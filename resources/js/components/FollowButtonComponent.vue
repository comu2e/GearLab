<template>
    <div>
<!--        <button v-if="status == false" type="button" class="btn btn-primary" @click="unfollow">-->
<!--            フォロー中-->
<!--        </button>-->
<!--        <button v-else type="button" class="btn btn-secondary btn-raised" @click="follow">-->
<!--            <div v-if="sending" class="spinner-border spinner-border-sm" role="status">-->
<!--                <span class="sr-only">Sending...</span>-->
<!--            </div>-->
<!--            <div v-else>-->
<!--                フォローする-->
<!--            </div>-->

            <div>
                <button v-if="status == false" type="button" @click.prevent="follow" class="btn btn-outline-success">フォローする</button>
                <button v-else type="button" @click.prevent="follow" class="btn btn-primary">フォロー済み</button>
            </div>

<!--        </button>-->
    </div>
</template>

<script>
export default {
    props: ['id'],
    data: function () {
        return {
            currentFollowing: this.following,
            sending: false,
            status: false,

        }
    },
    created() {
        this.follow_check()
    },
    methods: {

        follow_check() {
            const id = this.id
            const array = ["/users/",id,"/isFollowingcheck"];
            const path = array.join('')
            axios.get(path).then(res => {
                if(res.data == 1) {
                    console.log(res.data)
                    this.status = true
                } else {
                    console.log(res.data)

                    this.status = false
                }
            }).catch(function(err) {
                console.log(err)
            })
        },
        follow() {
            // if (this.sending) {
            //     return
            // }
            // this.sending = true
            // const data = {id: this.id}
            // axios.post('/follow-users', data)
            // this.currentFollowing = true
            // this.sending = false
            //

            const id = this.id
            const array = ["/users/",id,"/follow"];
            const path = array.join('')
            axios.post(path).then(res => {
                this.follow_check()
            }).catch(function(err) {
                console.log(err)
            })

        },
        // unfollow() {
        //
        //     this.sending = true
        //     axios.delete(`/follow-users/${this.id}`)
        //     this.currentFollowing = false
        //     this.sending = false
        //
        //
        //
        //
        // }
    }
}
</script>
