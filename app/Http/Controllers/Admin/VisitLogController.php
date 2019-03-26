<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Sarfraznawaz2005\VisitLog\Models\VisitLog as VisitLogModel;
use TCG\Voyager\Facades\Voyager;

class VisitLogController extends Controller
{

    public function __construct()
    {
        if (config('visitlog.http_authentication')) {
            $this->middleware('auth.basic');

        }
    }

    /**
     * Displays all visitor information in table.
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->hasPermission('visit-log')){
            if (!config('visitlog.visitlog_page')) {
                abort(404);
            }

            $visitlogs = VisitLogModel::all();

            return view('visitlog::index', compact('visitlogs'));
        }
        return abort(404);

    }


    /**
     * Deletes a record.
     *
     * @param $id
     * @param VisitLogModel $visitLog
     * @return mixed
     */
    public function destroy($id, VisitLogModel $visitLog)
    {
        Voyager::canOrFail('visit-log');
        $visitLog = $visitLog->find($id);

        if ($visitLog && !$visitLog->delete()) {
            return Redirect::back()->withErrors($visitLog->errors());
        }

        return Redirect::back();
    }

    /**
     * Deletes all records.
     *
     * @param VisitLogModel $visitLog
     * @return mixed
     */
    public function destroyAll(VisitLogModel $visitLog)
    {
        Voyager::canOrFail('visit-log');
        if (!$visitLog->truncate()) {
            return Redirect::back()->withErrors($visitLog->errors());
        }

        return Redirect::back();
    }
}
