<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $dates = ['created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
        'created_at' => 'datetime',
        'is_blocked' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Fetch the user's capabilities
     *
     * @return Collection
     */
    public function capabilities()
    {
        return $this->roles->map->capabilities->flatten()->pluck('name')->unique();
    }

    public function assignRole($role, $detaching = true)
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        } elseif (is_array($role)) {
            $role = Role::findMany($role);
        }

        $this->roles()->sync($role, $detaching);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->flatten()->pluck('name')->contains($role);
        }

        return $this->roles->contains($role);
    }

    public function hasPermission($capability)
    {
        if (is_array($capability)) {
            return $this->capabilities()->intersect($capability)->count() > 0;
        }

        return $this->capabilities()->contains($capability);
    }

    public function getStatusAttribute()
    {
        return $this->is_blocked ? 'Блокиран' : 'Активен';
    }

    public function getIsConfirmedAttribute()
    {
        return null !== $this->email_verified_at;
    }

    public function toggleStatus()
    {
        $this->is_blocked = !$this->is_blocked;

        return $this;
    }
}
