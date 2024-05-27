<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;

class WebsiteController extends Controller
{
    public function website()
    {
        $websites = Website::all();
        return view('websitedetails.website', compact('websites'));
    }

    public function editWebsite($id)
    {
        $website = Website::findOrFail($id);
        return view('websitedetails.editWebsite', compact('website'));
    }

    public function updateWebsite(Request $request, $id)
    {
        $website = Website::findOrFail($id);

        // Update the website record
        $website->update([
            'websiteurl' => $request->websiteurl,
            'da' => $request->da,
            'category' => $request->filled('category') ? implode(',', $request->category) : '',
            'fcCategory' => $request->filled('fcCategory') ? implode(',', $request->fcCategory) : '',
            'categoryPrice' => $request->filled('category') ? $request->categoryPrice : 0,
            'fcCategoryprice' => $request->filled('fcCategory') ? $request->fcCategoryprice : 0,
        ]);

        return redirect()->route('website')->with('success', 'Website updated successfully');
    }

    public function deleteWebsite($id)
    {
        $website = Website::findOrFail($id);
        $website->delete();
        return back()->with('success', 'Website deleted successfully');
    }

    public function createWebsite()
    {
        return view('websitedetails.createWebsite');
    }

    public function storeWebsite(Request $request)
    {
        // Define validation rules for server-side validation
        $rules = [
            'websiteurl' => 'required|string|url',
            'da' => 'required|integer|min:1|max:100',
        ];

        // Check if either Category or FC Category is selected
        if ($request->filled('category') || $request->filled('fcCategory')) {
            // If either Category or FC Category is selected, skip validation for the other
            $rules['category'] = 'nullable|array';
            $rules['category.*'] = 'nullable';
            $rules['categoryPrice'] = 'nullable|required_with:category|numeric';
            $rules['fcCategory'] = 'nullable|array';
            $rules['fcCategory.*'] = 'nullable';
            $rules['fcCategoryprice'] = 'nullable|required_with:fcCategory|numeric';
        } else {
            // If neither Category nor FC Category is selected, both are required
            $rules['category'] = 'required|array';
            $rules['category.*'] = 'required';
            $rules['categoryPrice'] = 'required|numeric';
            $rules['fcCategory'] = 'required|array';
            $rules['fcCategory.*'] = 'required';
            $rules['fcCategoryprice'] = 'required|numeric';
        }

        // Validate the request data
        $request->validate($rules, [
            'websiteurl.required' => 'Website URL is required.',
            'websiteurl.url' => 'Website URL must be a valid URL.',
            'da.required' => 'DA is required.',
            'da.min' => 'DA must be at least 1.',
            'da.max' => 'DA must not be more than 100.',
            'category.required' => 'Category is required.',
            'category.*.required' => 'Each selected category must have a value.',
            'categoryPrice.required' => 'Category Price is required.',
            'fcCategory.required' => 'FC Category is required.',
            'fcCategory.*.required' => 'Each selected FC category must have a value.',
            'fcCategoryprice.required' => 'FC Category Price is required.',
        ]);

        // Convert the arrays into strings to store in the database
        $category = $request->filled('category') ? implode(',', $request->category) : '';
        $fcCategory = $request->filled('fcCategory') ? implode(',', $request->fcCategory) : '';

        $categoryPrice = $request->filled('category') ? $request->categoryPrice : 0;
        $fcCategoryprice = $request->filled('fcCategory') ? $request->fcCategoryprice : 0;

        // Create the new website record
        Website::create([
            'websiteurl' => $request->websiteurl,
            'da' => $request->da,
            'category' => $category,
            'fcCategory' => $fcCategory,
            'categoryPrice' => $categoryPrice,
            'fcCategoryprice' => $fcCategoryprice,
        ]);

        return redirect()->route('website')->with('success', 'Website created successfully');
    }
}