<?php

class CategoriesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datasheet = Datasheet::find(Input::get('datasheet_id'));
		$data['datasheet'] = $datasheet;
		$data['categories'] = $datasheet->categories;

        return View::make('admin.categories.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$id = Input::get('datasheet_id');
        return View::make('admin.categories.create', compact('id'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, DatasheetCategory::$rules);

		if ($validation->passes())
		{
			DatasheetCategory::create($input);
			$datasheet_id = Input::get('datasheet_id');

			return Redirect::route('admin.categories.index', compact('datasheet_id'));
		}

		return Redirect::route('admin.categories.create')
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('admin.categories.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data['category'] = DatasheetCategory::find($id);
		$data['datasheet'] = $data['category']->datasheet;
        return View::make('admin.categories.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, DatasheetCategory::$rules);

		if ($validation->passes())
		{
			$category = DatasheetCategory::find($id);
			$category->update($input);

			$data['datasheet_id'] = Input::get('coastkeeper_datasheet_id');

			return Redirect::route('admin.categories.index', $data);
		}
		$data['category_id'] = $id;

		return Redirect::route('admin.categories.edit', $data)
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		DatasheetCategory::find($id)->delete();
		$datasheet_id = Input::get('datasheet_id');

		return Redirect::route('admin.categories.index', compact('datasheet_id'));
	}

}
