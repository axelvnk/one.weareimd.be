<?php

class CommentController extends BaseController
{

    public function comment($id)
    {

        $rules = array(
            'text' => 'required'
        );
        $messages = array(
            'text.required' => 'Je moet verplicht tekst invullen.'
        );
        $v = Validator::make(Input::all(), $rules, $messages);

        if ($v->fails()) {
            return Redirect::to('projects/' . $id)->withErrors($v);
        } else {
            $comment = new Comment;
            $comment->text = nl2br(Input::get('text'));
            $comment->user_id = Auth::id();
            $comment->project_id = $id;
            $comment->Save();

            $targetproject = Project::find($id);
            $targetuser = $targetproject->user_id;
            $allProjects = Project::with('comments')->where('user_id', $targetuser)->get();
            $total = 0;

            foreach ($allProjects as $p) {
                $total += count($p->comments);
            }

            $award = new Award;
            $award->xp = 2;
            $award->user_id = $targetuser;
            $award->save();

            if ($total % 5 == 0) {
                $award = new Award;
                $award->user_id = $targetuser;
                $award->xp = 10;
                $award->save();
            }


            return Redirect::to('projects/' . $id)->with('message', 'Uw reactie is succesvol geplaatst');
        }
    }

    public function remove($id)
    {
        $comment = Comment::find($id);
        $project = Project::find($comment->project_id);
        if (Auth::id() == $comment->user_id) {
            $targetuser = $project->user_id;

            $allProjects = Project::with('comments')->where('user_id', $targetuser)->get();
            $total = 0;

            foreach ($allProjects as $p) {
                $total += count($p->comments);
            }

            $award = Award::where('xp', 2)->get();
            $award->first()->delete();

            if ($total % 5 == 0) {
                $award = Award::where('xp', 10)->get();
                $award->first()->delete();
            }

            $comment->delete();
        } else {
            return Redirect::to('projects/' . $project->id)->with('feedback', array('error' => 'U kan de commentaren van andere personen niet verwijderen!'));
        }
    }

    public function ajaxComment()
    {
        $id = Input::get('project_id');

        $rules = array(
            'text' => 'required'
        );
        $messages = array(
            'text.required' => 'Je moet verplicht tekst invullen.'
        );
        $v = Validator::make(Input::all(), $rules, $messages);

        if ($v->fails()) {
            return Redirect::to('projects/' . $id)->withErrors($v);
        } else {
            $comment = new Comment;
            $comment->text = nl2br(Input::get('text'));
            $comment->user_id = Auth::id();
            $comment->project_id = $id;
            $comment->Save();

            $comment = Comment::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(1)->get();

            $targetproject = Project::find($id);
            $targetuser = $targetproject->user_id;
            $allProjects = Project::with('comments')->where('user_id', $targetuser)->get();
            $total = 0;

            foreach ($allProjects as $p) {
                $total += count($p->comments);
            }

            $award = new Award;
            $award->xp = 2;
            $award->user_id = $targetuser;
            $award->save();

            if ($total % 5 == 0) {
                $award = new Award;
                $award->user_id = $targetuser;
                $award->xp = 10;
                $award->save();
            }


            $count = Comment::where('project_id', $id)->count();

            $response = array("status" => "success", "comment" => $comment->first(), "comment_count" => $count, "user" => User::find(Auth::id()));
            return Response::json($response);
        }

    }

    public function ajaxRemove()
    {
        $id = Input::get('id');
        $projectid = Input::get('projectid');
        $comment = Comment::find($id);

        $targetuser = Input::get('authorid');
        $allProjects = Project::with('comments')->where('user_id', $targetuser)->get();
        $total = 0;

        foreach ($allProjects as $p) {
            $total += count($p->comments);
        }

        $award = Award::where('xp', 2)->get();
        $award->first()->delete();

        if ($total % 5 == 0) {
            $award = Award::where('xp', 10)->get();
            $award->first()->delete();
        }

        $comment->delete();
        $count = Comment::where('project_id', $projectid)->count();

        $response = array("status" => "success", "commentcount" => $count, "comment" => $id);
        return Response::json($response);
    }

}
