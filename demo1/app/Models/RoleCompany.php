<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class RoleCompany extends Model
{
    use HasFactory;

    protected $table = 'company_roles';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'desc',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'company_role_user', 'user_id', 'company_role_id');
    }
}
