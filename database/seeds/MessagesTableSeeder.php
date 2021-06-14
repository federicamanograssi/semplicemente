<?php

use Illuminate\Database\Seeder;
use App\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages=config('messages');

        foreach ($messages as $message) {
            $newMessage = new Message();
            $newMessage->id_apartment = $message['id_apartment'];
            $newMessage->email_sender = $message['email_sender'];
            $newMessage->message_text = $message['message_text'];
            $newMessage->save();
        }
    }
}
