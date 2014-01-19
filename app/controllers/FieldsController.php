<?php

class FieldsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datasheet = Datasheet::find(Input::get('datasheet_id'));
		$category = DatasheetCategory::find(Input::get('category_id'));
		$fields = $category->entries;

		$data['datasheet'] = $datasheet;
		$data['category'] = $category;
		$data['fields'] = $fields;
        return View::make('admin.fields.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['datasheet_id'] = Input::get('datasheet_id');
		$data['category_id'] = Input::get('category_id');

        return View::make('admin.fields.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, DatasheetEntry::$rules);

		if ($validation->passes())
		{
			DatasheetEntry::create($input);
			$data['datasheet_id'] = Input::get('datasheet_id');
			$data['category_id'] = Input::get('category_id');

			return Redirect::route('admin.fields.index', $data);
		}

		return Redirect::route('admin.fields.create')
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
        return View::make('admin.fields.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('admin.fields.edit');
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
		$validation = Validator::make($input, DatasheetEntry::$rules);

		if ($validation->passes())
		{
			$field = DatasheetEntry::find($id);
			$field->update($input);

			return Redirect::route('admin.fields.index', $id);
		}

		return Redirect::route('admin.fields.edit', $id)
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
		DatasheetEntry::find($id)->delete();

		return Redirect::route('admin.fields.index');
	}

}
