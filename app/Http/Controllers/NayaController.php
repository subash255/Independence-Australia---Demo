<?php

namespace App\Http\Controllers;

use App\Services\NayaService;
use Illuminate\Http\Request;

class NayaController extends Controller
{
    protected $productService;

    public function __construct(NayaService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display the list of products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch products using the service
        $products = $this->productService->fetchProducts();

        return view('naya', compact('products'));
    }
}
