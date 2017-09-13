<?php

namespace App\Jobs;

use App\Content;
use App\Mail\ContentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendContentNotificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $content;
    protected $ciclos;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($content, $ciclos = false)
    {
        $this->content = $content;
        $this->ciclos = $ciclos;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $Configurations = \App\NotificationConfiguration::all();
        $contentType = '';
        if($this->ciclos && $Configurations->filter(function($c){return $c->name == 'meetings' && $c->value;})->count() > 0){
            $contentType = 'archivo en reunion de ciclos';
        }else{
            if($this->content instanceof \App\Course && $Configurations->filter(function($c){return $c->name == 'course' && $c->value;})->count() > 0){
                $contentType = 'curso';
            }else if($this->content instanceof \App\Product && $Configurations->filter(function($c){return $c->name == 'product' && $c->value;})->count() > 0){
                $contentType = 'producto';
            }else if($this->content instanceof \App\Post && $Configurations->filter(function($c){return $c->name == 'post' && $c->value;})->count() > 0){
                $contentType = 'articulo';
            }else if($this->content instanceof \App\ProductCategory && $Configurations->filter(function($c){return $c->name == 'product_category' && $c->value;})->count() > 0){
                $contentType = 'categoria de producto';
            }
        }

        if(!empty($contentType)){
            $Users = \App\Role::where('name', 'user')->get()->get(0)->users;
            Mail::bcc($Users)->send(new ContentNotification($contentType));
        }
    }
}
