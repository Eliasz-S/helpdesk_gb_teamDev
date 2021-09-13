<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use App\Http\Requests\IssueStore;
use App\Http\Requests\IssueUpdate;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $objIssue = new Issue();

        // return $objIssue->all();

        $issues = Issue::all();

        return view('issue.index', [
            'issues' => $issues,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('issue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IssueStore $request, Issue $issue)
    {
        $data = $request->validated();
        $statusIssue = $issue->fill($data)->save();

        if ($statusIssue) {
            return response()->json(['message' => 'Success']);
            // return redirect()->route('tickets.index')->with('success', __('submitted successfully'));

        }
        return response()->json(['message' => 'Error'], 400);
        // return back()->with('error', __('error occured, please try latter'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        return view('issue.edit', [
            'issue' => $issue,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(IssueUpdate $request, Issue $issue)
    {
        $data = $request->validated();
        $statusIssue = $issue->fill($data)->save();

        if ($statusIssue) {
            return response()->json(['message' => 'Success']);
            // return redirect()->route('tickets.index')->with('success', __('submitted successfully'));

        }
        return response()->json(['message' => 'Error'], 400);
        // return back()->with('error', __('error occured, please try latter'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        $status = $issue->delete();
        if ($status) {
            return response()->json(['ok' => 'ok']);
        }
    }
}
