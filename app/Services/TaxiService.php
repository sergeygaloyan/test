<?php

namespace App\Services;

use App\Models\Color_change;
use App\Models\Taxi;
use App\Models\User;
use App\Models\UserTaxi;
use Illuminate\Support\Facades\DB;

class TaxiService
{
    public static function validateAndBuy(User $user, Taxi $taxi): bool|string|null
    {
        if ($validate = self::canBuy($user, $taxi)) {
            return $validate;
        }

        return self::buy($user, $taxi);
    }
    public static function validateAndChange_Color(User $user, $color, $tid): bool|string|null
    {
        return self::change_color($user, $color, $tid);
    }

    private static function buy(User $user, Taxi $taxi): bool
    {
        UserService::decreaseCredits($user, $taxi->price);

        $userTaxi = new UserTaxi();
        $userTaxi->user_id = $user->id;
        $userTaxi->taxi_id = $taxi->id;
        $userTaxi->price = $taxi->price;
        $userTaxi->save();

        return true;
    }

    private static function change_color(User $user, $color, $tid): bool
    {
        DB::beginTransaction();
        try {
            $change_color = Color_change::where('user_taxis_id', $tid)->lockForUpdate()->get();
            if ($change_color) {
                UserService::decreaseCredits($user, 1000);
                Color_change::where('user_taxis_id', $tid)->update([
                    'color' => $color,
                ]);
            } else {
                Color_change::create([
                    'user_taxis_id' => $tid,
                    'color' => $color,
                    'count' => 1
                ]);
            }
            UserTaxi::where('id', $tid)->update([
                'color' => $color
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }


    public static function canBuy(User $user, Taxi $taxi): ?string
    {
        if ($user->credit < $taxi->price) {
            return 'Not enough credit.';
        }
        return null;
    }
}
