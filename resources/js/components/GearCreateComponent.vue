<template>
    <form v-on:submit.prevent="submit">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="id">Title</label>
            <input id="id" v-model="gear.id" class="col-sm-9 form-control" type="text">
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="content">Content</label>
            <input id="content" v-model="gear.content" class="col-sm-9 form-control" type="text">
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="maker_name">maker_name</label>
            <input id="maker_name" v-model="gear.maker_name" class="col-sm-9 form-control" type="text">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>

    </form>
</template>

<script>
export default {
    name: 'GearCreateComponent',
    data: function () {
        return {
            gear: {}
        }
    },
    methods: {
        submit() {
            axios.post('/api/gears', this.gear)
                .then((res) => {
                    this.$router.push({name: 'gear.list'});
                });
        }
    }
}

</script>

<style scoped>

</style>
