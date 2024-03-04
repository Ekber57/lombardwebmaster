<?php
namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;


class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'lastname' => $this->faker->lastName(),
            'middlename' => $this->faker->name(),
            'fincode'=> $this->faker->regexify('[A-Za-z]{7}'),
            'adress'=> $this->faker->address(),
            'phone'=>$this->faker->regexify('[0-9]{10}')
            // Diğer sahte veri alanları ekleme
        ];
    }
}