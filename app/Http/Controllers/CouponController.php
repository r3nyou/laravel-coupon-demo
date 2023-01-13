<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Prize;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function create(Request $request)
    {
        $phone = $request->post('phone');
        $activityId = $request->post('activity_id');

        // 相同 activity_id 檢查重複 phone
        $duplicate = Voucher::query()
            ->with('prize', function ($query) use ($activityId) {
                $query->where('activity_id', $activityId);
            })
            ->where('phone', $phone)
            ->exists();
        if ($duplicate) {
            return response([], 202);
        }

        // 用 activity_id 找出該 activity 所有 prize
        $activity = Activity::query()
            ->with('prizes', function ($query) {
                $query->select([
                    'id',
                    'activity_id',
                    'name',
                    'discount_amount',
                    'probability',
                ]);
            })
            ->where('id', $activityId)
            ->where('status', 1)
            ->select([
                'id',
                'name'
            ])
            ->first();

        // 抽獎
        $winPrize = null;
        $sumProbability = 0;
        $random = mt_rand(0, 10000) / 100;
        foreach ($activity->prizes as $prize) {
            $sumProbability += $prize->probability;
            if ($random < $sumProbability) {
                $winPrize = $prize;
                break;
            }
        }

        if (null === $winPrize) {
            return response([], 204);
        }

        // 產生屬於該 phone 的 voucher
        $voucher = $winPrize->vouchers()->create([
            'phone' => $phone,
            'discount_amount' => $prize->discount_amount,
            'code' => Str::random(8),
            'expired_at' => Carbon::now()->addMonth(),
        ]);

        return response([
            'activity_name' => $activity->name,
            'prize_name' => $winPrize->name,
            'coupon_code' => $voucher->code,
            'discount_amount' => $voucher->discount_amount,
            'expired_at' => $voucher->expired_at,
        ]);
    }
}
