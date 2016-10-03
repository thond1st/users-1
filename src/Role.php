<?php

namespace Vitorbar\Users;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'pkg_users_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Relationship: users
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
