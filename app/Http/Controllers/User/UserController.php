<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\WxUsers;
use App\Model\LiveInfo;
use App\Model\User;
use App\Model\Wxtemp;
use App\Model\SiteConfig;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Applets\WspCurl;

class UserController extends Controller
{
    //
    public function getindex()
    {
        if(Auth::guest())return redirect('/');
        $userId = Auth::user()->id;
        $userInfo = Auth::user();
        $wxuser = WxUsers::where('userid', '=', $userId)->first();
        if(!$wxuser){
            $cwxuser = new WxUsers();
            $cwxuser->userid = $userId;
            $cwxuser->save();
        }
        $wxuser = WxUsers::where('userid', '=', $userId)->first();
        $liveinfo = LiveInfo::where('author', '=', $userId)->first();
        return view('user.index',['user'=>$userInfo,'userinfo'=>$wxuser,'liveinfo'=>$liveinfo]);
    }
    public function postEditinfo(Request $request)
    {
        if(Auth::guest())return redirect('/');
        $userId = Auth::user()->id;
        $userInfo = User::find($userId);
        if($request->input('name'))
        $userInfo->name = $request->input('name');
        return redirect('/user');
    }
    public function getBindwx(Request $request)
    {
        $code = $request->input('code');
        $state = $request->input('state');
        if(!$code)return '授权失败';
        $session_id = mt_rand(100000,999999);

        $url_getaccess = 'https://api.weixin.qq.com/sns/oauth2/access_token?';
        $appid = SiteConfig::find(1)->appid;
        $appsecret = SiteConfig::find(1)->appsecret;
        $url_getaccess = $url_getaccess.'appid='.$appid.'&secret='.$appsecret.'&code='.$code;
        $url_getaccess = $url_getaccess.'&grant_type=authorization_code';
        //appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code
        //获取用户信息
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url_getaccess);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $access = curl_exec($ch);
        $accessinfo = jason_decode($access);
        curl_close($ch);
        if(!$access)return '访问微信服务器失败';
        //拉取用户信息

        //新建微信绑定条目
        $openid = $accessinfo['openid'];
        if(WxUsers::where('openid','=',$openid)->first())return '此微信号已被绑定';
        $wxtemp = new Wxtemp;
        $wxtemp->userid = $state;
        $wxtemp->session_id = $session_id;
        $wxtemp->wx_openid = $accessinfo['openid'];
        $wxtemp->set_time = time();
        //返回验证码
        return '您的天眼通微信绑定验证码为：'.$session_id.'，请两分钟内在网页端填写验证码绑定微信。';
    }
    public function postWxsubmit(Request $request)
    {
        $session_id = $request->input('session_id');
        $user_id = Auth::user()->id;
        $wxtemp = Wxtemp::where('userid','=',$user_id)->first();
        if($wxtemp&&(time()-$wxtemp->set_time < 120) && $wxtemp->session_id = $session_id)
        {
            $wxuser = WxUsers::where('userid','=',$user_id)->first();
            $wxuser->wx_openid = $wxtemp->openid;
            $wxuser->update_time = time();
            $wxuser->save();
        }
        return redirect('user');
    }
    public function getlive()
    {
        if(Auth::guest())return redirect('/');
        $userId = Auth::user()->id;
        $userInfo = Auth::user();
        $wxuser = WxUsers::where('userid', '=', $userId)->first();
        if(!$wxuser){
            $cwxuser = new WxUsers();
            $cwxuser->userid = $userId;
            $cwxuser->save();
        }
        $wxuser = WxUsers::where('userid', '=', $userId)->first();
        $liveinfo = LiveInfo::where('author', '=', $userId)->first();
        return view('user.live',['user'=>$userInfo,'userinfo'=>$wxuser,'liveinfo'=>$liveinfo]);
    }
    public function postNewlive(Request $request)
    {
        if(Auth::guest())return 'false';
        $livename = $request->input('name');
        $category = $request->input('category');
        $intro = $request->input('intro');
        $pic = $request->input('pic');
        $long_intro = $request->input('long_intro');
        $id = Auth::user()->id;
        $wspkey = SiteConfig::find(1)->wspcode;
        $url = 'services/key/'.$wspkey;
        $rst = WspCurl::wspCurl($url);
        if(!empty($rst['Info'])){
            $wxUid = $rst['Info']['wxUid'];
            $wxOpenId = $rst['Info']['wxOpenId'];
            $wxNick = $rst['Info']['wxNick'];
            $url = 'channels/auto';
            $data = array(
                'nick'=>strval($wxNick)
            );
            $rst = WspCurl::wspCurl($url,$data,array('Content-Type: application/json'),'POST',$wxUid,$wxOpenId);
        }else return 'false';
        $liveinfo = new LiveInfo();
//        "list" : [
//    {
//        "id" : 309,
//      "dmsPubKey" : "pub_6c12a0bb273fb9cf5ad77c6727d7d632",
//      "dmsAppKey" : "558",
//      "dmsSecKey" : "s_207112d53c813b2d22231b2ee960f2da",
//      "lssApp" : "wsp_4640_1435544235",
//      "lssStream" : "fb358ae5b2283e16f75259af896d74cb",
//      "title" : "醉",
//      "dmsSubKey" : "sub_0960ad1ee41512b3951c1b6a1d4a1c86",
//      "time" : 1435544237,
//      "surfaceUrl" : "776167fc170b744af1067b5a9e4498d8",
//      "living" : 0,
//      "state" : 1,
//      "lcpsName" : "",
//      "lcpsExpire" : 0,
//      "loginKey" : "f32d7c6bdac098da23720b65efa80e1e",
//      "Freeze" : 0,
//      "WSP_id" : 225,
//      "wxNick" : "醉"
//    }
        $liveinfo->cid = $rst['id'];
        $liveinfo->name = $livename;
        $liveinfo->url = url('/u/'.$id);
        $liveinfo->pic = $pic;
        $liveinfo->info_short = $intro;
        $liveinfo->info_long = $long_intro;
        $liveinfo->category = $category;
        $liveinfo->author = $id;
        $liveinfo->playing = false;
        $liveinfo->lssApp = $rst['lssApp'];
        $liveinfo->lssStream = $rst['lssStream'];
        $liveinfo->dmsPubKey = $rst['dmsPubKey'];
        $liveinfo->dmsAppKey = $rst['dmsAppKey'];
        $liveinfo->dmsSecKey = $rst['dmsSecKey'];
        $liveinfo->dmsSubKey = $rst['dmsSubKey'];
        $liveinfo->loginKey = $rst['loginKey'];
        $liveinfo->save();
        return redirect('user/live');
    }
    public function getLiveControl($c)
    {
        if($c == 'start')
        {
            if(Auth::guest())return 'false';
            $id = Auth::user()->id;
            $liveinfo = LiveInfo::where('author', '=', $id)->first();
            if(!$liveinfo)return 'false';
            if($liveinfo->playing == 1)return redirect('user/live');

            
        }elseif ($c == 'stop')
        {

        }
        else return 'flase';
    }
}
