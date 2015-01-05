<?php

class ProjectController extends BaseController {

	//PROJECT CRUD

	public function show() {
        return View::make('projects.create');
	}

    public function showDetailed($id) {
        $project = Project::find($id);
		if($project) {
			return View::make('projects.projectsDetailed')->with('project', $project);
		} else {
			return View::make('layouts.404')->with('type', 'Project')->with('param', $id);
		}

    }

    public function save() {
        $rules = array(
            "name" => "required",
            "description" => "required",
            "image" => "required | image",
            "category" => "required"
        );

		$messages = array(
			"name.required" 	=> 	"Gelieve een naam aan je project te geven.",
			"description.required" 	=> 	"Geef een duidelijke omschrijving van je project.",
			"image.required" 	=> 	"Gelieve een afbeelding bij je project toe te voegen.",
			"category.required" 	=> 	"Selecteer een categorie die het best past bij jouw project.",
			"image.image"		=>	"Je project afbeelding moet een afbeelding bestand zijn."
		);
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('project/add')
                ->withErrors($validator)
                ->withInput(Input::except('image'));
        } else {
            $project = new Project;
            $project->name = Input::get('name');
            $project->description = nl2br(Input::get('description'));
            $project->user_id = Auth::id();
            $project->category = Input::get('category');

            $destinationPath = '';
            $filename        = '';
            if (Input::hasFile('image')) {
                $file = Input::file('image');
                $destinationPath = public_path() . '/img/projecten/';
                $filename = time()."-".$file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath, $filename);
                $project->image = '/img/projecten/' . $filename;
            }
            $project->save();

            return Redirect::to('project/add')->with('message', 'Project toegevoegd.');
        }
    }

    public function remove($id){
        $project = Project::find($id);
        $project->comments()->delete();
        $project->votes()->delete();

        if (File::exists(public_path() . $project->image)) {
            File::delete(public_path() . $project->image);
        }

        $project->delete();

        //return Redirect::back();
        return Redirect::to('projects');
        //return Redirect::route('profile', array('user' => Auth::id()));
    }

    public function showall(){
        $projects = Project::orderBy('created_at', 'desc')->take(9)->get();
        return View::make('projects.projects')->with('projects',$projects);
    }

    public function filter(){
        $order = Input::get('order');
        $category = Input::get('category');

        if (!empty($category)) {
            $projects = Project::where('category', '=', $category)
            ->orderBy('created_at', $order)
            ->get();
        }else{
            $projects = Project::orderBy('created_at', $order)->get();
        }

        return View::make('projects.projects')->with('projects',$projects);
    }

    public function showUpdate($id){
        $project = Project::find($id);
        return View::make('projects.editProject')->with('project', $project);
    }

    public function update($id){
        $project = Project::find($id);
        $rules = array(
            'name'          =>  'required',
            'description'   =>  'required',
            'category'      =>  'required'
        );

		$messages = array(
			"name.required" 	=> 	"Gelieve een naam aan je project te geven.",
			"description.required" 	=> 	"Geef een duidelijke omschrijving van je project.",
			"image.required" 	=> 	"Gelieve een afbeelding bij je project toe te voegen.",
			"category.required" 	=> 	"Selecteer een categorie die het best past bij jouw project."
		);

        $v = Validator::make(Input::all(), $rules,$messages);

        if ($v->fails()){
            return Redirect::to('projects/'.$project->id)->withErrors($v)->withInput(Input::all());
        } else {
            $project->name = Input::get('name');
            $project->description = nl2br(Input::get('description'));
            $project->category = Input::get('category');
            $project->save();

            return Redirect::to('projects/'.$project->id);
        }
    }

    //ADMIN

	public function listall() {
		$projects = Project::get();
		$data = array("keys"=>array("id","name","description", "created_at"), "data" => $projects);
		$headers = array("#" => "10", "Name" => "300", "Description" => "400", "Created at" => "100", "Actions" => "100");
        return View::make('admin.list')->with('data', $data)->with('headers', $headers)->with('title', 'Projects');
	}

	public function delete($id) {
		$project = Project::find($id);
		if (File::exists(public_path() . $project->image)) {
			File::delete(public_path() . $project->image);
		}
        $project->delete();
        return Redirect::to('/admin/project');
	}

	public function add() {
		return View::make('projects.create');
	}

    public function store($id){
        $project = Project::find($id);
        $rules = array(
                'name'             => 'required',
                'description'      => 'required'
            );

			$messages = array(
				'name.required'	=>	'Gelieve een naam aan je project te geven.',
				'description.required'	=>	'Geef een duidelijke omschrijving van je project.'
			);

            $v = Validator::make(Input::all(), $rules);
            if ($v->fails())
            {
                return Redirect::to('/admin/project/'.$project->id)->withErrors($v)->withInput(Input::all());
            } else {
                $project->name = Input::get('name');
                $project->description = Input::get('description');
                $project->save();

                return Redirect::to('/admin/project/edit/'.$project->id)->with('message', 'Project bijgewerkt.');
            }
    }

    public function edit($id) {
        $project = Project::find($id);
        return View::make('admin.editProject')->with('project', $project);
    }

/* AJAX */

    public function ajaxFilter(){
        $order = Input::get('order');
        $category = Input::get('category');

        if (!empty($category)) {
            $projects = Project::with('user')->with('comments')->with('votes')->where('category', '=', $category)
            ->orderBy('created_at', $order)
            ->get();
        }else{
            $projects = Project::with('user')->with('comments')->with('votes')->orderBy('created_at', $order)->get();
        }
        $response = array(
            "status" => "success",
            "projects" => $projects,
            "id" => Auth::id()
        );
        return Response::json($response);
    }

}
