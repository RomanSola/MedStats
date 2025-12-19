<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'servicio_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /**
     * Get the user's profile/role.
     */
    public function perfil()
    {
        return $this->belongsTo(UsuarioPerfil::class, 'role');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    /**
     * Check if the user has access to a specific module.
     *
     * @param string|array $modules
     * @return bool
     */
    public function hasAccess($modules)
    {
        if (empty($modules)) {
            return true;
        }

        if (is_string($modules)) {
            $modules = [$modules];
        }

        // If user is admin, they usually have access to everything, 
        // but let's stick to the explicit permission check from the profile
        // or if the profile itself is 'admin' (common convention, but relying on columns is safer as per CheckRole)
        
        $perfil = $this->perfil;

        if (!$perfil) {
            return false;
        }

        foreach ($modules as $module) {
            // Check if the column exists and is true
            // We assume the column name in UsuarioPerfil matches the module name
            if ($perfil->$module) {
                return true;
            }
        }

        return false;
    }
}
