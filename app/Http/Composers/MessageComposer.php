<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class MessageComposer
{
    public function compose(View $view)
    {
        $view->with('categories', ['Cutting'=> 'Cutting', 'Shelter'=> 'Shelter', 'Fire'=> 'Fire','BackPack'=> 'BackPack','Kitchen'=>'Kitchen']);
    }
}
