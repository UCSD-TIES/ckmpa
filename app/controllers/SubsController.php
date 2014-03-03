<?php

class SubsController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    //not used for this controller
/*    public function index()
    {
        $datasheet = Datasheet::find(Input::get('datasheet_id'));
        $category = Category::find(Input::get('category_id'));
        $fields = $category->fields;

        $data['datasheet'] = $datasheet;
        $data['category'] = $category;
        $data['fields'] = $fields;
        return View::make('admin.fields.list', $data);
    }
*/
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data['datasheet_id'] = Input::get('datasheet_id');
        $data['category_id'] = Input::get('category_id');

        return View::make('admin.subs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Subcategory::$rules);

        if ($validation->passes())
        {
            Subcategory::create($input);

            return Redirect::route('admin.categories.show', Input::get('category_id'));
        }

        return Redirect::route('admin.subs.create')
            ->withInput()
            ->withErrors($validation);
    }

    /**
     * (Not Used) Display the specified resource.
     *
     *
     * @param  int $id
     * @return Response
     */
/*    public function show($id)
    {
        return View::make('admin.fields.show');
    }
*/
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $sub = Subcategory::find($id);
        $data['sub'] = $sub;
        $data['category'] = $sub->category;
	     $data['category_id'] = $sub->category->id;

        return View::make('admin.subs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Subcategory::$rules);

        if ($validation->passes())
        {
            $sub = Subcategory::find($id);
            $sub->update($input);

            return Redirect::route('admin.categories.show', $sub->category->id);

        }

        return Redirect::route('admin.subs.edit', $id)
            ->withInput()
            ->withErrors($validation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $category_id = Subcategory::find($id)->category->id;
        Subcategory::find($id)->delete();

        return Redirect::route('admin.categories.show', $category_id);
    }

}
