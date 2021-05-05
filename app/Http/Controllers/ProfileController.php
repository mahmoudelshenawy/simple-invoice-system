<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function getProfileOfUser($userId)
    {
        $profile = Profile::where('user_id', $userId)->first();
        if (empty($profile)) {
            return redirect("/profile/$userId/create");
        }
        return view('profile.index', compact('profile'));
    }
    public function createProfile($userId)
    {
        $user = User::findOrFail($userId);
        return view('profile.create', compact('user'));
    }
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attrs = $request->only(['address', 'language', 'phone_1', 'phone_2', 'tin']);
        $attrs['name'] = $request->first_name . $request->last_name;
        $attrs['user_id'] = auth()->user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $user = auth()->user();
            $attrs['image'] = $file_name;
            // save the image
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path('Images/' . $user->name), $imageName);
        }
        Profile::create($attrs);
        session()->flash('Add', 'تم انشاء الصفحة الشخصية');
        return back();
    }
    public function show(Profile $profile)
    {
        // return view('profile.index', compact('profile'));
    }

    public function edit(Profile $profile)
    {
        //
    }

    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
