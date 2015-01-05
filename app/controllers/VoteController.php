<?php

	class VoteController extends BaseController{

		public function vote($id){
			$query = DB::table('votes')->where(
				array('project_id' => $id, 'user_id' => Auth::id())
			)->count();

			if ($query == 0) {
				$vote = new Vote;
				$vote->user_id = Auth::id();
				$vote->project_id = $id;
				$vote->Save();

				$targetproject = Project::find($id);
				$targetuser = $targetproject->user_id;

				$totalvotes = Project::with('votes')->where('user_id', $targetuser);
				$total = count($totalvotes);

				$award = new Award;
				$award->user_id = $targetuser;
				$award->xp = 1;
				$award->save();

				if($total%5==0)
				{
					$award = new Award;
					$award->user_id = $targetuser;
					$award->xp = 5;
					$award->save();
				}

				return Redirect::back();
			}else{
				return Redirect::back();
			}
		}

		public function unvote($id){
			$vote = DB::table('votes')->where(
				array('project_id' => $id, 'user_id' => Auth::id())
			);

			$targetproject = Project::find($id);
			$targetuser = $targetproject->user_id;
			$allProjects = Project::with('votes')->where('user_id', $targetuser)->get();
			$total = 0;

			foreach ($allProjects as $p) {
				$total += count($p->votes);
			}

			$award = Award::where(array('xp'=>1, 'user_id'=>$targetuser))->take(1)->get();
			$award->first()->delete();

			if($total%5==0)
			{
				$award = Award::where(array('xp'=>5, 'user_id'=>$targetuser))->take(1)->get();
				$award->first()->delete();
			}

			$vote->delete();

			return Redirect::back();
		}

		public function ajaxVote() {
			$id = Input::get('project_id')['project'];
			$count = Vote::where(array('project_id' => $id, 'user_id' => Auth::id()))->count();

			if($count==0) {
				$vote = new Vote;
				$vote->user_id = Auth::id();
				$vote->project_id = $id;
				$vote->save();

				$targetproject = Project::find($id);
				$targetuser = $targetproject->user_id;
				$allProjects = Project::with('votes')->where('user_id', $targetuser)->get();
				$total = 0;

				foreach ($allProjects as $p) {
					$total += count($p->votes);
				}

				$award = new Award;
				$award->user_id = $targetuser;
				$award->xp = 1;
				$award->save();

				if($total%5==0)
				{
					$award = new Award;
					$award->user_id = $targetuser;
					$award->xp = 5;
					$award->save();
				}

				$votes = Vote::where('project_id',$id)->count();

				$response = array("status" => "success", "votes" => $votes, "project" => $id);
				return Response::json($response);
			} else {
				$response = array("status" => "failed", "votes" => $count, "project" => $id);
				return Response::json($response);
			}

		}

		public function ajaxUnvote() {
			$id = Input::get('project_id')['project'];
			$count = Vote::where(array('project_id' => $id, 'user_id' => Auth::id()))->count();

			$vote = Vote::where(
				array('project_id' => $id, 'user_id' => Auth::id())
			);

			$targetproject = Project::find($id);
			$targetuser = $targetproject->user_id;
			$allProjects = Project::with('votes')->where('user_id', $targetuser)->get();
			$total = 0;

			foreach ($allProjects as $p) {
				$total += count($p->votes);
			}

			$award = Award::where(array('xp'=>1, 'user_id'=>$targetuser))->take(1)->get();
			$award->first()->delete();

			if($total%5==0)
			{
				$award = Award::where(array('xp'=>5, 'user_id'=>$targetuser))->take(1)->get();
				$award->first()->delete();
			}

			$vote->delete();
			$votes = Vote::where('project_id',$id)->count();

			$response = array("status" => "success", "votes" => $votes, "project" => $id);
			return Response::json($response);
		}

	}
