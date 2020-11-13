@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <form method="POST" action="/gears">
        @csrf
    <ul>
        {{--↓この間をcomponentにする　ImgeInput.vue--}}

        <template >
            <div class="image-input">
                <div
                    class="image-input__field"
                    :class="{'over': isDragOver}"
                    @dragover.prevent="onDrag('over')"
                    @dragleave="onDrag('leave')"
                    @drop.stop="onDrop"
                >
                    <input type="file" title @change="onChange">
                    <p>画像をドラッグ＆ドロップ
                        <br>またはクリックでファイル選択
                    </p>
                </div>
            </div>
        </template>

        <script>
            export default {
                props: ["value"],
                data() {
                    return {
                        isDragOver: false
                    };
                },
                computed: {
                    image: {
                        set(value) {
                            this.$emit("input", value);
                        },
                        get() {
                            return this.value;
                        }
                    }
                },
                methods: {
                    onDrag(type) {
                        this.isDragOver = type === "over";
                    },
                    onDrop(event) {
                        this.isDragOver = false;
                        const files = event.dataTransfer.files;
                        if (files.length !== 1 || files[0].type.indexOf("image") !== 0) {
                            return;
                        }
                        this.readImage(files[0]);
                    },
                    onChange(event) {
                        const files = event.target.files;
                        if (files.length !== 1 || files[0].type.indexOf("image") !== 0) {
                            return;
                        }
                        this.readImage(files[0]);
                    },
                    readImage(file) {
                        let reader = new FileReader();
                        reader.onload = this.loadImage;
                        reader.readAsDataURL(file);
                    },
                    loadImage(e) {
                        let image = new Image();
                        image.src = e.target.result;
                        this.image = image;
                    }
                }
            };
        </script>
        <style>
            .image-input {
                background-color: #eee;
                width: 300px;
                height: 300px;
            }
            .image-input__field {
                width: 100%;
                height: 100%;
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .image-input__field.over {
                background-color: #666;
            }
            .image-input__field > input {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                opacity: 0;
                cursor: pointer;
            }
            .image-input__field > p {
                color: #aaa;
                text-align: center;
            }
        </style>
{{--↑この間をcomponentにする　ImgeInput.vue--}}
        <li>ギアの写真
            <input name="image_url" type="text">

        </li>

        <li>カテゴリ
            {{Form::select('gear_category', ['Cut Gear'=> 'Cut Gear', 'Cut'=> 'Cut', 'Fire'=> 'Fire','Container'=> 'Container','Comfort'=>'Comfort'])}}


        </li>
        <li>ギアの名前<input name="gear_name" type="text"> </li>
        <li>ギアのメーカー名 <input name="gear_maker" type="text"></li>
        <li>ギアの使用場面 <input name="situation"type="text"></li>
        <li>お気に入りポイント<input  name="content"type="text"> </li>
        <li>購入場所<input name="place"type="text"></li>
    </ul>

        <input type="submit" class="btn btn-primary" value="投稿"/>

    </form>
    <script src="{{ mix('js/app.js') }}"></script>

</div>
@endsection

