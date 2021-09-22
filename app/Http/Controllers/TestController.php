<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMarkdownMail;

class TestController extends Controller
{
    public function mail(){

        Mail::to('test@mail.test')->send(new TestMarkdownMail());

    }        
}
