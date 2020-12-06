<template>

</template>

<script>
export default {
    name: "EditGear",
    methods: {
        getGearById(id) {
            axios.get('/api/gears' + id)
                .then((res) => {
                    this.gears = res.data['data'];
                });
        },
    }
}
</script>

<style scoped>

</style>
