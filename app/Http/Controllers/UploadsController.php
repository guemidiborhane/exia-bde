<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Photo;
use App\Event;

class UploadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);
        $fileName = pathinfo($request->file->getClientOriginalName(),PATHINFO_FILENAME).'.'.time().'.'.$request->file->getClientOriginalExtension();

        $request->file('file')->storeAs(
            'photos', $fileName, 'public'
        );

        $photo = new Photo;
        $photo->filename = $fileName;
        $photo->event()->associate($event->id);
        $photo->user()->associate(\Auth::user()->id);
        $photo->save();

        return response()->json([
            'id' => $photo->id
        ]);
    }

    public function destroy(Request $request)
    {
        $fileName = $request->input('filename');
        Photo::where('filename', $fileName)->first()->delete();
        Storage::delete('photos/'.$fileName);
        return '';
    }

    public function create(Request $request, Event $event)
    {
        if ($event->status === null) {
            return view('uploads.create', compact('event'));
        } else {
            return redirect()->route('home');
        }
    }
}
