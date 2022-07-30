<?php

namespace App\Http\Controllers;

use App\Events\ArticleWasCreate;
use App\Events\PodcastProcessed;
use App\Events\TestProcessed;
use App\Listeners\TestEventProcessed;
use App\Models\Article;
use App\Services\Mailer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Psr\Log\LoggerInterface;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('article.index', ['articles' => Article::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $article = new Article();
        return view('article.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, Mailer $mailer, LoggerInterface $logger)
    {
        // Псевдокод
        $data = $request->request->all();
        unset($data['_token']);
        $article = new Article($data);
        try {
            $article->save();
            $mailer->sendEmail($article->head . ' Was created!', $logger);
            $event = new ArticleWasCreate($article->head . ' Was created!');
            event($event);

        } catch (\Throwable $exception) {
            Log::error('something happened!', ['head' => $article->head, 'ex' => $exception]);
        }
        return redirect('articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        return view('articles', []);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}