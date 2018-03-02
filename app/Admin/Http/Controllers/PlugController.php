<?php
/**
 * Created by PhpStorm.
 * User: xzz
 * Date: 17-1-12
 * Time: 下午9:31
 */

namespace App\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;

class PlugController extends Controller
{
    public function uploadFile(Request $request)
    {
        $files = $request->file('file');
//        if (!is_array($files)){
//            return back()->with([
//                'alert-type'=>'success',
//
//            ]);
//        }
        foreach ($files as $file=>$v){
            Image::make($v->getRealPath())->save('shopImages/'.$v->getClientOriginalName());
            $arr[] = $v->getClientOriginalName();
        }
        return json_encode($arr);
    }
}




