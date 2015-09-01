<?php namespace GenomeX;

use Illuminate\Database\Eloquent\Model;

class Referencegenometype extends Model {

	protected $fillable = ['type'];

    /**
    * Each category can be associated with one or more lists.
    *
    */
    public function referencegenomes()
    {
    	return $this->hasMany('GenomeX\Referencegenome');
    }

}
