<?php namespace GenomeX\Http\Controllers;

use GenomeX\Http\Requests;
use GenomeX\Http\Controllers\Controller;

use Illuminate\Http\Request;

use GenomeX\Referencegenome;
use GenomeX\User;
use GenomeX\Referencegenometype;
use GenomeX\Http\Requests\ReferencegenomeCreateFormRequest;

use Event;
use GenomeX\Events\ListWasCreated;

class ReferenceGenomesController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('listowner', ['only' => ['show', 'edit', 'update']]);
	}

	public function index()
	{
		$lists = User::find(\Auth::id())->referencegenomes()->orderBy('created_at', 'desc')->paginate(10);
		return view('referencegenomes.index')->withLists($lists);
	}

	/**
	* Presents the list creation form
	*
	*
	*/
	public function create()
	{
/*Next, you’ll need to modify the Lists controller’s create method to retrieve the list of categories used
to populate the select field. Because you only want the categories table’s id and name columns, you
can use a convenient helper named lists which will create an array from the retrieved data,
*/
/*
Retrieving A List Of Column Values
If you would like to retrieve an array containing the values of one or more columns, you may use the lists method. In this example, we'll retrieve an array of role titles:
$roles = DB::table('roles')->lists('title', 'name');
*/
		$types = \DB::table('referencegenometypes')->lists('type', 'id');
					//Here 'types' is the varibale name use in view as $types											
		return view('referencegenomes.create')->with('types', $types);
	}

	/**
	 * Creates a new list
	 * @param  ListCreateFormRequest
	 * @return [type]
	 */
	public function store(ReferencegenomeCreateFormRequest $request)
	{

		$list = new Referencegenome(array(
					'genomename' => $request->get('genomename'),
					'file' => $request->file('file'), //get file name is /tmp/phppZiGNp
					));
		//associate() is a method of the belongsTo relationship, but it looks like from the above you are trying 
		$list->type()->associate(Referencegenometype::find($request->get('type')));

		$user = User::find(\Auth::id());

		$list = $user->referencegenomes()->save($list);
		$destinationPath = public_path().'/storage/uploads';
		$fileName = $list->id . '.' .
			$request->file('file')->getClientOriginalExtension();
		$request->file('file')->move($destinationPath, $fileName);

		//Event::fire(new ListWasCreated($list));

		return \Redirect::route('referencegenomes.create', 
				array($list->id))->with('message', 'Your list has been created!');

	}

	/**
	 * Displays a specific list
	 * @param  integer $id The list ID
	 * @return Response
	 */
	public function show($id)
	{
		$list = Referencegenome::findOrFail($id);
		return view('referencegenomes.show')->withList($list);
	}

	/**
	 * Presents the list edit form
	 * @param  integer $id The list ID
	 * @return Response
	 */
	public function edit($id)
	{
        $list = Referencegemome::findOrFail($id);
        return view('referencegenomes.edit')->with('referencegenome', $list);
	}

	/**
	 * Update a list
	 * @param  integer $id The list ID
	 * @param  ListCreateFormRequest $request The form request object
	 * @return Response
	 */
	public function update($id, ListCreateFormRequest $request)
	{

        $user = \Auth::user();

        $list = Referencegenome::findOrFail($id);

        $list->update([
            'genomename' => $request->get('genomename'), 
            'file' => $request->get('file')
        ]);

        return \Redirect::route('referencegenomes.edit', 
            array($task->referencegenome->id))->with('message', 'Your list has been updated!');
 
	}

	/**
	 * Delete a list
	 * @param  integer $id The list ID
	 * @return Response
	 */
	public function destroy($id)
	{

        $user = \Auth::user();

        $list = Referencegenome::findOrFail($id);

        $list->delete();

        return \Redirect::route('referencegenome.index')
            ->with('message', 'Task deleted!');


	}

}
