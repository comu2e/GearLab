<?php

namespace App\Repositories\Gear;

use App\Models\Gear;
use Illuminate\Http\Request;

interface GearDataAccessRepositoryInterface
{

    public function getAll();
    public function getUser($user_id);
    public function getCategorizedGear($category);
    public function findAll($id);
    public function updateGear(Request $request, Gear $gear);
    public function deleteSelect($id);
    public function WhereGetSelect($select_key,$id);
    public function UpdateSelect($id,$key,$value);


}
