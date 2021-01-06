
<template>
    <div>
          <button v-if="status == false" type="button" @click.prevent="like" class="btn btn-outline-warning">使ってみたい！</button>
        <button v-else type="button" @click.prevent="like" class="btn btn-warning">登録済み</button>
    </div>
</template>

<script>
export default {
    props: ['gear_id'],
    data() {
        return {
            status: false,
        }
    },
    created() {
        this.like_check()
    },
    methods: {
        like_check() {
            const id = this.gear_id
            const array = ["/gears/",id,"/check"];
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
        like() {
            const id = this.gear_id
            const array = ["/gears/",id,"/likes"];
            const path = array.join('')
            axios.post(path).then(res => {
                this.like_check()
            }).catch(function(err) {
                console.log(err)
            })
        }
    }
}
</script>
<style scoped>

</style>
