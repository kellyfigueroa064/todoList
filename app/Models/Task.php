<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    Protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'descripcion', 'due_date','user_id',
    ];
    public function users()
    {
       return $this->belongsTo(User::class,'user_id','id');
    }
}
