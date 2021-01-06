<?php


namespace App\Repositories\Gear;

use App\Models\Gear;
use Illuminate\Http\Request;
//EloquentORM
class GearDataAccessEQRepository implements GearDataAccessRepositoryInterface
{
    /**
     * Gearテーブルからデータをすべて取得
     *::
     */
    public function getAll()
    {
        $gears = Gear::with(['user','likes'])->get();
        return $gears;
    }

    /**
     * Gearテーブルから特定のユーザーのギアを取得
     * updated_atの新しいものから表示するようにする。
     *
     * @param $user_id
     */
    public function getUser($user_id)
    {

        return Gear::with(['user','likes'])->where('user_id', $user_id)->orderby('updated_at', 'desc')->get();

    }

    /**
     * @param $category
     * @return mixed
     */

    public function getCategorizedGear($category)
    {
        return Gear::with(['user','likes'])->where('gear_category', $category)->orderby('updated_at', 'desc')->get();

    }

    /**
     * @param $id
     * @return mixed
     */
    public function findAll($id)
    {
        return Gear::find($id);
    }

    public function updateGear(Request $request, Gear $gear)
    {
        $gear->update($request->all());

        return $gear;
    }

    public function UpdateSelect($id, $key, $value)
    {
        //すでにwhere　idで指定ししたtaskを更新する。
        return Gear::with(['user','likes'])->where("id", $id)->update([$key => $value]);

    }

    public function deleteSelect($id)
    {

        return Gear::where('id', $id,)->delete();
    }

    public function WhereGetSelect($select_key, $id)
    {

        return Gear::where($select_key, $id,)->get();
    }

}
