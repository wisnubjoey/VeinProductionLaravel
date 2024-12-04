<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run()
    {
        Booking::create([
            'client_name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '081234567890',
            'event_date' => '2024-12-25',
            'event_type' => 'Wedding',
            'location' => 'Bali',
            'package_type' => 'Premium Package',
            'special_requests' => 'Extra lighting needed',
            'status' => 'pending'
        ]);

        // Tambah beberapa data lagi untuk testing
        Booking::create([
            'client_name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '087654321098',
            'event_date' => '2024-11-15',
            'event_type' => 'Birthday',
            'location' => 'Ubud',
            'package_type' => 'Basic Package',
            'status' => 'contacted'
        ]);
    }
}