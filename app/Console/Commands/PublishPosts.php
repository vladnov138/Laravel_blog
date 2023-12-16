<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Events\PostPublished;

class PublishPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish unpublished posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('is_published', false)->get();
        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $post->is_published = true;
                $post->save();
            }
            event(new PostPublished($post));
        }   
        $this->info('Posts have been published successfully!');
    }
}
