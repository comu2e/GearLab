
<template>
    <div>
        <button v-if="status == false" type="button" @click.prevent="follow" class="btn btn-outline-success">フォローする！</button>
        <button v-else type="button" @click.prevent="follow" class="btn btn-primary">フォローずみ！</button>
    </div>
</template>

<script>
export default {
    props: ['gear_id','user_id'],
    data() {
        return {
            status: false,
        }
    },
    created() {
        this.follow_check()
    },
    methods: {
        follow_check() {
            const id = Number(this.user_id);
            const array = ["/follows/",id,"/check"];
            const path = array.join('')
            axios.get(path).then(res => {
                if(res.data == 1) {
                    this.status = true
                } else {

                    this.status = false
                }
            }).catch(function(err) {
                console.log(err)
            })
        },
        follow() {
            const id = Number(this.user_id);
            const array = ["/follows/",id,"/follows"];
            const path = array.join('')
            axios.post(path).then(res => {
                this.follow_check()
            }).catch(function(err) {
                console.log(err)
            })
        }
    }
}
</script>
<style scoped>

</style>
