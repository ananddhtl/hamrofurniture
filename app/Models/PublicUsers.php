<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class PublicUsers extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'public_users';
    protected $guarded = ['id'];
}
