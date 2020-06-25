<?php

namespace App;

namespace App\Components\CardType\Models;

use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblcard_types';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['cardTypeName','cardTypeDescription','createdBy'];

    /**
     * the rules of the Group for validation before persisting
     *
     * @var array
     */
    public static $rules = [];

}
