<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $with = ['client'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'agent', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('quantity');
    }

    public function scopeSearchByName($query, $value)
    {

        // return $query->where('reference_number', 'like', '%' . $value . '%')
        //     ->orWhere('title', 'like', '%' . $value . '%');
        return $query->where(function ($q) use ($value) {
            $q->where('reference_number', "like", "%" . $value . "%");
        })->orWhere('title', "like", "%" . $value . "%");
    }
    public function scopeSearchByDate($query, $value)
    {

        // return $query->where('reference_number', 'like', '%' . $value . '%')
        //     ->orWhere('title', 'like', '%' . $value . '%');
        return $query->where(function ($q) use ($value) {
            $q->whereDate('created_at',  $value);
        })->orWhereDate('date', "like", "%" . $value . "%")
            ->orWhere('delivery_date', "like", "%" . $value . "%");
    }
}
