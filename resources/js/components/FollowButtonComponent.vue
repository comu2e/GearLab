<template>
    <div>
        <button v-if="status == 0"   type="submit" class="btn btn-point btn-primary" @click="unfollow">
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
            // type:Boolean,
            // default:false
        }
    },

    data(){
        return {
            sending : 0,
            status: 0,

        }
    },

    created() {
        this.following_check()
    },
    methods:{
        following_check() {
            // const id = this.id
            // const array = ["/users/",id,"/following_check"];
            // const path = array.join('')
            console.log("===")
            console.log(this.following)
            console.log("+++")

            if (this.following ==1){
                console.log('フォローしています')
                this.status = this.following
            }else{
                console.log('フォローしていません')
                this.status = this.following

            }

        },

        //     axios.get(path).then(res => {
        //         console.log(res.data)
        //
        //         if(res.data == 1) {
        //             this.status = 1
        //         } else {
        //             this.status = 0
        //         }
        //     }).catch(function(err) {
        //         console.log(err)
        //     })
        //     console.log(this.status)
        // },


        follow(){
            if (this.sending) {
                return
            }
            var params = new URLSearchParams()

            this.sending = true
            axios.post(`/follow-users/${this.id}`,params).then(res=>{

                this.following_check()
                this.status = 0

            }).catch(function (err){
                // console.log(err)
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

                this.following_check()
                this.status = 1

            }).catch(function (err){
                // console.log(err)
            })

            this.currentFollowing = false
            this.sending = false
        }
    }

}
</script>
