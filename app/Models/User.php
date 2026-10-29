<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'pin'];

    protected $hidden = ['pin', 'remember_token'];

    // Guard session memakai ini untuk validasi hash sesi,
    // jadi arahkan ke kolom pin.
    public function getAuthPassword(): string
    {
        return $this->pin;
    }
}
