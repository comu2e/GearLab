<?php
namespace App\Repositories\Gear;
use App\Models\Gear;
use DB;
use Illuminate\Http\Request;

class GearDataAccessQBRepository implements GearDataAccessRepositoryInterface
{
    protected $table = 'gears';

    public function getAll()
    {
        return DB::table($this->table)->get();
    }
    /**
     * Gearテーブルから特定のユーザーのギアを取得
     * updated_atの新しいものから表示するようにする。
     *
     * @param $user_id
     */
    public function getUser($user_id)
    {

        return DB::table($this->table)->where('user_id', $user_id)->orderby('updated_at', 'desc')->get();

    }
    /**
     * @param $category
     * @return mixed
     */

    public function getCategorizedGear($category)
    {
        return DB::table($this->table)->where('gear_category', $category)->orderby('updated_at', 'desc')->get();

    }

    public function findAll($id)
    {
        return DB::table($this->table)->find($id);
    }

    public function updateGear(Request $request, Gear $gear)
    {
        return DB::table($this->table)->update($request->all());
    }


    public function deleteSelect($id)
    {

        return DB::table($this->table)->where('id',$id)->delete();
    }

    public function WhereGetSelect($select_key,$id){
        return DB::table($this->table)->where($select_key,$id)->get();

    }

    public function UpdateSelect($id,$key,$value)
    {
//        where　idで指定したタスクを更新する。（valueは0,1をとる）
//        keyはstatusをとる
        return  DB::table($this -> table ) -> where("id",$id)->update([$key=>$value]);

    }
}
