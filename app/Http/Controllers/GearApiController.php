<?php


namespace App\Http\Controllers;

//use http\Env\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Auth;
use App\Models\Gear;
use App\Models\User;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Storage;
use App\Http\Requests\GearRequest;

class GearApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $gear = Gear::all();
        return response()->json([
            'message' => 'ok',
            'data' => $gear
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ], [
            'file.required' => '画像が選択されていません',
            'file.image' => '画像ファイルではありません',
        ]);

        if (request()->file) {
            $image = $request->file('file');
            $image_url = Storage::disk('s3')->put('/myprefix', $image, 'public');
            $gear = new Gear();
            $gear->image_url = Storage::disk('s3')->url($image_url);
            $gear->gear_name = $request->gear_name;
            $gear->maker_name = $request->maker_name;
            $gear->content = $request->content;
            $gear->gear_category = $request->gear_category;
            $gear->updated_at = date('Y/m/d H:i:s');
            $gear->gear_category = $request->gear_category;

//            ここに投稿者のuser_idを代入するようにする。
//            https://stackoverflow.com/questions/50603064/current-users-id-in-laravel-api/50603185
//
//            こちら側のエラーは。
//            class: "Illuminate\Foundation\Bootstrap\HandleExceptions"
//file: "/Users/eijitakahashi/PhpstormProjects/GearLab/app/Http/Controllers/GearApiController.php"
//function: "handleError"
//line: 65
//type: "->"になるかと思います。

//            chromeで確認しました。
//            $gear->user_id = auth('api')->user()->id;
            $gear->user_id = $request->user_id;
            $gear->save();

            return ['success' => '登録しました!'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $gear = Gear::find($id);
        if ($gear) {
            return response()->json([
                'message' => 'ok',
                'data' => $gear
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'message' => 'Gear not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Gear $gear)
    {
        $gear->update($request->all());
        return $gear; //更新したデータを返す。
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $gear = Gear::where('id', $id)->delete();
        if ($gear) {
            return response()->json([
                'message' => 'Gear deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Gear not found',
            ], 404);
        }
    }
}
