<?php



namespace App;



use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable

{

    use Notifiable;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name', 'email', 'password', 'phone_number', 'sex', 'role'

    ];



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password', 'remember_token',

    ];



    public function isAdmin()

{

    

        if ($this->role == 'admin')

        {

            return true;

        }

    

}
public function isUser()

{

    

        if ($this->role == 'user')

        {

            return true;

        }

    

}

}

