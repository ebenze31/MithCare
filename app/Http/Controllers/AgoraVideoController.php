<?php


namespace App\Http\Controllers;
use Willywes\AgoraSDK\RtcTokenBuilder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Classes\AgoraDynamicKey\RtcTokenBuilder;
// use Classes\AgoraDynamicKey\RtcTokenBuilder;
use App\Events\MakeAgoraCall;

class AgoraVideoController extends Controller
{
    public function index(Request $request)
    {
        // fetch all users apart from the authenticated user
        $users = User::where('id', '<>', Auth::id())->get();
        return view('test.test_video_2', compact('users'));
    }

    public function token(Request $request)
    {
        $login_id = Auth::id();

        $appID = 'acb41870f41c48d4a42b7b0ef1532351';
        $appCertificate = '41aa313ac49f4e3d81f1a3056e122ca0';
        $channelName = 'MithCare';
        $user = $login_id;
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = now()->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        // $token = [$appID,$appCertificate,$channelName,$user,$expireTimeInSeconds,$currentTimestamp,$privilegeExpiredTs,$role];
        $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $user, $role, $privilegeExpiredTs);

        if($token){
            $token = $token;
        }else{
            $token = "ไม่มี TOKEN";
        }

        return $token;
    }


    public function callUser(Request $request)
    {
        $data['userToCall'] = $request->user_to_call;
        $data['channelName'] = $request->channel_name;
        $data['from'] = Auth::id();

        broadcast(new MakeAgoraCall($data))->toOthers();
    }

    public function getUserRemote(Request $request)
    {
        $requestData = $request->all();
        $users = User::where('id', $requestData['userId'])->first();

        return $users;
    }

}
