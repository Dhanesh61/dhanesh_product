<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class RoomController extends Controller
{
    public function room(){
        return view('Hotel.roombook');
    }

    public function bookSlot(Request $request, $slot) {

        $request->validate([
            'date' => 'required|date|after_or_equal:today', 
        ]);
    
        if ($request->date < now()->toDateString()) {
            return redirect()->back()->with('error', 'You cannot book slots for past dates.');
        }
    
        $existingBooking = Hotel::where('date', $request->date)
                                ->where('slot', $slot)
                                ->first();
    
        if ($existingBooking) {
            return redirect()->back()->with('error', 'Slot already booked for this date.');
        }
    
        // Proceed with booking
        $user = auth()->user();
        
        $hotel = new Hotel();
        $hotel->user_id = $user->id;
        $hotel->slot = $slot;
        $hotel->date = $request->input('date');
        $hotel->save();
    
        return redirect()->back()->with('success', 'Slot booked successfully!');
    }

    public function adminroom(){
        $rooms = Hotel::all();
        return view('Hotel.adminroom',compact('rooms'));
    }

    public function roomorder()
    {
        $userorder = Hotel::where('user_id', auth()->id())->get();
        return view('Hotel.userorder', compact('userorder'));
    }

    public function getBookedSlots($date) {
        $bookedSlots = Hotel::where('date', $date)->pluck('slot')->toArray();
        return response()->json($bookedSlots);
    }

    public function cancelRoom(Request $request, $roomId) {
        $room = Hotel::findOrFail($roomId);
    
        if ($room->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to cancel this booking.');
        }
    
        $room->delete();
    
        return redirect()->route('userroom')->with('success', 'Booking canceled successfully!');
    }
}

