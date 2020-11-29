<template>
<div>
    <div class="form-group row border-bottom">
        <label for="person-in-charge" class="col-sm-3 col-form-label">Gear ID</label>
        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="gear-id"
               v-model="gear.id">

    </div>

    <div class="form-group row border-bottom">
        <label for="person-in-charge" class="col-sm-3 col-form-label">Gear Content</label>
        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="Content"
               v-model="gear.content">

    </div>
    d
    <div class="form-group row border-bottom">
        <label for="person-in-charge" class="col-sm-3 col-form-label">Gear maker</label>
        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="person-in-charge"
               v-model="gear.maker_name">

    </div>
</div>

</template>

<script>
export default {
    name: "GearShowComponent",
    props: {
        gearId: String
    },
    data: function () {
        return {
            gear: {}
        }
    },
    methods: {
        getGear() {
            axios.get('/api/gears/',
            this.gearId
        )
        .
            then((res) => {
                this.gear = res.data['data'];
            });
        }
    },
    mounted() {
        this.getGear();
    }
}
</script>

<style scoped>

</style>
