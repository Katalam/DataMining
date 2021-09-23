<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = [];

    public function getNameAttribute()
    {
        if ($this->last_name == null)
            return $this->first_name;
        return "{$this->first_name} {$this->last_name}";
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
}
