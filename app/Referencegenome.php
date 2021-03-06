<?php namespace GenomeX;

use Illuminate\Database\Eloquent\Model;

class Referencegenome extends Model {

    protected $fillable = ['', 'file',"genomename"];

    private $rules = [
        '' => 'required',
        'file' => 'required',
	'genomename'=>'required',
    ];

    public function validate() 
    {

        $v = \Validator::make($this->attributes, $this->rules);
        if ($v->passes()) return true;
        $this->errors = $v->messages();
        return false;

    }

    /**
    * Each list is owned by a registered user.
    *
    */
    public function user()
    {
      return $this->belongsTo('GenomeX\User');
    }

    public function type()
    {
      return $this->belongsTo('GenomeX\Referencegenometype');
    }
    /**
    * Each list can be associated with one or more tasks.
    *
    */
    public function tasks()
    {
    return $this->hasMany('GenomeX\Task');
    }

    /**
     * Every list belongs to a Category
     * 
     */
    public function Referencegenometype()
    {
      return $this->belongsTo('GenomeX\Referencegenometype');
    }

    /**
    * Calculate the number of incomplete tasks
    *
    */
    public function remainingTasks()
    {

        $completed = $this->tasks()->where('done', '=', 1)->count();
        $total = $this->tasks()->count();

        return $total - $completed;

    }

}
