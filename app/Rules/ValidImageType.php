<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class ValidImageType implements Rule
{
    public function passes($attribute, $value)
    {
        $allowedTypes = ['jpeg', 'png', 'gif', 'bmp', 'webp'];
        $extension = strtolower(pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION));

        return in_array($extension, $allowedTypes);
    }

    public function message()
    {
        return 'The :attribute must be a valid image (JPEG, PNG, GIF, BMP, or WebP).';
    }
}
