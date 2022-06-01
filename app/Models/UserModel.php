<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'email'
    ];

    public function create($request)
    {
        $user = self::firstOrCreate([
            'first_name'          => $request->getParam('first_name'),
            'last_name'      => $request->getParam('last_name'),
            'email'    => $request->getParam('email')
        ]);

        return $user;
    }
}
