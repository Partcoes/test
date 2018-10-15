<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = "欢迎使用邮箱注册我们的账号，希望你喜欢！！！";
        Mail::raw($content,function($message){
            // 发件人（你自己的邮箱和名称）
            $message->from('xishiwei0821@qq.com', 'Laravel Study');
            // 收件人的邮箱地址
            $message->to($this->user);
            // 邮件主题
            $message->subject('欢迎注册为我们的用户');
        });
    }
}
