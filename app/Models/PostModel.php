<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostModel extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'created_at'
    ];

    /**
     * @param $request
     *
     * @return mixed
     */
    public function create($request)
    {
        $createdOffer = self::firstOrCreate([
            'title'          => $request->getParam('title'),
            'description'      => $request->getParam('description'),
            'created_at'    => $request->getParam('created_at')
        ]);

        return $createdOffer;
    }

}
