<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ApiKeyController extends Controller
{
  public function index()
  {
    $apiKeys = Auth::user()->apiKeys()->latest()->get();
    return Inertia::render('ApiKeys/Index', [
      'apiKeys' => $apiKeys
    ]);
  }

  public function create()
  {
    return Inertia::render('ApiKeys/Create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
    ]);

    Auth::user()->apiKeys()->create([
      'name' => $request->name,
    ]);

    return redirect()->route('api-keys.index')->with('success', 'API Key created successfully.');
  }

  public function edit(ApiKey $apiKey)
  {
    if ($apiKey->user_id !== Auth::id()) {
      abort(403);
    }
    return Inertia::render('ApiKeys/Edit', [
      'apiKey' => $apiKey
    ]);
  }

  public function update(Request $request, ApiKey $apiKey)
  {
    if ($apiKey->user_id !== Auth::id()) {
      abort(403);
    }

    $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $apiKey->update([
      'name' => $request->name,
    ]);

    return redirect()->route('api-keys.index')->with('success', 'API Key updated successfully.');
  }

  public function destroy(ApiKey $apiKey)
  {
    if ($apiKey->user_id !== Auth::id()) {
      abort(403);
    }

    $apiKey->delete();

    return redirect()->route('api-keys.index')->with('success', 'API Key deleted successfully.');
  }
}
