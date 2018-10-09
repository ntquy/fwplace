<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LocationRepository;
use App\Repositories\WorkspaceRepository;

class WorkingScheduleController extends Controller
{
    public function __construct(LocationRepository $locationRepository, WorkspaceRepository $workspaceRepository, UserRepository $userRepository)
    {
        $this->location = $locationRepository;
        $this->workspace = $workspaceRepository;
        $this->userRepository = $userRepository;
    }

    public function viewByWorkplace($workplace_id)
    {
        $workspace = $this->workspace->findOrFail($workplace_id);

        return view('admin.work_schedules.workspace', compact('workspace'));
    }

    public function getData(Request $request, $workplace_id)
    {
        $workspace = $this->workspace->findOrFail($workplace_id);
        $this->validate(
            $request,
            [
                'start' => 'required',
                'end' => 'required'
            ]
        );
        $dates = [
            'start' => $request->start,
            'end' => $request->end
        ];
        $data = $this->workspace->getData($workplace_id, $dates);

        return $data;
    }

    public function chooseWorkplace()
    {
        $workspaces = $this->workspace->getWorkspaces();

        return view('admin.work_schedules.choose_workspace', compact('workspaces'));
    }

    public function viewByUser($user_id)
    {
        $user = $this->userRepository->findOrFail($user_id);

        return view('admin.user.timesheet', compact('user'));
    }

    public function getDataUser(Request $request, $user_id)
    {
        $this->validate(
            $request,
            [
                'start' => 'required',
                'end' => 'required'
            ]
        );
        $dates = [
            'start' => $request->start,
            'end' => $request->end
        ];
        $data = $this->userRepository->getDataUserTimesheet($user_id, $dates);

        return $data;
    }
}
