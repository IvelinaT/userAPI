<?php

namespace User\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * User model
 *
 */

/**
 * @property integer id
 * @property string forename
 * @property string surname
 * @property string email
 */
class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = ['email', 'forename', 'surname'];
    protected $guarded = ['id'];


    public $timestamps = true;


    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }




}