<?php

namespace App\Http\Controllers;

use App\Chunks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class APIController extends Controller
{
    protected $dataResponse = [
        'ok' => false,
        'data' => false,
        'length' => 0,
    ];

    public function prepareDataResponse(array $data): array
    {
        return array_merge($this->dataResponse , $data);
    }

    public function chunks(): string
    {
        $key = trim( \request('key'));
        $data = Chunks::getChunksByType($key);

        $dataResponse = $this->prepareDataResponse([
            'ok' => !!$data,
            'data' => $data,
            'length' => count($data),
        ]);

        return response()
            ->json($dataResponse)
            ->getContent();
    }

    public function email()
    {
        $file = \request('file');
        $subject = trim( \request('subject'));
        $message = trim( \request('message'));

        $data = [
            'file' => $file,
            'subject' => $subject,
            'message' => $message
        ];

        $from = 'werdffelynir@gmail.com';
        $fromName = 'Laravel';
        $to = 'werdffelynir@gmail.com';
        $toName = 'Werdffelynir OL';
        $subject = 'Hello';
        $pathToFile = '';

        Mail::send('emails.sunmail', $data, function(\Illuminate\Mail\Message $message) use ($from, $fromName, $to, $toName, $subject, $pathToFile) {
            $message->subject($subject);
            $message->from($from, $fromName);
            $message->to($to, $toName);

            if ($pathToFile)
                $message->attach($pathToFile);
        });

    }
}
