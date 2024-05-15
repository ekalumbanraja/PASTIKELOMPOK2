<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AboutUsController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:9007', // Tambahkan URL base microservice Golang di .env
            'timeout'  => 2.0,
        ]);
    }

    public function index()
    {
        try {
            $response = $this->client->request('GET', '/aboutus');
            $aboutus = json_decode($response->getBody(), true);
            return view('aboutus.index', compact('aboutus'));
        } catch (RequestException $e) {
            return view('aboutus.index', ['aboutus' => []]);
        }
    }

    public function create()
    {
        return view('aboutus.create');
    }

    public function store(Request $request)
    {
        try {
            $response = $this->client->request('POST', '/aboutus', [
                'json' => $request->all()
            ]);
            return redirect()->route('aboutus.index')->with('success', 'About Us entry created successfully.');
        } catch (RequestException $e) {
            return back()->withErrors('Failed to create aboutus entry');
        }
    }

    public function show($id)
    {
        try {
            $response = $this->client->request('GET', "/aboutus/{$id}");
            $aboutus = json_decode($response->getBody(), true);
            return view('aboutus.show', compact('aboutus'));
        } catch (RequestException $e) {
            return redirect()->route('aboutus.index')->withErrors('AboutUs entry not found');
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->client->request('GET', "/aboutus/{$id}");
            $aboutus = json_decode($response->getBody(), true);
            return view('aboutus.edit', compact('aboutus'));
        } catch (RequestException $e) {
            return redirect()->route('aboutus.index')->withErrors('AboutUs entry not found');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $response = $this->client->request('PUT', "/aboutus/{$id}", [
                'json' => $request->all()
            ]);
            return redirect()->route('aboutus.index')->with('success', 'About Us entry updated successfully.');
        } catch (RequestException $e) {
            return back()->withErrors('Failed to update aboutus entry');
        }
    }

    public function destroy($id)
    {
        try {
            $this->client->request('DELETE', "/aboutus/{$id}");
            return redirect()->route('aboutus.index')->with('success', 'About Us entry deleted successfully.');
        } catch (RequestException $e) {
            return redirect()->route('aboutus.index')->withErrors('Failed to delete aboutus entry');
        }
    }
}
