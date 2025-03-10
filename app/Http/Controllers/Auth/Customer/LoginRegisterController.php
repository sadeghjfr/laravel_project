<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SMSService;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm()
    {
        return view('auth.customer.login-register');
    }

    public function loginRegister(LoginRegisterRequest $request)
    {
        $inputs = $request->all();
        $type = $this->determineInputType($inputs['id']);

        if ($type === null) {
            return redirect()->route('auth.customer.login-register-form')
                ->withErrors('ورودی باید شماره موبایل یا ایمیل معتبر باشد');
        }

        $user = $this->findOrCreateUser($inputs, $type);
        $otpCode = rand(111111, 999999);
        $token = Str::random(60);

        $this->createOtp($user->id, $inputs['id'], $type, $otpCode, $token);
        $this->sendOtp($type, $inputs['id'], $otpCode, $user);

        return redirect()->route('auth.customer.login-confirm-form', $token);
    }

    public function loginConfirmForm($token)
    {
        $otp = Otp::where('token', $token)->first();

        if (empty($otp)) {
            return redirect()->route('auth.customer.login-register-form')
                ->withErrors(['id' => 'اطلاعات وارد شده نامعتبر می باشد']);
        }

        return view('auth.customer.login-confirm', compact('token', 'otp'));
    }

    public function loginConfirm($token, LoginRegisterRequest $request)
    {
        $inputs = $request->all();
        $otp = $this->findValidOtp($token, $inputs['otp']);

        if (!$otp) {
            return redirect()->route('auth.customer.login-confirm-form', $token)
                ->withErrors(['otp' => 'کد وارد شده نامعتبر می باشد']);
        }

        $otp->update(['used' => 1]);
        $user = $otp->user()->first();
        $this->markUserAsVerified($user, $otp->type);

        Auth::login($user);
        return redirect()->route('customer.home');
    }

    public function loginResendOtp($token)
    {
        $otp = Otp::where('token', $token)
            ->where('created_at', '<=', Carbon::now()->subMinutes(5)->toDateTimeString())
            ->first();

        if (empty($otp)) {
            return redirect()->route('auth.customer.login-register-form', $token)
                ->withErrors(['id' => 'اطلاعات وارد شده نامعتبر می باشد']);
        }

        $user = $otp->user()->first();
        $otpCode = rand(111111, 999999);
        $newToken = Str::random(60);

        $this->createOtp($user->id, $otp->login_id, $otp->type, $otpCode, $newToken);
        $this->sendOtp($otp->type, $otp->login_id, $otpCode, $user);

        return redirect()->route('auth.customer.login-confirm-form', $newToken);
    }

    public function logout(){

        Auth::logout();
        return redirect()->route('customer.home');
    }



    // Helper Functions

    private function determineInputType($input)
    {
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return 1; // 1 => email
        }

        if (preg_match('/^(?:\+98|98|0)?(9\d{9})$/', $input, $matches)) {
            return 0; // 0 => mobile
        }

        return null;
    }

    private function findOrCreateUser($inputs, $type)
    {
        $field = ($type === 1) ? 'email' : 'mobile';
        $user = User::where($field, $inputs['id'])->first();

        if (empty($user)) {
            $newUser = [
                $field => $inputs['id'],
                'password' => '98355154',
                'activation' => 1,
            ];
            return User::create($newUser);
        }

        return $user;
    }

    private function createOtp($userId, $loginId, $type, $otpCode, $token)
    {
        Otp::create([
            'otp_code' => $otpCode,
            'token' => $token,
            'user_id' => $userId,
            'login_id' => $loginId,
            'type' => $type,
        ]);
    }

    private function sendOtp($type, $loginId, $otpCode, $user)
    {
        if ($type === 0) {
            $smsService = new SMSService();
            $smsService->setTo('0' . $user->mobile);
            $smsService->setText('فروشگاه آمازون');
            $smsService->setIsFlash(true);
            $messageService = new MessageService($smsService);
        } else {
            $emailService = new EmailService();
            $details = [
                'title' => 'فعال سازی حساب کاربری',
                'body' => "کد فعال سازی شما : $otpCode",
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@example.com', 'فروشگاه آمازون');
            $emailService->setSubject('ورود به حساب کاربری');
            $emailService->setTo($loginId);
            $messageService = new MessageService($emailService);
        }

        $messageService->send();
    }

    private function findValidOtp($token, $otpCode)
    {
        return Otp::where('token', $token)
            ->where('used', 0)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())
            ->where('otp_code', $otpCode)
            ->first();
    }

    private function markUserAsVerified($user, $type)
    {
        if ($type === 1 && empty($user->email_verified_at)) {
            $user->update(['email_verified_at' => now()]);
        } elseif ($type === 0 && empty($user->mobile_verified_at)) {
            $user->update(['mobile_verified_at' => now()]);
        }
    }
}
