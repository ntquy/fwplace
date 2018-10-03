<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Workspace;
use App\Repositories\WorkspaceRepository;
use Storage;

class WorkspaceController extends Controller
{
    protected $workspace;

    public function __construct(WorkspaceRepository $workspaceRepository)
    {
        $this->workspace = $workspaceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workspaces = $this->workspace->getWorkspaces();

        return view('admin.workspace.list', compact('workspaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.workspace.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:1|max:191|unique:workspaces,name',
                'image' => 'image|required'
            ]
        );
        $data = $request->all();
        if ($request->hasFile('image')) {
            $request->image->store(config('site.workspace.image'));
            $data['image'] = $request->image->hashName();
        }
        $save = $this->workspace->create($data);

        return redirect()->route('workspaces.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workspace = $this->workspace->findOrFail($id);

        return view('admin.workspace.edit', compact('workspace'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $workspace = $this->workspace->findOrFail($id);
        $this->validate(
            $request,
            [
                'name' => 'required|min:1|max:191|unique:workspaces,name,' . $workspace->id,
                'image' => 'image'
            ]
        );
        $data = $request->all();
        if ($request->hasFile('image')) {
            Storage::delete(config('site.workspace.image') . '/' . $workspace->image);
            $request->image->store(config('site.workspace.image'));
            $data['image'] = $request->image->hashName();
        }
        $save = $this->workspace->update($data, $id);

        return redirect()->route('workspaces.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workspace = $this->workspace->delete($id);

        return redirect()->route('workspaces.index');
    }
}
