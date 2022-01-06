<?php

namespace App\Http\Controllers;

use App\AeAccount;
use App\FilesToRemove;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UpdateAvatar(Request $request)
    {
        // dd($request->avatar);

        $this->validate($request, [
            'avatar' => 'required|mimes:jpeg,png,jpg|max:1000',

        ], $message = [
            'mimes' => 'هذا الملف غير مدعوم مسموح فقط بي (PNG, JPG,JPEG) 3',
            'required' => 'يرجى تحميل الصورة الشخصية',
            'max' => 'هذا الملف أكبر من اللازم الحد الأقصى (1 MB)',
        ]);
        $image_type = $request->avatar->extension();
        $folderPath = "img/users/" . date("Y") . '/';
        $filname =  Auth::user()->Account_number . '-' . uniqid() . '.' . $image_type;
        $avatar = $request->avatar;
        $upload_success = $request->file('avatar')->store('avatar', 's3');

      //  $upload_success = $avatar->move($folderPath, $filname);
       

        if ($upload_success) {
           $AvatarUrlS3 = Storage::disk('s3')->url($upload_success);
            $stmt = User::where('email', auth::user()->email)->where('Account_number', auth::user()->Account_number)->update(['avatar' => "$AvatarUrlS3"]);
            if ($stmt) {
                Cache::forget(Auth::user()->username . 'PP');
                if(Auth::user()->avatar != null && Auth::user()->avatar != ""){
                    FilesToRemove::create([
                        'filepath' => Auth::user()->avatar,
                        'date_to_remove' => Carbon::now()->addDay()
                    ]);
                }

               // $S3Link = Storage::disk('s3')->temporaryUrl($upload_success, now()->addMinutes(10));
                return response()->json(['success' => 'تم تحديث الصورة الشخصية بنجاح '], 200);
            } else {
                return response()->json(['error' => 'فشل تحديث الصورة الشخصية يرجى اعادة المحاولة fx0500124'], 500);
            }
        } else {

           
            return response()->json(['error' => 'فشل تحديث الصورة الشخصية يرجى اعادة المحاولة fx0500159'], 500);
        }
    }
    public function UpdateProfile(Request $request)
    {
        if (preg_match('/\+?[0-9][0-9()\-\s+]{8,20}[0-9]/', $request->description)) {
            return response()->json(['errors' => ['description' => [0 => ' للحفاظ على أمان مجتمعنا يمنع مشاركة رقم الهاتف أو أي معلومات تواصل خارجية, رجاءا لاتقم بمشاركة أي معلومات تواصل خارجية لتجنب حضر حسابك']]], 422);
        }

        if (preg_match('/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/si', $request->description))
        {
            return response()->json(['errors' => ['description' => [0 => 'للحفاظ على أمان مجتمعنا يمنع مشاركة البريد الالكتروني أو أي معلومات تواصل خارجية, رجاءا لاتقم بمشاركة أي معلومات تواصل خارجية لتجنب حضر حسابك']]], 422);
        } 
        if(isset($request->username)){
            $request->username  = Str::lower($request->username);
        }
        $this->validate($request, [
            'username' => 'required|min:6|max:25|regex:/^[a-z0-9][a-z0-9_.-]*[a-z0-9]$/',
            'description' => 'nullable|min:15|max:700|string',
            'type' => 'required|integer|max:2|min:1',
            
        ], $message = [
            'required' => 'هذا الحقل مطلوب *',
            'username.min' => 'يجب أن يتكون اسم المستخدم من 6 حروف على الأقل *',
            'username.max' => 'اسم المستخدم أطول من اللازم الحد الأقصى 15 حرف *',
            'username.regex' => 'يرجى ادخال اسم مستخدم صالح يسمح فقط بالحروف اللاتينية والأرقام وهذه الرموز (._-) *',
            'required' => 'هذا الحقل مطلوب *',
            'description.min' => 'يرجى ادخال وصف كافي 25 حرف على الأقل *',
            'description.max' => 'الوصف اللذي ادخلته أطول من اللازم الحد الأقصى 500 حرف *',
            'type.integer' => 'يرجى تحديد نوع الحساب *',
            'type.max' => 'يرجى تحديد نوع الحساب *',
            'type.min' => 'يرجى تحديد نوع الحساب *',

        ]);

        $stmt = User::where('id', auth::user()->id)->where('Account_number', auth::user()->Account_number)->update([
            'username' => $request->username,
            'description' => $request->description,
            'type' => $request->type
        ]);
        if ($stmt) {
           Cache::forget($request->username.'PP');
            return response()->json(['success' => 'تم حفظ البيانات بنجاح !'], 200);
        } else {
            return response()->json(['error' => 'فشل تحديث البيانات'], 500);
        }
    }
    public function UpdateAccount(Request $request)
    {
        //Validate User Data

        $this->validate(
            $request,
            [
                'User__fname' => 'required|min:3|max:11|regex:/^[\p{L} ]+$/u',
                'User__lname' => 'required|min:3|max:11|regex:/^[\p{L} ]+$/u',
                'User__phone' => 'required|regex:/[0-9]{9}/|unique:users,phone_number,' . auth::user()->id . '|max:10',
                'User__cities' => 'required|max:5|regex:/^[\p{L} 0-9]+$/u',
                'User__gender' => 'required|integer|max:2|min:1',
                'User__date_of_birth' => 'date|nullable',
            ],
            $message = [
                'required' => 'هذا الحقل مطلوب *',
                'date' => 'يرجى ادخال تاريخ ازدياد صالح *',
                'User__fname.min' => ' يرجى ادخال اسم صالح *',
                'User__fname.regex' => ' يرجى ادخال اسم صالح *',
                'User__fname.max' => 'الاسم أطول من اللازم *',

                'User__lname.max' => 'الاسم أطول من اللازم *',
                'User__lname.min' => ' يرجى ادخال اسم صالح *',
                'User__lname.regex' => ' يرجى ادخال اسم صالح *',

                'User__phone.unique' => 'رقم الهاتف الذي ادخلته مسجل من قبل بحساب أخر *',
                'User__phone.regex' => 'يرجى ادخال رقم هاتف صالح مثال: (0601020304) *',
                'User__phone.max' => 'رقم الهاتف الذي ادخلته أطول من اللازم يجب أن يتكون من 10 أرقام مثال: (0601020304) *',

                'User__cities.regex' => ' يرجى تحديد المدينة *',
                'User__cities.max' => ' يرجى تحديد المدينة *',

                'User__gender.max' => ' يرجى تحديد الجنس *',
                'User__gender.min' => ' يرجى تحديد الجنس *',
                'User__gender.integer' => ' يرجى تحديد الجنس *',

            ]
        );

        $stmt = User::where('id', auth::user()->id)->where('Account_number', auth::user()->Account_number)->update([
            'frist_name' => "$request->User__fname",
            'last_name' => "$request->User__lname",
            'phone_number' => "$request->User__phone",
            'city' => "$request->User__cities",
            'gender' => "$request->User__gender",
            'date_of_birth' => $request->User__date_of_birth,
            'verified_account' => null
        ]);
        if ($stmt) {
            $stmt2 = AeAccount::where('Account_number',Auth::user()->Account_number)->delete();
            return response()->json(['success' => 'تم حفظ البيانات بنجاح !'], 200);
        } else {
            return response()->json(['error' => 'فشل تحديث البيانات'], 500);
        }
    }
}
