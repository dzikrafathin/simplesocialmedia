<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Komentar extends Pivot
{
    public $incrementing = true;
    protected $table = 'komentars';
}
