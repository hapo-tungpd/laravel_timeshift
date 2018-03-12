<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function updateImage(Request $request, $id)
    {
        if (!$request->hasFile('img')) {
            return redirect()->route('admin.user.show', [
                'id' => $id,
            ]);
        }
        $imgLink = $request->file('img')->store('public/images');
        $imgLink = substr($imgLink, 7);
        $data["image"] = $imgLink;
        User::find($id)->update($data);
        return redirect()->route('admin.user.show', [
            'id' => $id,
        ]);
    }
}
