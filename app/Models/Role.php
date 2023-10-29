<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        "id","title",
    ];
    public function user(){
        return $this->hasMany(User::class);
    }
    // public function permision(){
    //     return $this->belongsToMany(Permision::class,'role_permisions','permision_id','role_id');
    // }
    public function permisions(): BelongsToMany
    {
        return $this->belongsToMany(Permision::class,'role_permision');
    }
}
