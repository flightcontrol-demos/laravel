<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
// add this to the top of the file
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        };
        Model::preventLazyLoading(! app()->environment('production'));
        Relation::enforceMorphMap([
            'article' => Article::class,
            'user' => User::class,
            'tag' => Tag::class,
            'comment' => Comment::class,
        ]);
        Model::unguard();
    }
}
