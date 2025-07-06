<?php

namespace App\Services\Website;

use App\Models\Cart;
use App\Models\City;
use App\Models\Government;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Transaction;
use App\Models\ShippingGovernment;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function getInvoiceValue($address)
    {
        $GovernmentName = $this->getLocationName(Government::class, $address['government_id']);

        $cart = $this->getUserCart();
        if (!$cart || $cart->items->isEmpty()) {
            return null;
        }

        $subTotal = $cart->items->sum(fn($item) => $item->price * $item->quantity);
        $shippingPrice = $this->getShippingPrice($address['government_id']);

        // check if user has coupon
        if ($coupon_exists = $cart->coupon != null) {
            $coupon = Coupon::valid()->where('code', trim($cart->coupon, ' '))->first();
            if ($coupon) {
                $subTotal = $subTotal - ($subTotal * $coupon->discount_percentage / 100);
            }
        }
        $totalPrice    = $subTotal + $shippingPrice;

        return $totalPrice;

    }

    public function createTransaction($data , $orderId)
    {
        $transaction = Transaction::create([
            'user_id' => Auth::guard('web')->user()->id,
            'order_id' => $orderId,
            'transaction_id' => $data['Data']['InvoiceId'],
            'payment_method' => 'Payment',
        ]);
        return $transaction;
    }

    public function createOrder(array $address): ?Order
    {
        $countryName     = $this->getLocationName(Country::class, $address['country_id']);
        $GovernmentName = $this->getLocationName(Government::class, $address['government_id']);
        $cityName        = $this->getLocationName(City::class, $address['city_id']);

        if (!$countryName || !$GovernmentName || !$cityName) {
            return null;
        }

        $cart = $this->getUserCart();
        if (!$cart || $cart->items->isEmpty()) {
            return null;
        }


        $subTotal = $cart->items->sum(fn($item) => $item->price * $item->quantity);
        $shippingPrice = $this->getShippingPrice($address['government_id']);

        // check if user has coupon
        if ($coupon_exists = $cart->coupon != null) {
            $coupon = Coupon::valid()->where('code', trim($cart->coupon, ' '))->first();
            if ($coupon) {
                $subTotal = $subTotal - ($subTotal * $coupon->discount_percentage / 100);
            }
        }
        $totalPrice    = $subTotal + $shippingPrice;

        // store order
        $order = Order::create([
            'user_id'        => auth('web')->user()->id,
            'user_name'      => $address['first_name'] . ' ' . $address['last_name'],
            'user_phone'     => $address['user_phone'],
            'user_email'     => $address['user_email'],
            'country'        => $countryName,
            'governorate'    => $GovernmentName,
            'city'           => $cityName,
            'street'         => $address['street'],
            'note'           => $address['note'],
            'price'          => $subTotal, //subtotal
            'shapping_price' => $shippingPrice,
            'total_price'    => $totalPrice,
            'coupon'         => $coupon_exists && $coupon? $coupon->code : null,
            'coupon_discount'=> $coupon_exists && $coupon? $coupon->discount_percentage : 0,
        ]);

        $this->storeOrderItemsFromCart($order, $cart);

        return $order;
    }

    private function getLocationName(string $modelClass, int $id): ?string
    {
        return $modelClass::find($id)?->name;
    }

    private function getUserCart(): ?Cart
    {
        return Cart::with('items.product')->where('user_id', auth('web')->user()->id)->first();
    }

    private function getShippingPrice(int $GovernmentId): float
    {
        return ShippingGovernment::where('government_id', $GovernmentId)->value('price') ?? 0.0;
    }

    private function storeOrderItemsFromCart(Order $order, Cart $cart): void
    {
        foreach ($cart->items as $item) {
            $order->orderItems()->create([
                'product_id'         => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'product_name'       => optional($item->product)->name ?? 'Unknown Product',
                'product_desc'       => optional($item->product)->small_desc ?? '',
                'product_quantity'   => $item->quantity,
                'product_price'      => $item->price,
                'attributes'         => json_encode($item->attributes),
            ]);
        }
    }

    public function clearUserCart(Cart $cart): void
    {
        $cart->items()->delete();
        $cart->update(['coupon'=>null]); // clear coupon
    }
}
