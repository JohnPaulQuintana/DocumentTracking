<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedDocument extends Model
{
    use HasFactory;
    protected $fillable = ['trk_id','requestor', 'forwarded_to','purpose','recieved_offices','documents','status'];
   
    /**
     * Define a one-to-many relationship with the Log model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(Log::class, 'requested_document_id');
    }

    // public function Offices()
    // {
    //     return $this->hasMany(Office::class, 'recieved_offices');
    // }

}
