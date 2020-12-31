<template>
    <div class="container">
        <div class="row justify-content-center mt-1">
            <div class="col-md-12">
                <div>
                    <button @click="unfavorite()" class="btn btn-danger btn-sm">
                    使ってみたい　解除
                    </button>
                    <button @click="favorite()" class="btn btn-success btn-sm">
                        {{ ' 使ってみたい人の数: ' + count }}
                    </button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['post'],
    data() {
        return {
            count: "",
            result: "false" //追加
        }
    },
    mounted() {
        this.hasfavorites();
        this.countfavorites(); //追加
    },
    methods: {
        favorite() {
            axios.get('/gears/' + this.post.id + '/favorites')
                .then(res => {
                    this.count = res.data.count;
                }).catch(function (error) {
            });
        },
        unfavorite() {
            axios.get('/gears/' + this.post.id + '/unfavorites')
                .then(res => {
                    this.count = res.data.count;
                }).catch(function (error) {
            });
        },
        countfavorites() {
            axios.get('/gears/' + this.post.id + '/countfavorites')
                .then(res => {
                    this.count = res.data;
                }).catch(function (error) {
            });
        },
        hasfavorites() {
            axios.get('/gears/' + this.post.id + '/hasfavorites')
                .then(res => {
                    this.result = res.data;
                }).catch(function (error) {
            });
        }
    }
}
</script>
