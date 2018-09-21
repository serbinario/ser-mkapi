<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Serbinario\Entities\Log;
use Illuminate\Http\Request;
use Serbinario\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Exception;

class LogController extends Controller
{
    private $token;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the logs.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $logs = Log::paginate(25);

        return view('log.index', compact('logs'));
    }

    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception
     */
    public function grid()
    {
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('SystemEvents')
            ->leftJoin('mk_clientes', 'mk_clientes.login', '=', 'user')
            ->where('FromHost', '=', '170.245.65.134')
            ->select([
                'SystemEvents.ID',
                //'SystemEvents.Message',
                'SystemEvents.ReceivedAt',
                'SystemEvents.Message',
                \DB::raw('SPLIT_STRING(SystemEvents.Message, \',\', 1) as status'),
                \DB::raw('SPLIT_STRING(SystemEvents.Message, \',\', 2) as user'),
                \DB::raw('SPLIT_STRING(SystemEvents.Message, \',\', 3) as ip'),
            ]);;

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {
            return '';
        })->make(true);
    }

    public function logMikrotik(Request $request)
    {
        $manage = (array) json_decode($request->get('data'));
        //echo "eeeeeeee";
        Log::info(
            $manage
        );
        return \Response::make('message', 200);
    }



    /**
     * Show the form for creating a new log.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('log.create');
    }

    /**
     * Store a new log in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $this->affirm($request);
            $data = $this->getData($request);

            Log::create($data);

            return redirect()->route('log.log.index')
                ->with('success_message', 'Log was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified log.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $log = Log::findOrFail($id);

        return view('log.show', compact('log'));
    }

    /**
     * Show the form for editing the specified log.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $log = Log::findOrFail($id);


        return view('log.edit', compact('log'));
    }

    /**
     * Update the specified log in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            $this->affirm($request);
            $data = $this->getData($request);

            $log = Log::findOrFail($id);
            $log->update($data);

            return redirect()->route('log.log.index')
                ->with('success_message', 'Log was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Remove the specified log from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $log = Log::findOrFail($id);
            $log->delete();

            return redirect()->route('log.log.index')
                ->with('success_message', 'Log was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Validate the given request with the defined rules.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return boolean
     */
    protected function affirm(Request $request)
    {
        $rules = [
            'CustomerID' => 'nullable|string|min:0',
            'ReceivedAt' => 'nullable|string|min:0',
            'DeviceReportedTime' => 'nullable|string|min:0',
            'Facility' => 'nullable',
            'Priority' => 'nullable',
            'FromHost' => 'nullable|string|min:0|max:60',
            'Message' => 'nullable|numeric',
            'NTSeverity' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'Importance' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'EventSource' => 'nullable|string|min:0|max:60',
            'EventUser' => 'nullable|string|min:0|max:60',
            'EventCategory' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'EventID' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'EventBinaryData' => 'nullable',
            'MaxAvailable' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'CurrUsage' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'MinUsage' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'MaxUsage' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'InfoUnitID' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'SysLogTag' => 'nullable|string|min:0|max:60',
            'EventLogType' => 'nullable|string|min:0|max:60',
            'GenericFileName' => 'nullable|string|min:0|max:60',
            'SystemID' => 'nullable|numeric|min:-2147483648|max:2147483647',

        ];


        return $this->validate($request, $rules);
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $data = $request->only(['CustomerID','ReceivedAt','DeviceReportedTime','Facility','Priority','FromHost','Message','NTSeverity','Importance','EventSource','EventUser','EventCategory','EventID','EventBinaryData','MaxAvailable','CurrUsage','MinUsage','MaxUsage','InfoUnitID','SysLogTag','EventLogType','GenericFileName','SystemID']);

        return $data;
    }

}
