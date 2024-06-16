<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SampleMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SampleController extends Controller
{
    public function mail()
    {
        $stream = Storage::readStream('sample.png');
        $imgData = stream_get_contents($stream);
        fclose($stream);

        Mail::to("XXXXXXXXXXXXXXXX@gmail.com")
            ->cc("XXXXXXXXXXXXXXX@gmail.com")
            ->bcc("XXXXXXXXXXXXXXXXX@gmail.com")
            ->send(new SampleMail('sample text', 'sample.png', 'image/png', $imgData));

        return view('sample.mail');
    }

}
