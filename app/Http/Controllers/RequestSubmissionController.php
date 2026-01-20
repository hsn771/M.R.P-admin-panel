<?php

namespace App\Http\Controllers;

use App\Models\RequestSubmission;
use App\Models\Otp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Classes\sslSms;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RequestSubmissionController extends Controller
{
    private $smsClass;
    public function __construct()
    {
        $this->smsClass = new sslSms();
    }
    public function sendOTP(Request $request): JsonResponse
    {
        $data = $request->validate([
            'mobile_number' => ['required', 'string', 'max:20'],
        ]);
        
        if($data['mobile_number']){
            $phone = $data['mobile_number'];
            
            // Delete any existing OTPs for this mobile number
            Otp::where('mobile_number', $phone)->delete();
            
            // Generate new OTP
            $rand = rand(100000, 999999);
            $expiresAt = Carbon::now()->addMinutes(5);
            
            // Store OTP in database
            Otp::create([
                'mobile_number' => $phone,
                'otp' => (string)$rand,
                'expires_at' => $expiresAt,
            ]);
            
            // Send SMS
            $msg_text = "(A. K. R. ) আপনার ও টি পি হলো ".$rand;
            $checksendsms = $this->smsClass->singleSms($phone, $msg_text, $rand);
            Log::info($checksendsms->status_code.'-'.$phone.'-'.$msg_text);
            
            // Clean up expired OTPs
            $this->cleanupExpiredOtps();
            
            return response()->json([
                'success' => true,
                'message' => 'আপনার ও টি পি পাঠানো হয়েছে।',
            ], 200);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'মোবাইল নম্বর প্রয়োজন।',
        ], 400);
    }
    
    public function verifyOTP(Request $request): JsonResponse
    {
        $data = $request->validate([
            'mobile_number' => ['required', 'string', 'max:20'],
            'otp' => ['required', 'string', 'size:6'],
        ]);
        
        $phone = $data['mobile_number'];
        $otpCode = $data['otp'];
        
        // Clean up expired OTPs first
        $this->cleanupExpiredOtps();
        
        // Find valid OTP for this mobile number
        $otp = Otp::where('mobile_number', $phone)
            ->where('otp', $otpCode)
            ->valid()
            ->first();
        
        if ($otp) {
            // OTP is valid, delete it
            $otp->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'ও টি পি সফলভাবে যাচাই করা হয়েছে।',
            ], 200);
        }
        
        // Check if OTP exists but is expired
        $expiredOtp = Otp::where('mobile_number', $phone)
            ->where('otp', $otpCode)
            ->expired()
            ->first();
        
        if ($expiredOtp) {
            // Delete expired OTP
            $expiredOtp->delete();
            
            return response()->json([
                'success' => false,
                'message' => 'ও টি পি এর মেয়াদ শেষ হয়ে গেছে।',
            ], 400);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'অবৈধ ও টি পি।',
        ], 400);
    }
    
    /**
     * Clean up expired OTPs (older than 5 minutes)
     */
    private function cleanupExpiredOtps(): void
    {
        Otp::expired()->delete();
    }
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'email' => ['nullable', 'email', 'max:255'],
            'mobile_number' => ['required', 'string', 'max:20'],
            'voter_id_card_number' => ['required', 'string', 'max:50'],
            'detailed_description' => ['required', 'string'],
        ]);

        $submission = RequestSubmission::create($data);

        return response()->json([
            'success' => true,
            'message' => 'আপনার অনুরোধ সফলভাবে জমা দেওয়া হয়েছে।',
            'data' => $submission,
        ], 201);
    }
}
