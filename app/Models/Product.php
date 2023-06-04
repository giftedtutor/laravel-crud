<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price'];

    public function save(array $options = [])
    {
        $validator = Validator::make($this->attributes, $this->getValidationRules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        parent::save($options);
    }

    protected function getValidationRules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ];
    }
}
