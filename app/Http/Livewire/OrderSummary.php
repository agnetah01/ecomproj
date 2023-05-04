<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Models\productSku;

class OrderSummary extends Component
{
    public $cart = [];
    public $subTotal;
    public $tax ;
    public $totalPrice;

    public function mount(){
         $total = 0;
        foreach($this->cart as $item){
            $productSku = productSku::where('id',$item->product_sku_id)->first();
            $total +=  $productSku->price * $item->quantity;
        }
        $this->subTotal = $total;
        $this->tax = number_format(($this->subTotal/100) * 5,2);
        $this->totalPrice = number_format($this->subTotal + $this->tax,2);
    }


    public function render()
    {
        return view('livewire.order-summary');
    }
}
