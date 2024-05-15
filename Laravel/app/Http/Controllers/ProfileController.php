<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $apiUrl = 'http://localhost:9005/api/profile';

    public function getAllProfiles()
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang login
        $response = Http::get("{$this->apiUrl}/?user_id={$userId}");
        $profiles = $response->json();

        // Check if the response has the expected structure
        if (!is_array($profiles)) {
            return response()->json(['error' => 'Invalid response from API'], 500);
        }

        return view('Customer.profil.profiles', compact('profiles'));
    }

    public function getProfileById($id)
    {
        $response = Http::get("{$this->apiUrl}/{$id}");
        $profile = $response->json();

        // Check if the response has the expected structure
        if (!isset($profile['id'])) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        return view('profile', compact('profile'));
    }

    public function createProfile(Request $request)
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang login
        $requestData = $request->all();
        $requestData['user_id'] = $userId;
        $response = Http::post("{$this->apiUrl}/", $requestData);
        return redirect()->route('profiles.index');
    }

    public function updateProfile(Request $request, $id)
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang login
        $response = Http::put("{$this->apiUrl}/{$id}", $request->all());
        return redirect()->route('profiles.index');
    }

    public function deleteProfile($id)
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang login
        $response = Http::delete("{$this->apiUrl}/{$id}");
        return redirect()->route('profiles.index');
    }
}
