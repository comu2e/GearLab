<template v-if != empty($_GET['category'])>
    <div>{{$_GET['category']}}</div>
    <img src={{// asset('/img/'.$_GET['category'].'.svg')  }} width=15% alt="">
    <div>Category</div>
</template>

<script>
export default {
name: "GearCategoryComponent"
}
</script>

<style scoped>

</style>
