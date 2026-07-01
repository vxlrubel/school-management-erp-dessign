<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Gallery;
use App\Models\Notice;
use App\Models\Page;
use App\Models\PopupSetting;
use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            foreach ([1, 2] as $schoolId) {
                $pages = [
                    ['title' => 'Home', 'content' => 'Welcome to our school. We provide quality education with modern facilities.'],
                    ['title' => 'About', 'content' => 'Our school was established with a vision to provide excellence in education. We have a rich history of academic achievement and character development.'],
                    ['title' => 'Academics', 'content' => 'We offer comprehensive academic programs from Class Six to Ten following the national curriculum. Our experienced faculty ensures every student reaches their full potential.'],
                    ['title' => 'Admissions', 'content' => 'Admissions are open for the academic year 2026-2027. Please visit our campus or apply online through our admission portal.'],
                    ['title' => 'Contact', 'content' => 'Feel free to reach out to us for any inquiries. Our administrative office is open Sunday through Thursday from 9:00 AM to 5:00 PM.'],
                ];

                foreach ($pages as $pageData) {
                    Page::create([
                        'school_id' => $schoolId,
                        'title' => $pageData['title'],
                        'slug' => strtolower($pageData['title']),
                        'content' => $pageData['content'],
                        'status' => 'published',
                    ]);
                }

                $sliders = [
                    ['title' => 'Welcome to Our School', 'image' => 'sliders/slide1.jpg', 'link' => '/about'],
                    ['title' => 'Excellence in Education', 'image' => 'sliders/slide2.jpg', 'link' => '/academics'],
                    ['title' => 'Admissions Open 2026', 'image' => 'sliders/slide3.jpg', 'link' => '/admissions'],
                ];

                foreach ($sliders as $slider) {
                    Slider::create([
                        'school_id' => $schoolId,
                        'title' => $slider['title'],
                        'image' => $slider['image'],
                        'link' => $slider['link'],
                    ]);
                }

                $galleryCategories = ['Cultural Program', 'Sports Day', 'Science Fair', 'Annual Picnic', 'Award Ceremony'];
                foreach ($galleryCategories as $cat) {
                    Gallery::create([
                        'school_id' => $schoolId,
                        'title' => $cat.' - '.date('Y'),
                        'image' => 'gallery/'.strtolower(str_replace(' ', '-', $cat)).'.jpg',
                        'category' => $cat,
                    ]);
                }

                $notices = [
                    ['title' => 'Annual Exam Schedule 2026', 'description' => 'The annual examination schedule has been published. Please check the notice board for details.', 'publish_date' => now()->addDays(15)],
                    ['title' => 'School Holiday on 21 February', 'description' => 'The school will remain closed on 21 February on occasion of International Mother Language Day.', 'publish_date' => now()->addDays(10)],
                    ['title' => 'PTA Meeting Notice', 'description' => 'Parents-Teachers Association meeting will be held on the first Sunday of next month.', 'publish_date' => now()->addDays(5)],
                    ['title' => 'Summer Vacation Schedule', 'description' => 'Summer vacation will start from May 1 and continue until May 31. School will reopen on June 1.', 'publish_date' => now()->addDays(20)],
                    ['title' => 'New Session Orientation', 'description' => 'Orientation program for new students of session 2026-2027 will be held on January 15.', 'publish_date' => now()->addDays(30)],
                ];

                foreach ($notices as $notice) {
                    Notice::create([
                        'school_id' => $schoolId,
                        'title' => $notice['title'],
                        'description' => $notice['description'],
                        'publish_date' => $notice['publish_date'],
                    ]);
                }

                $events = [
                    ['title' => 'Annual Sports Day 2026', 'start_date' => now()->addMonths(2), 'end_date' => now()->addMonths(2)->addDays(1), 'description' => 'Annual sports competition with various athletic events and team games.'],
                    ['title' => 'Science & Technology Fair', 'start_date' => now()->addMonths(3), 'end_date' => now()->addMonths(3)->addDays(2), 'description' => 'Students will showcase their science projects and technological innovations.'],
                    ['title' => 'Cultural Program & Prize Giving Ceremony', 'start_date' => now()->addMonths(4), 'end_date' => now()->addMonths(4), 'description' => 'Annual cultural program followed by prize distribution for outstanding students.'],
                ];

                foreach ($events as $event) {
                    Event::create([
                        'school_id' => $schoolId,
                        'title' => $event['title'],
                        'start_date' => $event['start_date'],
                        'end_date' => $event['end_date'],
                        'description' => $event['description'],
                    ]);
                }

                PopupSetting::create([
                    'school_id' => $schoolId,
                    'title' => 'Admissions Open for 2026-2027',
                    'image' => 'popups/admission-popup.jpg',
                    'button_link' => '/admissions',
                ]);
            }
        });
    }
}
