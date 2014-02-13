<?php namespace Gzero\Models;

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\UserInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function roles()
    {
        return $this->belongsToMany('Gzero\Models\Role');
    }

    public function permissions()
    {
        return $this->hasMany('Gzero\Models\Permission');
    }

    public function hasRole($key)
    {
        foreach ($this->roles as $role) {
            if ($role->name === $key) {
                return TRUE;
            }
        }
        return FALSE;
    }

}
