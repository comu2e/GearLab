<template>
    <div>
        <button v-if="currentFollowing"   type="submit" class="btn btn-point btn-primary" @click="unfollow">
            <div v-if="sending" class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Sending...</span>
            </div>
            <div v-else>フォロー中</div>
        </button>
        <button v-else type="submit"class="btn btn-default btn-danger" @click="follow">
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
export default{
    props: {
        id: {
            type:Number,
            required:true
        },
        following:{
            type:Boolean,
            default:false
        }
    },

    data(){
        return {
            currentFollowing : this.following,
            sending : false
        }
    },

    methods:{
        follow(){
            if (this.sending) {
                return
            }
            var params = new URLSearchParams()

            this.sending = true
            axios.post(`/follow-users/${this.id}`,params).then(res=>{
                console.log(res);
            }).catch(function (err){
                console.log(err)
            })
            this.currentFollowing = true
            this.sending = false
        },
        unfollow() {
            if (this.sending) {
                return
            }
            this.sending = true
            // const data = { id: this.id }

            axios.delete(`/follow-users/${this.id}`).then(res=>{
                console.log(res);
            }).catch(function (err){
                console.log(err)
            })

            this.currentFollowing = false
            this.sending = false
        }
    }

}
</script>
