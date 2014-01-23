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
		$category = Category::find(Input::get('category_id'));
		$fields = $category->fields;

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
		$validation = Validator::make($input, Field::$rules);

		if ($validation->passes())
		{
			Field::create($input);
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
		$data['field'] = Field::find($id);
		$data['datasheet'] = Datasheet::find(Input::get('datasheet_id'));
		$data['category'] = Category::find(Input::get('category_id'));

        return View::make('admin.fields.edit', $data);
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
		$validation = Validator::make($input, Field::$rules);

		if ($validation->passes())
		{
			$field = Field::find($id);
			$field->update($input);

			return Redirect::route('admin.categories.show', $field->category->id);
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
		$category_id = Field::find($id)->category->id;
		Field::find($id)->delete();

		return Redirect::route('admin.categories.show', $category_id);
	}

}
