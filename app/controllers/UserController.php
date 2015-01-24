<?php

class UserController extends BaseController
{

    //USER SIDE

    public function show($id = null)
    {
        if (!$id) {
            if (Auth::check()) {
                $id = Auth::id();
            } else {
                return Redirect::to('/');
            }
        }

        $user = User::find($id);

        if ($user) {
            $xp = $this->getLevel($id);
            return View::make('users.profile')->with('user', $user)->with('xp', $xp);
        } else {
            return Redirect::to('/profile')->with('feedback', array("error" => "Deze gebruiker bestaat niet."));
        }
    }

    public function showall()
    {
        $users = User::where("type", "=", false)
            ->orWhere("type", "=", null)
            ->orderBy("created_at", "desc")
            ->get();
        return View::make("users.users")->with("users", $users);
    }

    public function showUpdate()
    {
        $id = Auth::id();
        $user = User::find($id);

        return View::make('users.editUser')->with('user', $user);
    }

    public function store($id = null)
    {
        $rules = array(
            'firstname' => 'required',
            'name' => 'required',
            'dateofbirth' => 'date',
            'website' => '',
            'about' => '',
            'avatar' => '',
            'email' => 'required|email',
            'password' => '',
            'password_confirm' => 'same:password'
        );

        $messages = array(
            'firstname.required' => 'Gelieve je voornaam in te vullen.',
            'name.required' => 'Gelieve je naam in te vullen.',
            'class.required' => 'Gelieve je klasnummer in te vullen.',
            'dateofbirth.date' => 'Je geboortedatum is blijkbaar niet correct, controleer of het formaat juist is (dd/mm/yyyy)',
            'avatar.required' => 'Gelieve een profielfoto op te laden, dit maakt je profiel veel persoonlijker.',
            'avatar.image' => 'Je profielfoto is geen afbeelding.',
            'email.required' => 'Gelieve een emailadres in te voeren, zo kunnen we contact met je opnemen.',
            'email.email' => 'Je email is geen geldig emailadres.',
            'email.unique' => 'Deze email is blijkbaar al in gebruik, probeer een ander email adres.',
            'password.required' => 'Vul hier een goed bedacht wachtwoord in, dat je makkelijk kan onthouden.',
            'password_confirm.required' => 'Vul hier je wachtwoord opnieuw in.',
            'password_confirm.same' => 'De wachtwoorden komen niet overeen, probeer eens opnieuw.'
        );

        $v = Validator::make(Input::all(), $rules, $messages);

        if (!$id) {
            $id = Auth::id();
        }

        $user = User::find($id);
        if ($v->fails()) {
            return Redirect::to(Request::url())->withErrors($v)->withInput(Input::except('avatar'));
        } else {
            $user->firstname = Input::get('firstname');
            $user->name = Input::get('name');
            $user->dateofbirth = date("Y-m-d", strtotime(Input::get('dateofbirth')));
            $user->email = Input::get('email');
            $user->website = Input::get('website');
            $user->about = Input::get('about');
            if (Input::get('admin')) {
                $user->admin = 1;
            }

            if (Input::get('employee')) {
                $user->type = 1;
            }

            $user->class = Input::get('class');

            $destinationPath = '';
            $filename = '';

            if (Input::hasFile('avatar')) {

                if (File::exists($user->avatar))
                    File::delete($user->avatar);

                $file = Input::file('avatar');
                $destinationPath = public_path() . '/img/users/';
                $filename = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath, $filename);
                $user->avatar = '/img/users/' . $filename;
            }
            $pw = Input::get('password');

            if (!empty($pw)) {
                $user->password = Hash::make($pw);
            }
            $user->save();

            return Redirect::to('/profile')->with('feedback', array('success' => 'Uw profiel is succesvol bijgewerkt'));
        }
    }

    // ADMIN SIDE

    public function add()
    {
        return View::make('users.signup');
    }

    public function create()
    {
        $rules = array(
            'firstname' => 'required',
            'name' => 'required',
            'type' => 'required',
            'class' => 'between:3,6',
            'dateofbirth' => 'date|before:' . date('c'),
            'avatar' => 'required|image',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        );

        $messages = array(
            'type.required' => 'Selecteer wat voor type gebruiker u bent.',
            'firstname.required' => 'Gelieve je voornaam in te vullen.',
            'name.required' => 'Gelieve je naam in te vullen.',
            'class.between' => 'Je klasnaam moet minstens 3 en maximum 6 karakters zijn',
            'dateofbirth.date' => 'Je geboortedatum is blijkbaar niet correct, controleer of het formaat juist is (dd/mm/yyyy)',
            'dateofbirth.before' => 'Je geboortedatum moet voor vandaag zijn.',
            'avatar.required' => 'Gelieve een profielfoto op te laden, dit maakt je profiel veel persoonlijker.',
            'avatar.image' => 'Jouw profielfoto is geen afbeelding.',
            'email.required' => 'Gelieve een emailadres in te voeren, zo kunnen we contact met je opnemen.',
            'email.email' => 'Je email is geen geldig emailadres.',
            'email.unique' => 'Deze email is blijkbaar al in gebruik, probeer een ander email adres',
            'password.required' => 'Vul een goed bedacht wachtwoord in, dat je makkelijk kan onthouden.',
            'password_confirm.required' => 'Vul je wachtwoord opnieuw in, let wel op voor typefouten!.',
            'password_confirm.same' => 'De wachtwoorden komen niet overeen, probeer eens opnieuw.'
        );

        $v = Validator::make(Input::all(), $rules, $messages);

        if ($v->fails()) {
            return Redirect::to('/register')->withErrors($v)->withInput(Input::except('avatar'));
        } else {
            $user = new User;
            $user->firstname = Input::get('firstname');
            $user->name = Input::get('name');
            $user->dateofbirth = date("Y-m-d", strtotime(Input::get('dateofbirth')));
            $user->email = Input::get('email');
            $user->class = Input::get('class');
            if (Input::get('type')) {
                $user->admin = Input::get('type');
            } else {
                $user->admin = 0;
            }

            $destinationPath = '';
            $filename = '';

            if (Input::hasFile('avatar')) {
                $file = Input::file('avatar');
                $destinationPath = public_path() . '/img/users/';
                $filename = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath, $filename);
                $user->avatar = '/img/users/' . $filename;
            }
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            if (!Auth::check())
                Auth::login($user);

            return Redirect::to('/register')->with('feedback', 'U bent succesvol geregistreerd');
        }
    }

    public function listall()
    {
        $users = User::get();
        $data = array("keys" => array("id", "email", "firstname", "name", "created_at"), "data" => $users);
        $headers = array("#" => "10", "Email" => "300", "Firstname" => "150", "Name" => "150", "Created at" => "100", "Actions" => "100");
        return View::make('admin.list')->with('data', $data)->with('headers', $headers)->with('title', 'Users');
    }

    public function edit($id = null)
    {
        if (!$id)
            $id = Auth::id();

        $user = User::find($id);

        return View::make('admin.editUser')->with('user', $user);
    }

    public function delete($id = null)
    {

        if (!$id)
            return Redirect::to('/')->with('feedback', array('error' => 'Deze gebruiker bestaat niet.'));

        $user = User::find($id);
        if (File::exists(public_path() . $user->avatar)) {
            File::delete(public_path() . $user->avatar);
        }
        $user->delete();
        return Redirect::to('/admin/user')->with('feedback', 'U bent geregistreerd!');
    }

    //USER EXTRA

    public function showLogin()
    {
        return View::make('users.login');
    }

    public function handleLogin()
    {

        $userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );

        $messages = array(
            'email.required' => 'Het email veld is leeg.',
            'email.email' => 'Het ingevoerde emailadres is niet geldig, probeer eens opnieuw',
            'password.required' => 'Gelieve je wachtwoord in te vullen.'
        );

        $validator = Validator::make($userdata, $rules, $messages);

        if ($validator->passes()) {
            if (Auth::attempt($userdata)) {
                return Redirect::to('/profile');
            } else {
                return Redirect::to('/login')->withErrors(array('password' => 'Oeps! Zo te zien komen de gebruikersnaam en het wachtwoord die je hebt ingevoerd komen niet overeen. Controleer de gegevens en probeer het opnieuw.'))->withInput(Input::except('password'));
            }
        }

        return Redirect::to('/login')->withErrors($validator)->withInput(Input::except('password'));
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    public function showDashboard()
    {
        return View::make('admin.home');
    }

    private function getExperience($userid)
    {
        $awards = Award::where('user_id', $userid)->get();
        $total = 0;
        foreach ($awards as $award) {
            $total += $award->xp;
        }

        return $total;
    }

    public function getLevel($userid)
    {
        $level = 1;
        $experience = $this->getExperience($userid);
        $tempxp = $experience;
        $req = 25;
        while ($tempxp >= $req) {
            $level++;
            $tempxp -= $req;
            $req *= 1.2;
            $req = ceil($req);
        }
        $total = array('level' => $level, 'xp' => $experience, 'required' => $req, 'leftOverXP' => $tempxp);
        return $total;
    }

    /* AJAX */
    public function ajaxSearch()
    {
        $name = Input::get("username");

        if (!empty($name)) {
            $users = User::where("firstname", "like", "%" . $name . "%")
                ->orWhere("name", "like", "%" . $name . "%")
                ->orderBy("created_at", "desc")
                ->get();
        } else {
            $users = User::where("type", "=", false)
                ->orWhere("type", "=", null)
                ->orderBy("created_at", "desc")
                ->get();
        }

        $response = array(
            "status" => "success",
            "users" => $users
        );
        return Response::json($response);
    }
}

?>
