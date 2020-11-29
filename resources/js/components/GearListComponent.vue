<template>
<div>
<tr v-for="gear in gears">
    <th scope="row">{{ gear.id }}</th>
    <td>{{ gear.user_id }}</td>
    <td>{{ gear.content }}</td>
    <td>{{ gear.maker_name }}</td>
    <td>
        <router-link v-bind:to="{name: 'gear.show', params: {gearId: gear.id }}">
            <button class="btn btn-primary">Show</button>
        </router-link>
    </td>

    <td>
        <button class="btn btn-danger" v-on:click="deleteGear(gear.id)">Delete</button>
    </td>
</tr>
</div>

</template>

<script>
export default {
    name: "GearListComponent",
    data: function () {
        return {
            gears: []
        }
    },
    methods: {
        getGears() {
            axios.get('/api/gears')
                .then((res) => {
                    this.gears = res.data['data'];
                });
        },
        deleteGear(id) {
            axios.delete('/api/gears/' + id)
                .then((res) => {
                    this.getGears();
                });
        }
    },
    mounted() {
        this.getGears();
    }
}
</script>

<style scoped>

</style>
