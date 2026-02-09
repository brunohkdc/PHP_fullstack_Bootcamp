<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Gates
        Gate::define('is.admin', function (User $user) : bool{
            return ((bool)($user->role === 'admin'));
        });

        Gate::define('my.post', function (User $user, Post $post) {
        return $user->id === $post->user_id;
        });

        Gate::define('my.comment', function (User $user, Comment $comment) {
        return $user->id === $comment->user_id;
        });
    }
}
