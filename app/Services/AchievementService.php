<?php

namespace App\Services;

use App\Models\Achievement;
use Illuminate\Support\Facades\DB;

class AchievementService
{
    public function store(array $data)
    {
        DB::transaction(function() use ($data){
            Achievement::create($data);
        });
    }


    public function update(Achievement $achievement, array $data)
    {
        DB::transaction(function() use ($achievement, $data){
            $achievement->update($data);
        }, 5);
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
    }

}
