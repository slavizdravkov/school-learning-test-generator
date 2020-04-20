<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function capabilities()
    {
        return $this->belongsToMany(Capability::class)->withTimestamps();
    }

    /**
     * Grant the given capability to the role.
     *
     * @param mixed $capability
     * @param bool $detaching
     */
    public function allowTo($capability, $detaching = true)
    {
        if (is_string($capability)) {
            $capability = Capability::whereName($capability)->firstOrFail();
        } elseif (is_array($capability)) {
            $capability = Capability::findMany($capability);
        }

        $this->capabilities()->sync($capability, $detaching);
    }

    public function hasCapability($capability)
    {
        return $this->capabilities->contains($capability);
    }
}
