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
use Illuminate\Support\Facades\Log;

use Storage;
use App\Http\Requests\GearRequest;

//Repositoryパターンの追加
use App\Repositories\Gear\GearDataAccessRepositoryInterface as GearDataAccess;


class GearApiController extends Controller
{

    protected $Gear;

    /**
     * GearApiController constructor.
     * @param GearDataAccess $GearDataAccess
     */

    public function __construct(GearDataAccess $GearDataAccess)
    {
        $this->Gear = $GearDataAccess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $gear = Gear::all();
        Log::debug('index');

        $gear = $this->Gear->getAll();

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
        $gears = $this->Gear->getUser($user_id);

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
        if ($category === 'All') {
            $gear = $this->Gear->getAll();

        } else {
            $gear = $this->Gear->getCategorizedGear($category);

        }
        return response()->json([
            'message' => 'ok categorize',
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
        Log::debug('API storeメソッドの実行');
        Log::debug($request);
        Log::debug(request());

        $this->validate($request, [
            'file' => 'required|image',
            'gear_name' => 'required',
            'gear_category' => 'required',
            'maker_name' => 'required',
            'content' => ['required', 'min:2'],

        ], [
            'file.required' => '画像が選択されていません',
            'file.image' => '画像ファイルではありません',
            'gear_category.required' => '登録するギアのカテゴリを選択してください',

            'gear_name.required' => '登録するギアの名前を入力してください',
            'maker_name.required' => '登録するギアのメーカ名を入力してください',
            'content.min' => 'ギアのお気に入りポイントを2文字以上入力してください',
            'content.required' => 'ギアのお気に入りポイントを入力してください',
        ]);
        Log::debug('$image = $request->file');
        Log::debug($image = $request->file('file'));
        Log::debug('=====');
        if ($request->hasFile('file')) {
            Log::debug('requstにfileがある時の処理');
            Log::debug(request()->file);

            $image = $request->file('file');
            $image_url = Storage::disk('s3')->put('/myprefix', $image, 'public');
            $gear = new Gear();
            $gear->image_url = Storage::disk('s3')->url($image_url);
            $gear->gear_name = $request->gear_name;
            $gear->maker_name = $request->maker_name;
            $gear->content = $request->content;
            $gear->youtube_url = self::replaceUrl($request->youtube_url);
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
        $gear = $this->Gear->findAll($id);

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
        $gear = $this->Gear->updateGear($request, $gear);

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
        $gear = $this->Gear->deleteSelect($id);


        if ($gear) {
            return response()->json([
                'message' => 'ギアの登録解除しました！',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Gear not found',
            ], 404);
        }
    }
    /**
     * youtubeのURLから埋め込みタグを生成する
     *
     * @param   string $param youtubeのURL
     * @return  string        埋め込みタグ
     */

    public function createvideotag(Request $request)
    {
        $param = $request ->youtube_url;
        //とりあえずURLがyoutubeのURLであるかをチェック
        if(preg_match('#https?://www.youtube.com/.*#i',$param,$matches)){
            //parse_urlでhttps://www.youtube.com/watch以下のパラメータを取得
            $parse_url = parse_url($param);
            // 動画IDを取得
            if (preg_match('#v=([-\w]{11})#i', $parse_url['query'], $v_matches)) {
                $video_id = $v_matches[1];
            } else {
                // 万が一動画のIDの存在しないURLだった場合は埋め込みコードを生成しない。
                return false;
            }
            $v_param = '';
            // パラメータにt=XXmXXsがあった時の埋め込みコード用パラメータ設定
            // t=〜〜の部分を抽出する正規表現は記述を誤るとlist=〜〜の部分を抽出してしまうので注意
            if (preg_match('#t=([0-9ms]+)#i', $parse_url['query'], $t_maches)) {
                $time = 0;
                if (preg_match('#(\d+)m#i', $t_maches[1], $minute)) {
                    // iframeでは正の整数のみ有効なのでt=XXmXXsとなっている場合は整形する必要がある。
                    $time = $minute[1]*60;
                }
                if (preg_match('#(\d+)s#i', $t_maches[1], $second)) {
                    $time = $time+$second[1];
                }
                if (!preg_match('#(\d+)m#i', $t_maches[1]) && !preg_match('#(\d+)s#i', $t_maches[1])) {
                    // t=(整数)の場合はそのままの値をセット ※秒数になる
                    $time = $t_maches[1];
                }
                $v_param .= '?start=' . $time;
            }
            // パラメータにlist=XXXXがあった時の埋め込みコード用パラメータ設定
            if (preg_match('#list=([-\w]+)#i', $parse_url['query'], $l_maches)) {
                if (!empty($v_param)) {
                    // $v_paramが既にセットされていたらそれに続ける
                    $v_param .= '&list=' . $l_maches[1];
                } else {
                    // $v_paramが既にセットされていなかったら先頭のパラメータとしてセット
                    $v_param .= '?list=' . $l_maches[1];
                }
            }
            // 埋め込みコードを返す
            return '<iframe width="600" height="338" src="https://www.youtube.com/embed/' . $video_id . $v_param . '" frameborder="0" allowfullscreen></iframe>';
        }
        // パラメータが不正(youtubeのURLではない)ときは埋め込みコードを生成しない。
        return false;
    }
    public static function replaceUrl($text)
    {
        $texts = explode(PHP_EOL, $text); //PHP_EOLは,改行コードをあらわす.改行があれば分割する
        $pattern = '/^https?:\/\/[^\s 　\\\|`^"\'(){}<>\[\]]*$/'; //正規表現パターン
        $replacedTexts = array(); //空の配列を用意

        foreach ($texts as $value) {
            $replace = preg_replace_callback($pattern, function ($matches) {
                //textが１行ごとに正規表現にmatchするか確認する
                if (isset($matches[1])) {
                    return $matches[0]; //$matches[0] がマッチした全体を表す
                }
                //既にリンク化してあれば置換は必要ないので、配列に代入
                return '<a href="' . $matches[0] . '" target="_blank" rel="noopener">' . $matches[0] . '</a>';
            }, $value);
            $replacedTexts[] = $replace;
            //リンク化したコードを配列に代入
        }
        return implode(PHP_EOL, $replacedTexts);
        //配列にしたtextを文字列にする
    }
}
