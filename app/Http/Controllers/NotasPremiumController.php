<?php

namespace App\Http\Controllers;

use App\Models\NotasPremium;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\NotasPremiumRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class NotasPremiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $notasPremium = NotasPremium::paginate(10);
        return view('notas-premium.index', compact('notasPremium'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $notasPremium = new NotasPremium();

        return view('notas-premium.create', compact('notasPremium'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotasPremiumRequest $request): RedirectResponse
    {
        NotasPremium::create($request->validated());

        return Redirect::route('notas-premium.index')
            ->with('success', 'NotasPremium created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request): View
    {
        $searchTerm = $request->input('search');
        $notasPremium = NotasPremium::find($id);
    
        return view('notas-premium.show', compact('notasPremium', 'searchTerm'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $notasPremium = NotasPremium::find($id);

        return view('notas-premium.edit', compact('notasPremium'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotasPremiumRequest $request, NotasPremium $notasPremium): RedirectResponse
    {
        $notasPremium->update($request->validated());

        return Redirect::route('notas-premium.index')
            ->with('success', 'NotasPremium updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        NotasPremium::find($id)->delete();

        return Redirect::route('notas-premium.index')
            ->with('success', 'NotasPremium deleted successfully');
    }
}
