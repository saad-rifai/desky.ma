<?php

namespace App\Http\Controllers;

use App\chat_system;
use App\Offers;
use App\Orders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class ChatSystemController extends Controller
{
    public function paginate($items,$perPage, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    public function NewMessageInsideProject(Request $request)
    {
        $this->validate($request, [
            'OID' => 'required|integer',
            'to' => 'required|integer',
            'message' => 'required|max:1500|min:1',
        ], $messages = [
            'OID.required' => 'طلب خاطئ يرجى اعادة تحميل الصفحة',
            'to.required' => 'طلب خاطئ يرجى اعادة تحميل الصفحة',

            'OID.integer' => 'طلب خاطئ يرجى اعادة تحميل الصفحة',
            'to.integer' => 'طلب خاطئ يرجى اعادة تحميل الصفحة',

            'message.required' => 'يرجى كتابة رسالة',
            'message.min' => 'يرجى كتابة رسالة',
            'message.max' => 'الرسالة أطول من اللازم الحد الأقصى 1500 حرف',
        ]);

        $destinationCeck = User::where("Account_number", $request->to)->count();
        $oidCeck = Orders::where('OID', $request->OID)->where('status', '!=', '5')->count();
        $oidOwnerCeck = Orders::where('OID', $request->OID)->where('Account_number', Auth::user()->Account_number)->where('status', '!=', '5')->count();

        if ($oidCeck > 0 && $destinationCeck > 0) {
            if ($oidOwnerCeck > 0) {
                $destinationCeck2 = Offers::where('OID', $request->OID)->where('Account_number', $request->to)->whereIn('status', ['1', '2', '3'])->count();
                if ($destinationCeck2 > 0) {
                    $stmt = chat_system::create([
                        'OID' => $request->OID,
                        'from' => Auth::user()->Account_number,
                        'to' => $request->to,
                        'type' => "1",
                        'message' => $request->message,
                        'status' => "0"
                    ]);
                } else {
                    return response()->json(['error' => 'لايمكنك ارسال الرسالة لهذا المقاول لأنك لم توظفه على هذا المشروع.'], 400);
                }
            } else {

                /* If Is hired in Project */
                $destinationCeck2 = Offers::where('OID', $request->OID)->where('Account_number', Auth::user()->Account_number)->whereIn('status', ['1', '2'])->count();
                if ($destinationCeck2 > 0) {
                    $stmt = chat_system::create([
                        'OID' => $request->OID,

                        'from' => Auth::user()->Account_number,
                        'to' => $request->to,
                        'type' => "1",
                        'message' => $request->message,
                        'status' => "0"
                    ]);
                } else {
                    return response()->json(['error' => 'لايمكنك ارسال الرسالة لهذا الحساب لانه لم يقم بتوظيفك.'], 400);
                }
            }
        } else {
            return response()->json(['error' => 'طلب خاطئ لا يمكن ارسال الرسالة !'], 400);
        }
    }
    public function ProjectGetChatList(Request $request)
    {
        if (isset($request->OID)) {
            $OrderOwnerCeck = Orders::where('OID', $request->OID)->where('Account_number', Auth::user()->Account_number)->count();
            if ($OrderOwnerCeck > 0) {
                $Destination = Offers::where('OID', $request->OID)->whereIn('status', ['1', '2', '3'])->get(['Account_number']);

                /* Count New Messages */
                //  foreach($GetDestinations as $Destination);
                for ($i = 0; $i < $Destination->count(); $i++) {
                    $IsOnline = User::isOnline($Destination[$i]->Account_number);
                    $NewMessagesSended = chat_system::where('from', $Destination[$i]->Account_number)->where('to', Auth::user()->Account_number)->whereIn('status', ['0', '1'])->count();
                    $Destination[$i]->NewMessages = $NewMessagesSended;
                    $acNumber = $Destination[$i]->Account_number;
                    $LastMessage = chat_system::where(function ($qu) use ($request, $acNumber) {
                        $qu->where('OID', $request->OID)->where('type', "1")
                            ->where('from', $acNumber);
                    })->orWhere(function ($qu) use ($request, $acNumber) {
                        $qu->where('OID', $request->OID)->where('type', "1")
                            ->where('to', $acNumber);
                    })->orderBy('created_at', 'DESC')->first();
                    if (isset($Destination[$i])) {
                        $Destination[$i]->IsOnline = $IsOnline;
                        if (isset($LastMessage->message)) {
                            $Destination[$i]->LastMessage = $LastMessage->message;
                        } else {
                            $Destination[$i]->LastMessage = null;
                        }
                    }
                    $UserInfos = User::where("Account_number", $Destination[$i]->Account_number)->get(['avatar', 'frist_name', 'last_name', 'Account_number']);
                    foreach ($UserInfos as $UserInfo);
                    $Destination[$i]->FromInfo = $UserInfo;
                    if (isset($LastMessage->created_at)) {
                        $Destination[$i]->date = $LastMessage->created_at;
                    } else {
                        $Destination[$i]->date = null;
                    }
                }

                $data =  $Destination->sortBy("date");
                return response()->json(['data' => $data], 200);
            } else {
                return response()->json(['error' => 'طلب خاطئ !'], 400);
            }
        } else {
            return response()->json(['error' => 'bad request'], 400);
        }
    }
    public function ProjectChatRoom(Request $request)
    {
        if (isset($request->OID) && isset($request->to) && isset($request->count)) {
            $ChatsData = chat_system::where(function ($qu) use ($request) {
                $qu->where('OID', $request->OID)->where('type', "1")
                    ->where('from', $request->to)
                    ->where('to', Auth::user()->Account_number);
            })->orWhere(function ($qu) use ($request) {
                $qu->where('OID', $request->OID)->where('type', "1")
                    ->where('to', $request->to)
                    ->where('from', Auth::user()->Account_number);
            })->orderBy('created_at', 'DESC')->paginate($request->count);
            $IsOnline = User::isOnline($request->to);
            // foreach ($ChatsData as $ChatData);
            for ($i = 0; $i < $ChatsData->count(); $i++) {
                $ChatsData[$i]->date = date("Y-m-d H:i:s", strtotime($ChatsData[$i]->created_at));
            }

            $UpdateMessagesStatus = chat_system::where('OID', $request->OID)->where('from', $request->to)->update(['status' => '2']);
            return response()->json(['data' => $ChatsData, 'IsOnline' => $IsOnline], 200);
        } else {
            return response()->json(['error' => 'طلب خاطئ !'], 400);
        }
    }
    public function MessagesChatList(Request $request)
    {
        if(isset($request->perPage)){

        }else{
            $request->perPage = 10; 
        }
        $messages = chat_system::where('type', '0')->where(function ($query) {
            $query->where('to', Auth::user()->Account_number)
                ->orWhere('from', Auth::user()->Account_number);
        })->orderBy('created_at', 'DESC')->get()->unique('room_id');
        
        $messages = json_decode(json_encode($messages), true);
        $messages = array_values($messages);
        for ($i = 0; count($messages) > $i; $i++) {
            $messages = json_decode(json_encode($messages), false);



            if ($messages[$i]->to != Auth::user()->Account_number) {

                $UserInfos = User::where('Account_number', $messages[$i]->to)->get(['avatar', 'frist_name', 'last_name']);
                foreach ($UserInfos as $UserInfo);
                $messages[$i]->userInfos = $UserInfo;
                $messages[$i]->IsOnline = User::isOnline($messages[$i]->userInfos->Account_number);
            } elseif ($messages[$i]->from != Auth::user()->Account_number) {
                $UserInfos = User::where('Account_number', $messages[$i]->from)->get(['avatar', 'frist_name', 'last_name']);
                foreach ($UserInfos as $UserInfo);
                $messages[$i]->userInfos = $UserInfo;
                $messages[$i]->IsOnline = User::isOnline($messages[$i]->userInfos->Account_number);
            }
        }
        $updateStatus = chat_system::where('type', '0')->where('status', '0')->where('to', Auth::user()->Account_number)->update(['status' => '1']);
        $data = $this->paginate($messages, $request->perPage);
        return response()->json(['data' => $data], 200);

    }
    public function GetConversation(Request $request)
    {
        if (isset($request->room_id) && isset($request->paginate)) {


            $ConversationData = chat_system::where('room_id', $request->room_id)->where('type', '0')->where(function ($query) {
                $query->where('to', Auth::user()->Account_number)
                    ->orWhere('from', Auth::user()->Account_number);
            })->orderBy('created_at', 'DESC')->paginate($request->paginate);
            $UserInfos = null;
            if (count($ConversationData) > 0) {
                for ($i = 0; $i < count($ConversationData); $i++) {
                    $ConversationData[$i]->date = date("Y-m-d H:i:s", strtotime($ConversationData[$i]->created_at));
                }
                foreach ($ConversationData as $data);
                if ($data->to != Auth::user()->Account_number) {
                    $UserInfos = User::where('Account_number', $data->to)->get(['avatar', 'frist_name', 'last_name']);
                    foreach ($UserInfos as $UserInfo);
                    $UserInfo->IsOnline = User::isOnline($data->to);
                } elseif ($data->from != Auth::user()->Account_number) {
                    $UserInfos = User::where('Account_number', $data->from)->get(['avatar', 'frist_name', 'last_name']);
                    foreach ($UserInfos as $UserInfo);

                    $UserInfo->IsOnline = User::isOnline($data->from);
                }
            }

            $ConversationDataUpdate = chat_system::where('room_id', $request->room_id)->where('type', '0')->where('to', Auth::user()->Account_number)->update(['status' => '2']);
            return response()->json(['data' => $ConversationData, 'UserInfos' => $UserInfo], 200);
        } else {
            return response()->json(['error' => 'bad Request'], 400);
        }
    }
    public function SendMessage(Request $request){
        $this->validate($request, [
            'room_id' => 'required|integer',
            'message' => 'required|max:1500|min:1',
        ], $messages = [
            'room_id.required' => 'طلب خاطئ يرجى اعادة تحميل الصفحة',

            'room_id.integer' => 'طلب خاطئ يرجى اعادة تحميل الصفحة',

            'message.required' => 'يرجى كتابة رسالة',
            'message.min' => 'يرجى كتابة رسالة',
            'message.max' => 'الرسالة أطول من اللازم الحد الأقصى 1500 حرف',
        ]);
        $Rooms = chat_system::where('room_id', $request->room_id)->where('type', '0')->where(function ($query) {
            $query->where('to', Auth::user()->Account_number)
                ->orWhere('from', Auth::user()->Account_number);
        })->first();
        if($Rooms->count() > 0){
            if($Rooms->to != Auth::user()->Account_number){
                $to = $Rooms->to;
            }elseif($Rooms->from != Auth::user()->Account_number){
                $to = $Rooms->from;

            }else{
                $to = null;
            }
            if($to != null){
                $stmt = chat_system::create([
                    'room_id' => $request->room_id,
                    'type' => '0',
                    'from' => Auth::user()->Account_number,
                    'to' => $to,
                    'message' => $request->message,
                    'status' => '0'
                ]);
                if($stmt){
                    return response()->json(['success' => 'success'], 200);

                }else{
            return response()->json(['error' => 'server error'], 500);

                }
            }else{
            return response()->json(['error' => 'bad Reuqest'], 400);

            }

        }else{
            return response()->json(['error' => 'bad Reuqest'], 400);
        }
    }
}
