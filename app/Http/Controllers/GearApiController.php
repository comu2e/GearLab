<?php


namespace App\Http\Controllers;

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

//Repositoryパターンの追加
use App\Repositories\Gear\GearDataAccessRepositoryInterface AS GearDataAccess;


class GearApiController extends Controller
{

    protected $Gear;

    /**
     * GearApiController constructor.
     * @param GearDataAccess $GearDataAccess
     */

    public function __construct(GearDataAccess $GearDataAccess)
    {
        $this -> Gear = $GearDataAccess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $gear = Gear::all();

        $gear = $this -> Gear -> getAll();

        return response()->json([
            'message' => 'ok',
            'data' => $gear
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display a listing of the user Gear.
     *
     * @return Response
     */
    public function user_index($user_id)
    {
//        $gears = Gear::where('user_id', $user_id)->orderby('updated_at', 'desc')->get();
        $gears = $this -> Gear -> getUser($user_id);

        return response()->json([
            'message' => 'ok',
            'data' => $gears
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
    /**
     * Display a listing of the categorized Gear.
     *
     * @return Response
     */
    public function categorize_gear($category)
    {
//        $gears = Gear::where('gear_category', $category)->orderby('updated_at', 'desc')->get();
        $gears = $this -> Gear -> getCategorizedGear($category);
        return response()->json([
            'message' => 'ok',
            'data' => $gears
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
//        $gear = Gear::find($id);
        $gear = $this -> Gear ->findAll($id);

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
//        $gear->update($request->all());
        $gear = $this -> Gear ->updateGear($request,$gear);

        return $gear;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
//        $gear = Gear::where('id', $id)->delete();
        $gear = $this -> Gear ->deleteSelect($id);


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
