<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Services\TestFetcher;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $testFetcher;

    public function __construct(TestFetcher $testFetcher)
    {
        $this->testFetcher = $testFetcher;
    }

    // Fetch products from the Fake Store API and store them
    // public function fetchAndStore()
    // {
    //     $this->testFetcher->fetchTests('all');

    //     return response()->json(['message' => 'Tests fetched and stored successfully!']);
    // }

    // Display stored Tests
    // public function showTests()
    // {
    //     $tests = Test::all();

    //     return view('admin.test', compact('tests'));
    // }

    public function showTests()
    {
        // Fetch and store products from DummyJSON API if not already stored
        $this->testFetcher->fetchAndStoreTests();

        // Fetch products from the database
        $tests = Test::all();

        // Return a view with the products data
        return view('admin.test', compact('tests'));
    }
}

