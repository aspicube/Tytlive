<?php

namespace App\Http\Controllers\Image;
use Illuminate\Support\Facades\Auth;
use App\Applets\QRcode;
use Illuminate\Http\Request;
use App\Model\Image;
use App\Http\Requests;
use App\Model\SiteConfig;
use App\Http\Controllers\Controller;

class imageController extends Controller
{
    public function getMain($imgId)
    {
        $imgName = Image::where('index', '=', $imgId)->first();
        if($imgName)
        {
            $filename = 'img/'.($imgName->path);
            $size = getimagesize($filename); //获取mime信息
            $fp=fopen($filename, "rb"); //二进制方式打开文件
            if ($size && $fp) {
            header("Content-type: {$size['mime']}");
            fpassthru($fp); // 输出至浏览器
            exit;
            }else {
                //error
            }
        }
        else return 'false';
    }
    public function getQrcode($cmd)
    {
        if($cmd == 'bindwechat')
        {
            if(Auth::guest())return 'error';
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?';
            $appid = SiteConfig::find(1)->appid;
            $redirect = urlencode(url('/user/bindwx'));
            $response_type = 'code';
            $scope = 'snsapi_userinfo';
            $state = Auth::user()->id;
            $url = $url.'appid='.$appid.'&redirect_uri='.$redirect.'&response_type='.$response_type;
            $url = $url.'&scope='.$scope.'&state='.$state.'#wechat_redirect';
            return QRcode::png($url);
                //=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect
        }else return 'error';
    }
    public function postUpload(Request $request)
    {
        $imgid = $request->input('imgid');
        $imgpath = $request->input('imgpath');
        $image = $request->input('image');
        
    }
}
