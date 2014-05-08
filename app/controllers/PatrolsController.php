<?php

class PatrolsController extends BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['patrols'] = Patrol::with('transect', 'user')->orderBy('start_time')->get();

		return View::make('admin.patrols.list', $data);
	}

	/**
	 * Shows all patrols for a given transect.
	 *
	 * @return \Illuminate\View\View
	 */
	public function patrolsList($transect)
	{
		$data['patrols'] = Transect::find($transect)->patrols;

		return View::make('admin.patrols.list', $data);
	}

	public function patrolsUser($user_id)
	{
		$data['patrols'] = User::find($user_id)->patrols;

		return View::make('admin.patrols.list', $data);
	}

    public function patrolTallies($patrol_id)
    {
      $patrol = Patrol::with('tallies', 'tallies.field.category', 'tallies.subcategory')->where('id', $patrol_id)->first();
      $data['user'] = $patrol->user;
      $data['patrol'] = $patrol;
      $tallies = $patrol->tallies;
      $categories = [];

      foreach($tallies as $tally){
        $category_name = $tally->field->category->name;
        $field_name = $tally->field->name;
        $value = $tally->tally;
        $subcategory_name = $tally->subcategory['name'];
        
        if(!empty($subcategory_name)){
          $categories[$category_name][$field_name][$subcategory_name] = $value;
        } else {
          $categories[$category_name][$field_name] = $value;
        }
      }

      $data['categories'] = $categories;

      return View::make('layouts.patrol_modal', $data);
    }

	/**
	 * (Not used) Show the form for creating a new resource.
	 *
	 * Create view is in MobileController.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('patrols.create');
	}

	/**
	 * (Not used) Store a newly created resource in storage
	 *
	 * Stored in MobileController instead.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * (Not used) Display the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('patrols.show');
	}

	/**
	 * (Not used) Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('patrols.edit');
	}

	/**
	 * (Not implemented) Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Patrol::find($id)->delete();

		return Redirect::route('admin.patrols.index');
	}
}
