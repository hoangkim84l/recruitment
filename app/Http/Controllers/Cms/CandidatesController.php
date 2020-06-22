<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Candidates;
use App\Services\PayUService\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class CandidatesController extends Controller
{
    /**
     * Description:  show all candidates.
     * Function: index()
     * @author: Duy
     * @version: 1.0
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $candidates = Candidates::orderBy('id', 'desc')->where('candidates.delete_flg', 0)->paginate(10);
        return view('cms/candidates.index', compact('candidates', $candidates));
    }
    /**
     * Description: Remove the specified resource from storage.
     * @param  \App\applies  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Candidates::find($id)) {
                $candidates = Candidates::find($id);
                //$user->delete();
                DB::table('candidates')
                    ->where('id', $id)
                    ->update([
                        'delete_flg' => 1,
                        'modified' => now(),
                    ]);
                $mess_v2 = config('master.MESSAGE_NOTIFICATION.MSG_104');
                return redirect()->action('Cms\CandidatesController@index')->with('message', $mess_v2);
            } else {
                $mess_v3 = config('master.MESSAGE_NOTIFICATION.MSG_202');
                return redirect()->action('Cms\CandidatesController@index')->with('message', $mess_v3);
            }
        } catch (Exception $e) {
            return redirect()->action('Cms\CandidatesController@index')->with('message', $e);
        }

    }
    /**
     * Create function export csv file.
     * @author: VPDuy to be countinue
     * @return void
     * @version: V.1
     */
    public function exportFile()
    {
        $headers = [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0'
            , 'Content-type' => 'text/csv'
            , 'Content-Disposition' => 'attachment; filename=galleries.csv'
            , 'Expires' => '0'
            , 'Pragma' => 'public',
        ];

        $list = Candidates::all()->toArray();
        $columns = array(`name`);
        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function () use ($list, $columns) {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers); //use Illuminate\Support\Facades\Response;
    }
    /**
     * Description: Search by name or email or role or dateCreated
     * Input name or email.
     * @author: VPDuy
     * @version:V.1
     * @result: info user sample name or email.
     */
    public function search()
    {
        $name = Input::get('name');
        $email = Input::get('email');
        $created_from = Input::get('dateintrostart');
        $created_to = !empty(Input::get('dateintroend')) ? Input::get('dateintroend') : date('m/d/Y', time());
        $cre_from = date('Y-m-d', strtotime($created_from));
        $cre_to = date('Y-m-d', strtotime($created_to));
        $datenow = date('Y-m-d', strtotime(now()));

        //Query
        $query = DB::table('candidates')->where('candidates.delete_flg', 0);

        $is_first = false;
        if ($name != "") {
            if ($is_first) {
                $query->orWhere('name', 'LIKE', '%' . $name . '%');
            } else {
                $is_first = true;
                $query->where('name', 'LIKE', '%' . $name . '%');
            }
        }
        if ($email != "") {
            if ($is_first) {
                $query->orWhere('email', 'LIKE', '%' . $email . '%');
            } else {
                $is_first = true;
                $query->where('email', 'LIKE', '%' . $email . '%');
            }
        }
        if ($cre_from != $datenow) {
            if ($is_first) {
                $query->orWhereBetween('candidates.created', [$cre_from, $cre_to]);
            } else {
                $is_first = true;
                $query->whereBetween('candidates.created', [$cre_from, $cre_to]);
            }
        }
        if ($name == "" && $email == "" && $cre_from == "1970-01-01" && $cre_to == "1970-01-01") {
            if ($is_first) {
                $query->orWhere('name', 'LIKE', '%' . $name . '%');
            } else {
                $is_first = true;
                $query->where('name', 'LIKE', '%' . $name . '%');
            }
        }

        $user = $query->where('candidates.delete_flg', 0)->get();
        if (count($user) >= 0) {
            $mess_v3 = config('master.MESSAGE_NOTIFICATION.MSG_105');
            return view('cms/candidates/search')->withDetails($user)
                ->with('message', $mess_v3);
        } else {
            $mess_v2 = config('master.MESSAGE_NOTIFICATION_ERROR.MSG_203');
            return redirect()->action('Cms\CandidatesController@search')->with('message', $mess_v2);
        }

    }
}
