<?php


namespace App;


use App\Enums\KosherTypes;
use Illuminate\Database\Eloquent\Model;

final class Product extends Model
{
    protected $fillable = ['category_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function setKosherTypeAttribute($value)
    {
        switch (strtoupper($value)) {
            case 'P':
                $this->attributes['koshertype'] = (new KosherTypes(KosherTypes::PARVE))->getValue();
                break;
            case 'M':
                $this->attributes['koshertype'] = (new KosherTypes(KosherTypes::MILK))->getValue();
                break;
            case 'NK';
            case '';
                break;
            default:
                throw new \InvalidArgumentException('Unknown Type Koshertype ' .  $value);
        }
    }
}
