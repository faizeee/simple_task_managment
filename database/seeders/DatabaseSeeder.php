<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        Project::truncate();
        ProjectTask::truncate();

        // Create 3 dummy projects and each project will have 3 tasks some dummy data to get started. that's why i didnt used the factories
        $priority = 1;
        for($i=1;$i<=3;$i++){
            $project = Project::create(['title'=>"Project $i"]);
            $tasks = [];
            for($j=1;$j<=3;$j++){
                $tasks[] = ['title'=>"Task $priority",'priority'=>$priority];
                $priority++;
            }
            $project->projectTasks()->createMany($tasks);
        }
    }
}
