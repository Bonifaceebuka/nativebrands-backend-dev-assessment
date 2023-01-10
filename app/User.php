<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'verification_code',
        'email',
        'password',
        'first_name',
        'last_name',
        'gender',
        'avatar',
        'is_verified',
        'role_id',    
        'email_verified_at',  
        'remember_token', 
        'verification_code',
        'phone',   
        'last_login'  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function profile_image()
    {
        return $this->hasOne(\App\Models\Upload::class,'id','profile_image_id');
    }

    public function cover_image()
    {
        return $this->hasOne(\App\Models\Upload::class,'id','cover_image_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
