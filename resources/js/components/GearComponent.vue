<template>

    <div>
        <!-- 新規追加フォーム -->
        <div>
            <p>カテゴリ：<input type="text" v-model="gear_category" /></p>
            <p>content：<input type="text" v-model="content" /></p>
            <button @click="addGear">追加</button>
        </div>

        <!-- book一覧 -->
        <div>
            <ul>
                <li v-for="gear in gears" :key="gear.id">
                    {{ gear.id }}/{{ gear.content }}/{{ gear.gear_category }}
{{'Heee'}}
                    <button :disabled="isPush" @click="deleteGear(gear.id)">
                        削除
                    </button>
                </li>
            </ul>
        </div>

        <!-- 編集フォーム -->
<!--        <div v-if="updateForm">-->
<!--            <p>idが{{ updateId }}の編集フォーム</p>-->
<!--            <p>タイトル：<input type="text" v-model="updateTitle" /></p>-->
<!--            <p>著者：<input type="text" v-model="updateAuthor" /></p>-->
<!--&lt;!&ndash;            <button @click="updateBook(updateId, updateTitle, updateAuthor)">&ndash;&gt;-->
<!--&lt;!&ndash;                編集する&ndash;&gt;-->
<!--&lt;!&ndash;            </button>&ndash;&gt;-->
<!--&lt;!&ndash;            <button @click="updateCancel">キャンセル</button>&ndash;&gt;-->
<!--        </div>-->

        <!-- エラーメッセージ -->
        <p v-if="message">{{ message }}</p>
    </div>
</template>

<script>
export default {
    name: "GearComponent",
    data() {
        return {
            gears: {},
            message: "",
            isPush: false,
            updateForm: false,
            id: "",
            content: "",
            user_id: "",
            gear_category: "",
            gear_name: "",
            maker_name: "",
            image_url: "",
            updated_at: "",
            created_at: "",
            edited_at: ""
        };
    },
    created: function() {
        this.getGear();
    },
    methods: {
        getGear() {
            axios
                .get("/api/gears/")
                .then(response => {
                    this.gears = response.data;
                    console.log(this.gears);
                })
                .catch(err => {
                    this.message = err;
                });
        },
        addGear() {
            axios
                .post("/api/gears/", {
                    gear_category: this.gear_category,
                    gear_name: this.gear_name,
                    contet: this.content,
                    maker_name: this.maker_name,
                    updated_at: this.updated_at,
                    content: this.content,
                    image_url: this.image_url
                })
                .then(response => {
                    this.getGear();
                    this.id = "";
                    this.user_id = "";
                    this.gear_category = "";
                    this.maker_name = "";
                    this.updated_at = "";
                    this.created_at = "";
                    this.edited_at = "";
                    this.content = "";
                    this.image_url = "";
                })
                .catch(err => {
                    this.message = err;
                });
        },
        // displayUpdate(id, image, content) {
        //     this.isPush = true;
        //     this.updateForm = true;
        //     this.message = "";
        //     this.updateId = id;
        //     this.updateTitle = title;
        //     this.updateAuthor = author;
        // },
        // updateCancel() {
        //     this.isPush = false;
        //     this.updateForm = false;
        //     this.message = "";
        // },
        // updateBook(updateId, updateContent) {
        //     axios
        //         .put("/api/gears/" + updateId, {
        //             title: this.updateContent,
        //         })
        //         .then(response => {
        //             this.getGear();
        //             this.isPush = false;
        //             this.updateForm = false;
        //             this.message = "";
        //         })
        //         .catch(err => {
        //             this.message = err;
        //         });
        // },
        deleteGear(id) {
            axios
                .delete("/api/gears/" + id)
                .then(response => {
                    this.getGear();
                    this.message = "";
                })
                .catch(err => {
                    this.message = err;
                });
        }
    }
};
</script>
