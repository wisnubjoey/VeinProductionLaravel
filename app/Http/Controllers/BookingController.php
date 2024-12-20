<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()
            ->select('id', 
            'client_name',
            'email',           // Tambahkan ini
            'phone',           // Tambahkan ini
            'event_date',
            'event_type',
            'location',        // Tambahkan ini
            'package_type',
            'special_requests', // Tambahkan ini
            'status',
            'created_at',
            'updated_at')
        ->paginate(50);
        
        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'package_type' => 'required|string|max:255',
            'special_requests' => 'nullable|string',
        ]);

        $booking = Booking::create($validated);

        try {
            Mail::raw("Ada Booking Baru!\n\nNama: {$booking->client_name}\nEmail: {$booking->email}\nPackage: {$booking->package_type}", function($message) {
                $message->to('manusiq630@gmail.com')
                ->subject('Ada yang mesen pin !');
            });
        } catch (\Exception $e) {
            \Log::error('Error sending email: ' . $e->getMessage());
        }

        return response()->json($booking, 201);
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return response()->json($booking);
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,contacted,confirmed,completed'
    ]);

    $booking = Booking::findOrFail($id);
    $booking->update(['status' => $request->status]);

    return response()->json($booking);
}

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return response()->json(null, 204);
    }

    public function getStats()
{
    $stats = [
        'total_bookings' => Booking::count(),
        'pending_bookings' => Booking::where('status', 'pending')->count(),
        'completed_projects' => Booking::where('status', 'completed')->count(),
    ];
    
    return response()->json($stats);
}

public function getRecent()
{
    $recentBookings = Booking::latest()
            ->take(3)
            ->get();
            
        return response()->json($recentBookings);
    }
}
 