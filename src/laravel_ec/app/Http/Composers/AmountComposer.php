<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class AmountComposer
{
    public function compose(View $view)
    {
        $total_amount = 0;

        foreach ($view->items as $item) {
            $total_amount += $item['price'] * $item['qty'];
        }

        $view->with([
            'total_amount' => $total_amount,
        ]);
    }
}
