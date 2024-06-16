<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SampleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sample;
    private $imgName;
    private $imgMineType;
    private $imgData;

    public function __construct($sample, $imgName, $imgMineType, $imgData)
    {
        $this->sample = $sample;
        $this->imgName = $imgName;
        $this->imgMineType = $imgMineType;
        $this->imgData = $imgData;
    }

    public function build()
    {

        return $this->view('sample.mailContentHtml')
                     ->text('sample.mailContentText')
                     ->subject('sample mail')
                     ->attachData(
                         $this->imgData,
                         $this->imgName,
                         [
                         'mime' => $this->imgMineType,
                         ]);
    }
}
