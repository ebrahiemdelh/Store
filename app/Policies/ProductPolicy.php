<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy extends ModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */

    public function view($user, Product $product)
    {
        return $user->can('products.view', $product);
    }
}
