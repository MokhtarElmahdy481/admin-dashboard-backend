<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permision extends Model
{
    use HasFactory;
    protected $fillable = [
        "id","title",
    ];
    // public function role(){
    //     return $this->belongsToMany(Role::class,'role_permisions','role_id','permision_id');
    // }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class,'role_permision');
    }
}
