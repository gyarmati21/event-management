<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Fetch users
        $robot = User::where('name', 'Robot')->first();
        $mike = User::where('name', 'Mike')->first();
        $patrik = User::where('name', 'Patrik')->first();

        // Create events for Robot with images
        Event::create([
            'name' => 'AI Webinar',
            'date' => '2024-04-05',
            'location' => 'Online',
            'type' => 'Webinar',
            'description' => 'An in-depth webinar on the future of artificial intelligence.',
            'created_by' => $robot->id,
            'is_vip' => 1,
            'image' => 'uploads/events/1729228566.png' // Image path for AI Webinar
        ]);

        Event::create([
            'name' => 'Cybersecurity Webinar',
            'date' => '2024-10-02',
            'location' => 'Online',
            'type' => 'Webinar',
            'description' => 'A webinar discussing the latest trends in cybersecurity.',
            'created_by' => $robot->id,
            'is_vip' => 1,
            'image' => 'uploads/events/cybersec_webinar.jpg' // Image path for Cybersecurity Webinar
        ]);

        // Create events for Mike with images
        Event::create([
            'name' => 'Cloud Computing Conference',
            'date' => '2024-08-10',
            'location' => 'Tokyo, Japan',
            'type' => 'Conference',
            'description' => 'A global conference focused on advancements in cloud computing.',
            'created_by' => $mike->id,
            'is_vip' => 0,
            'image' => 'uploads/events/cloud_conf.jpg' // Image path for Cloud Computing Conference
        ]);

        Event::create([
            'name' => 'Gaming Este',
            'date' => '2024-10-30',
            'location' => 'Szeged',
            'type' => 'Gaming',
            'description' => 'we game',
            'created_by' => $mike->id,
            'is_vip' => 0,
            'image' => 'uploads/events/gaming_event.jpg' // Image path for Gaming Este
        ]);

        // Create events for Patrik with images
        Event::create([
            'name' => 'JavaScript Hackathon',
            'date' => '2024-09-25',
            'location' => 'London, UK',
            'type' => 'Meetup',
            'description' => 'A 48-hour hackathon focused on building JavaScript projects.',
            'created_by' => $patrik->id,
            'is_vip' => 0,
            'image' => 'uploads/events/js_hackathon.jpg' // Image path for JavaScript Hackathon
        ]);

        Event::create([
            'name' => 'Ásotthalmi Főzőverseny',
            'date' => '2024-12-19',
            'location' => 'Ásotthalom',
            'type' => 'Cooking',
            'description' => 'Ásotthalmi főzőverseny, a legjobb öt versenyző díjazva lesz!',
            'created_by' => $patrik->id,
            'is_vip' => 0,
            'image' => 'uploads/events/mostmivan.jpg' // Image path for mostmivan
        ]);
    }
}
