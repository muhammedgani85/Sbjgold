<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_permissions extends Model
{
    use HasFactory;
    protected $fillable = ['role_id', 'menu_id', 'submenu_id'];
}
