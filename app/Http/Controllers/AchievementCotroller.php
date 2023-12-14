<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;
use App\Models\Achievement;
use App\Services\AchievementService;
use Illuminate\Http\Request;

class AchievementCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::latest()->paginate(10);
        return view('achievement.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('achievement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAchievementRequest $request, AchievementService $achievementService)
    {
        $achievementService->store(
            $request->validated()
        );
        return redirect()->back()->with(['success' => 'Achievement Add Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Achievement $achievement)
    {
        return view('achievement.edit', compact('achievement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAchievementRequest $request, Achievement $achievement, AchievementService $achievementService)
    {
        $achievementService->update(
            $achievement,
            $request->validated()
        );
        return redirect()->route('achievement.index')->with('success','Achievement Updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement, AchievementService $achievementService)
    {
        $achievementService->destroy(
            $achievement
        );

        return response('Achievement deleted');

    }
}
