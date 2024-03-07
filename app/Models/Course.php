<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','image_url','level','syllabus_url'];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }


}
