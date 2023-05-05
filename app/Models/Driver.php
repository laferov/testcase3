<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Driver
 *
 * @property $id
 * @property $name
 * @property $phone_number
 * @property $status
 * @property $car_info
 * @property $car_reg_info
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Driver extends Model
{
    
    static $rules = [
		'name' => 'required',
		'phone_number' => 'required',
		'status' => 'required|boolean',
		'car_info' => 'required',
		'car_reg_info' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','phone_number','status','car_info','car_reg_info'];



}
