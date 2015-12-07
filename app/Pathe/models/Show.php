<?php

namespace Pathe\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Show extends Eloquent
{
  public $timestamps = false;

  public function movie()
  {
      return $this->belongsTo('Pathe\Models\Movie', 'movie_id');
  }

  public function theater()
  {
      return $this->belongsTo('Pathe\Models\Theater', 'theater_id');
  }

}
