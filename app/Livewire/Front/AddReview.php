<?php

namespace App\Livewire\Front;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\WatchList;
use Livewire\Component;

class AddReview extends Component
{
    public $reviews = [], $comment = '', $step = 1,$cartCount;
    public $product, $count_review, $attributeValues, $selected, $variant, $cartAtrributeArray = [];
    public $variantArray = [];
    public bool $isInWatchlist = false;
    public $quantity = 1;
    public $addedToWatchList;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount($reviews, $product, $attributeValues)
    {

        $this->product = $product;
        $this->getReviews();
        $this->count_review = count($this->reviews);
        $this->$attributeValues = $attributeValues;
        $this->selected = false;
    }
    public function getReviews()
    {
        $this->reviews = Review::where('product_id', $this->product->id)
            ->with('user.country', 'user.governorate')->latest()->limit(4)
            ->get();
    }
    public function chooseVariant($variant)
    {
        if ($variant) {
            $this->variant = $variant;
            if (count($this->variantArray) == 0) {
                $this->variant = ProductVariant::where('id', $variant['id'])->with('product_attributes.attr_value.attribute')->first();
                foreach ($this->variant->product_attributes as $variant2) {

                    $this->variantArray[$variant2->attr_value->attribute->getTranslation('name', 'en')] = $variant2->attr_value->value;
                }
                $this->selected = true;
            } else {
                $this->variant = ProductVariant::where('id', $variant['id'])->with('product_attributes.attr_value.attribute')->first();
                foreach ($this->variant->product_attributes as $variant2) {

                    $this->variantArray[$variant2->attr_value->attribute->getTranslation('name', 'en')] = $variant2->attr_value->value;
                }
                $this->selected = true;
            }
        }
    }
    public function incrementQuantity()
    {
        $this->quantity++;
    }
    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }
    public function addtocart()
    {
        $cart = Cart::firstOrCreate([
            'session_id' => session()->getId(),
            'user_id'=>auth()->user()?auth()->id():null
        ]);
        session()->put('cart_id', $cart->id);
        session()->save();
        if (!$this->product->has_variants) {
            $cartItem = CartProduct::where('cart_id', $cart->id)
                ->where('product_id', $this->product->id)
                ->whereNull('product_variant_id')
                ->first();
            if ($cartItem) {
                if ($cartItem->quantity + $this->quantity > $this->product->quantity) {
                    $this->dispatch('Error', 'The Quantity You Want to add exceed stock');
                    return false;
                }
                $cartItem->increment('quantity', $this->quantity);
                $this->dispatch('updated', ['You Have' . ' ' . $cartItem->quantity . ' ' . 'from this product']);
            } else {
                $cart->products()->attach($this->product->id, [
                    'price' => $this->product->final_price,
                    'quantity' => $this->quantity
                ]);
                $this->dispatch('success', ['You Added the product successfully']);
            }
        }
        if ($this->product->has_variants) {
            if ($this->variant) {
                $cartItem = CartProduct::where('cart_id', $cart->id)
                    ->where('product_id', $this->product->id)
                    ->where('product_variant_id', $this->variant['id'])
                    ->first();
                if ($cartItem) {
                    if ($cartItem->quantity + $this->quantity > $this->variant['stock']) {
                        $this->dispatch('Error', 'The Quantity You Want to add exceed stock');
                        return false;
                    }
                    $cartItem->increment('quantity', $this->quantity);
                    $this->dispatch('updated', ['You Have' . ' ' . $cartItem->quantity . ' ' . 'from this product']);
                } else {
                    $variant = ProductVariant::where('id', $this->variant['id'])->with('product_attributes.attr_value.attribute')->first();
                        foreach ($variant->product_attributes as $variant2) {

                            $this->cartAtrributeArray[$variant2->attr_value->attribute->getTranslation('name', 'en')] = $variant2->attr_value->value;
                        }
                        $cart->products()->attach($this->product->id, [
                            'price' =>$this->product->has_discount? round($variant->price-($variant->price * $this->product->discount / 100),2):$variant->price,
                            'quantity' => $this->quantity,
                            'product_variant_id' => $variant->id,
                            'attributes' => json_encode($this->cartAtrributeArray, JSON_UNESCAPED_UNICODE)

                        ]);
                        $this->dispatch('success', ['You Added the product successfully']);

                }
            } else {
                $this->dispatch('chooseVar');
            }
        }
        $this->cartCount=count($cart->products);
        $this->dispatch('getCartCount')->to('front.header');
    }

    public function firstStep()
    {
        $this->step = 1;
        $this->dispatch('swiper-update');
        $this->dispatch('refresh')->to('front.add-review');
    }
    public function secondStep()
    {

        $this->step = 2;
        $this->dispatch('swiper-update');
        $this->dispatch('refresh')->to('front.add-review');
    }
    public function submit()
    {

        $data = $this->validate([
            'comment' => ['required']
        ]);
        if (auth()->check()) {
            Review::create([
                'product_id' => $this->product->id,
                'user_id' => auth()->user()->id,
                'comment' => $data['comment']
            ]);
            $this->dispatch('sendSuccessMsg');
            //  $this->dispatch('getReviewCount',$this->count_review)->to('front.get-review');
            $this->reset('comment');
            $this->getReviews();
        } else {
            $this->dispatch('CheckUserLogin');
        }
    }
    public function AddToWatchList()
    {
        if (auth()->check()) {
            $watchList = WatchList::firstOrCreate([
                'user_id' => auth()->id(),
            ]);

            // تحقق إذا كان المنتج موجود بالفعل
            if ($watchList->products()->where('product_id', $this->product->id)->exists()) {
                $this->dispatch('AlreadyExists'); // حدث JS يخبر أن المنتج موجود
            } else {
                $watchList->products()->syncWithoutDetaching($this->product->id); // أضف المنتج
                $this->dispatch('added_successfully'); // أرسل رسالة النجاح
                $this->isInWatchlist = true;
                $this->dispatch('getNewWishlistProductCount')->to('front.header');
            }
        } else {
            return to_route('login');
        }
    }

    public function render()
    {
        return view('livewire.front.add-review');
    }
}
