<?php

namespace App\Rules;

use App\Models\Credit;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PaymentAmountRule implements ValidationRule
{



    public function __construct(int $creditId)
    {
        $this->credit  = Credit::find($creditId);
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->credit->percentage_amount > $value) {
            $fail("mebleq minimum ".$this->credit->percentage_amount." azn olmalidir");
        }
        else if ($this->credit->remainder + $this->credit->percentage_amount < $value ) {
            $fail("mebleq maksimum ".$this->credit->remainder." azn olmalidir");
        }
    }
}
