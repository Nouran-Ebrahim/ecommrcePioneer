<?php

namespace App\Livewire\Website\Checkout;

use Livewire\Component;
use App\Models\Cart;
use Livewire\Attributes\On;
use App\Models\Coupon as CouponModel;
class Coupons extends Component
{
     public $code;
    public $cart;
    public $cartItemsCount = 0;
    public $couponInfo = null;

    #[On('orderSummaryRefresh')]
    public function mount()
    {
        $this->cart = Cart::where('user_id', auth('web')->user()->id)->first();
        $this->cartItemsCount = $this->cart->items->count() ?? 0;

        if ($this->cart->coupon != null) {
            $couponObj = CouponModel::valid()->where('code', $this->cart->coupon)->first();
            if ($couponObj) {
                $this->couponInfo = 'Coupon Will Applay With Discount ' . $couponObj->discount_percentage . '% During Payment Coupon Code: ' . $couponObj->code . ' Coupon Validity: ' . $couponObj->end_date;
            }
        }
    }

    public function applyCoupon()
    {
        if (!$this->checkCouponValid($this->code)) {
            $this->dispatch('couponNotValid', 'Coupon Not Valid');
            return;
        }

        $cart = Cart::where('user_id', auth('web')->user()->id)->first();
        $cart->update([
            'coupon' => $this->code,
        ]);

        // decrease coupon count
        $couponObj = CouponModel::where('code', $this->code)->first();
        $couponObj->update([
            'time_used' => $couponObj->time_used + 1,
        ]);

        $this->couponInfo = 'Coupon will Applied With Discount ' . $couponObj->discount_percentage . '%  Coupon Code: ' . $couponObj->code . ' Coupon Validity: ' . $couponObj->end_date;

        $this->dispatch('couponApplied', $this->couponInfo);
    }

    public function checkCouponValid($code)
    {
        $couponObj = CouponModel::where('code', $code)->first();
        if (!$couponObj) {
            return false;
        }
        if (!$couponObj->couponIsValid()) {
            return false;
        }
        return $couponObj;
    }
    public function render()
    {
        return view('livewire.website.checkout.coupons');
    }
}
