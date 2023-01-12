<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function show(Request $request, $code)
    {
        $voucher = Voucher::where('phone', $request->query('phone'))
            ->where('code', $code)
            ->first();

        return [
            'coupon_code' => $voucher->code,
            'phone' => $voucher->name,
            'discount_amount' => $voucher->code,
            'expired_at' => $voucher->expired_at,
        ];
    }
}
