<?php

namespace Modules\Wap\Http\Controllers;

use Illuminate\Routing\Controller as RouteController;

class Controller extends RouteController
{

    public function agent_id()
    {
        return \Session::get('agent_id');
    }


}
