<?php

class JobController extends BaseController
{

    //JOB CRUD

    public function add()
    {
        return View::make('admin.addJob');
    }

    public function employeeAdd()
    {
        return View::make('jobs.addJob');
    }

    public function create()
    {
        $rules = array(
            'functie' => 'required',
            'adres' => 'required',
            'werkgever' => 'required',
            'email' => 'required|email',

        );

        $messages = array(
            'functie.required' => 'Gelieve de titel van de functie in te vullen.',
            'adres.required' => 'Gelieve het adres van het betreffende bedrijf in te vullen.',
            'werkgever.required' => 'Gelieve de naam van de werkgever in te vullen.',
            'email.required' => 'Gelieve een email adres in te voeren voor verder contact.',
        );

        $v = Validator::make(Input::all(), $rules, $messages);

        if ($v->fails()) {
            return Redirect::back()->withErrors($v)->withInput(Input::all());
        } else {
            $j = new Job;
            $j->functie = Input::get('functie');
            $j->adres = Input::get('adres');
            $j->werkgever = Input::get('werkgever');
            $j->email = Input::get('email');
            $j->telefoon = Input::get('telefoon');
            $j->beschrijving = nl2br(Input::get('description'));
            $j->gemeente = Input::get('gemeente');
            $j->postcode = Input::get('postcode');

            $destinationPath = '';
            $filename = '';

            if (Input::hasFile('logo')) {
                $file = Input::file('logo');
                $destinationPath = public_path() . '/img/jobs/';
                $filename = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath, $filename);
                $j->logo = '/img/jobs/' . $filename;
            }

            $j->save();

            return Redirect::back()->with('message', 'Added Job');
        }
    }

    public function listall()
    {
        $jobs = Job::get();
        $data = array("keys" => array("id", "functie", "werkgever", "email", "created_at"), "data" => $jobs);
        $headers = array("#" => 10, "Function" => "200", "Werkgever" => "200", "Email" => "200", "Created at" => "100", "Actions" => "100");
        return View::make('admin.list')->with('data', $data)->with('headers', $headers)->with('title', 'Jobs');
    }

    public function showDetailedList()
    {
        $jobs = Job::orderBy('created_at', 'desc')->take(10)->get();
        return View::make('jobs.list')->with('jobs', $jobs);
    }

    public function showDetailed($id)
    {
        $job = Job::find($id);
        return View::make('jobs.show')->with('job', $job);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $j = Job::find($id);
        return View::make('jobs.edit')->with('job', $j);
    }

    public function store($id)
    {
        $rules = array(
            'functie' => 'required',
            'adres' => 'required',
            'werkgever' => 'required',
            'email' => 'required|email',

        );

        $messages = array(
            'functie.required' => 'Gelieve de titel van de functie in te vullen.',
            'adres.required' => 'Gelieve het adres van het betreffende bedrijf in te vullen.',
            'werkgever.required' => 'Gelieve de naam van de werkgever in te vullen.',
            'email.required' => 'Gelieve een email adres in te voeren voor verder contact.',
        );

        $v = Validator::make(Input::all(), $rules, $messages);

        if ($v->fails()) {
            return Redirect::back()->withErrors($v)->withInput(Input::all());
        } else {
            $j = Job::find($id);
            $j->functie = Input::get('functie');
            $j->adres = Input::get('adres');
            $j->werkgever = Input::get('werkgever');
            $j->email = Input::get('email');
            $j->telefoon = Input::get('telefoon');
            $j->save();

            return Redirect::back()->with('message', 'Added Job');
        }
    }

    public function delete($id)
    {
        $job = Job::find($id);
        if (File::exists(public_path() . $job->logo)) {
            File::delete(public_path() . $job->logo);
        }
        $job->delete();
        return Redirect::to('/admin/job');
    }

}
