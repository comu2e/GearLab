<template>
    <div>
        <div class="form-group row border-bottom">
            <label class="col-sm-3 col-form-label" for="person-in-charge">Gear ID</label>
            <input id="gear-id" v-model="gear.id" class="col-sm-9 form-control-plaintext" readonly
                   type="text">

        </div>

        <div class="form-group row border-bottom">
            <label class="col-sm-3 col-form-label" for="person-in-charge">Gear Content</label>
            <input id="Content" v-model="gear.content" class="col-sm-9 form-control-plaintext" readonly
                   type="text">

        </div>
        d
        <div class="form-group row border-bottom">
            <label class="col-sm-3 col-form-label" for="person-in-charge">Gear maker</label>
            <input id="person-in-charge" v-model="gear.maker_name" class="col-sm-9 form-control-plaintext" readonly
                   type="text">

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
                .then((res) => {
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
