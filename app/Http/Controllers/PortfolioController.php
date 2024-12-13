<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()
            ->select('id', 'title', 'media_url', 'type', 'is_featured')
            ->paginate(50);
        
        return response()->json($portfolios);
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'media_url' => 'required|string|max:255',
            'type' => 'required|in:photo,video',
            'is_featured' => 'boolean'
        ]);

        $portfolio = Portfolio::create($validated);
        return response()->json($portfolio, 201);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error creating portfolio',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function show($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return response()->json($portfolio);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'media_url' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|in:photo,video',
            'is_featured' => 'boolean'
        ]);

        $portfolio = Portfolio::findOrFail($id);
        $portfolio->update($validated);
        return response()->json($portfolio);
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->delete();
        return response()->json(null, 204);
    }
}
