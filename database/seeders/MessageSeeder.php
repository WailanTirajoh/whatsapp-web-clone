<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            [
                'sender_id' => 1,
                'room_id' => 1,
                'message' => 'Testing 1 to 2',
            ],
            [
                'sender_id' => 2,
                'room_id' => 1,
                'message' => 'Testing 2 to 1',
            ],
        ];

        foreach ($messages as $message) {
            Message::create($message);
        }
    }
}
