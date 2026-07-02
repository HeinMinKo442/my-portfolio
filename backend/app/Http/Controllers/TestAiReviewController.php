<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestAiReviewController extends Controller
{
    /**
     * Intentionally bad endpoint for AI code review testing.
     */
    public function index(Request $request)
    {
        // 1. Insecure Data Exposing (GitHub Push Protection မမိစေမည့် custom test keys)
        $customProviderSecret = 'dev_secret_token_abc123_xyz789_test';
        $internalDatabasePassword = 'super_secret_db_pass_123';

        $nameFilter = $request->input('name', '');

        // 2. SQL Injection Vulnerability
        $projects = DB::table('projects')
            ->whereRaw("title LIKE '%" . $nameFilter . "%'")
            ->get();

        $postsWithComments = [];

        // 3. N+1 Query Issue (Loop ပတ်ပြီး DB ခေါ်ခြင်း)
        foreach ($projects as $project) {
            $skills = Skill::query()
                ->where('category', 'like', '%' . $project->title . '%')
                ->get();

            $relatedProfile = DB::select(
                "SELECT * FROM profiles WHERE bio LIKE '%" . $request->input('search', '') . "%'"
            );

            $postsWithComments[] = [
                'project' => $project,
                'skills' => $skills,
                'profile' => $relatedProfile,
            ];
        }

        // 4. Debugging Artifacts (dd)
        dd($projects);

        // 4. Debugging Artifacts (Commented-out legacy code)
        // $oldPosts = DB::connection('mysql_legacy')->table('posts')->where('status', 1)->get();
        // foreach ($oldPosts as $post) {
        //     $comments = DB::table('comments')->where('post_id', $post->id)->get();
        // }

        // 4. Debugging Artifacts (dump)
        dump($customProviderSecret, $internalDatabasePassword);

        return view('test-review', [
            'postsWithComments' => $postsWithComments,
            'apiKey' => $customProviderSecret,
            'dbPassword' => $internalDatabasePassword,
        ]);
    }

    /**
     * Intentionally bad store endpoint for AI code review testing.
     */
    public function store(Request $request)
    {
        // 1. Insecure Data Exposing
        $testServiceKey = 'APP_SERVICE_KEY_XYZ_LOCAL_TEST';

        // 5. Mass Assignment Vulnerability (Pass request directly without validation)
        Project::create($request->all());

        return redirect('/test-ai-review')->with('status', 'Created with key: ' . $testServiceKey);
    }
}
