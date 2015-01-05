<?php

    class CalendarController extends BaseController {

		//CALENDAR CRUD

		public function show($id) {

			$event = Calendar::find($id);

			if($event)
				return View::make('events.eventdetail')->with('event', $event);
			else
				return Redirect::to('/calendar')->with('feedback',array("error"=>"Dit evenement bestaat blijkbaar niet."));
		}

		public function add()
		{
			return View::make('admin.addEvent');
		}

        public function create() {

            $rules = array(
                'naam'      => 'required',
                'omschrijving'            => 'required',
                'adres'            => 'required',
                'gemeente'            => 'required',
                'postcode'            => 'required',
                'startdate'       => 'required|date',
                'url'              => 'url'
			  );

			$messages = array(
				'naam.required'	=>	'Gelieve de naam van het evenement in te vullen.',
				'omschrijving.required'	=>	'Geef een omschrijving van dit evenement.',
				'adres.required'	=>	'Vul het adres van het evenement in.',
				'gemeente.required'	=>	'Vul aan in welke gemeente het evenement plaatsvindt.',
				'postcode.required'	=>	'Vul de postcode van de gemeente in.',
				'startdate.required'	=>	'Vul de datum van het evenement in.',
				'startdate.date'	=>	'De startdatum is geen geldige datum, probeer opnieuw.',
				'url.url'	=>	'De ingevoerde url is niet geldig, opgelet voor het  http:// deel!'
			);

            $validate = Validator::make(Input::all(), $rules, $messages);

            if ($validate->fails())
            {
                return Redirect::to('/admin/event/add')->withErrors($validate)->withInput(Input::all());
            } else {
                $event = new Calendar;
                $event->name = Input::get('naam');
                $event->description = Input::get('omschrijving');
                $event->adres = Input::get('adres');
                $event->gemeente = Input::get('gemeente');
                $event->postcode = Input::get('postcode');
                $event->startdate = date("Y-m-d", strtotime(Input::get('startdate')));
                $event->url = Input::get('url');

                $destinationPath = '';
                $filename        = '';

                if (Input::hasFile('eventafb')) {
                    $file            = Input::file('eventafb');
                    $destinationPath = public_path() . '/img/calendars/';
                    $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $event->event_afbeelding    = '/img/calendars/' . $filename;
                }

                $event->save();

                return Redirect::to('/events')->with('message', 'Evenement toegevoegd.');
            }
        }

		public function showall(){
        $events = Calendar::orderBy('startdate', 'ASC')->get();;
        return View::make('events.events')->with('events',$events);
        }


		public function listall() {
            $events = Calendar::get();
			foreach( $events as $e) {
				$e->startdate = date('j-m-o', strtotime($e->startdate));
			}
			$data = array("keys" => array("id", "name", "gemeente", "startdate", "url"), "data" => $events);
			$headers = array("#" => "10", "Description" => "300", "Place" => "100", "Date" => "100", "URL" => "300", "Actions" => "100");
            return View::make('admin.list')->with('data', $data)->with('headers', $headers)->with('title', 'Events');
		}

		public function edit($id) {
             $event = Calendar::find($id);
            return View::make('admin.editEvent')->with('e', $event);
		}

		public function store($id) {
            $event = Calendar::find($id);
                $rules = array(
                        'naam'      => 'required',
                        'omschrijving'            => 'required',
                        'adres'            => 'required',
                        'gemeente'            => 'required',
                        'postcode'            => 'required',
                        'startdate'       => 'required|date',
                        'url'              => 'required|url'
                    );


				$messages = array(
					'naam.required'	=>	'Gelieve de naam van het evenement in te vullen.',
					'omschrijving.required'	=>	'Geef een omschrijving van dit evenement.',
					'adres.required'	=>	'Vul het adres van het evenement in.',
					'gemeente.required'	=>	'Vul aan in welke gemeente het evenement plaatsvindt.',
					'postcode.required'	=>	'Vul de postcode van de gemeente in.',
					'startdate.required'	=>	'Vul de datum van het evenement in.',
					'startdate.date'	=>	'De startdatum is geen geldige datum, probeer opnieuw.',
					'url.url'  =>  'De ingevoerde url is niet geldig, opgelet voor het  http:// deel!'
				);

                    $v = Validator::make(Input::all(), $rules, $messages);
                    if ($v->fails())
                    {
                        return Redirect::to('/admin/event')->withErrors($v)->withInput(Input::all());
                    } else {
                        $event->name = Input::get('naam');
                        $event->description = Input::get('omschrijving');
                        $event->adres = Input::get('adres');
                        $event->gemeente = Input::get('gemeente');
                        $event->postcode = Input::get('postcode');
                        $event->startdate = date("Y-m-d", strtotime(Input::get('startdate')));
                        $event->url = Input::get('url');
                        $event->save();

                        return Redirect::to('/admin/event')->with('message', 'Updated project');
                    }
		}

		public function delete($id) {
            $event = Calendar::find($id);
            $event->delete();
            return Redirect::to('/admin/event');
		}

    }

?>
