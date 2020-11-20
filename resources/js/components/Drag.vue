<template>
    <div id="app">
        <img-inputer v-model="file"
                     theme="light"
                     size="large"
                     placeholder="ファイルをここにドラッグする"
                     bottom-text="ファイルをドロップするかここをクリックしてください" />
    </div>
</template>

<script>
new Vue({
    el: '#app',
    data: {
        file:''
    }
});
</script>

<script>
export default {
    name: "Drag.vue",
    components: { ImgInputer }

}
import ImgInputer from 'vue-img-inputer'
import 'vue-img-inputer/dist/index.css'

</script>
<style scoped>

</style>
