<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use App\Facades\Shortcode;


class PageController extends Controller
{
    protected $teacherId;

    public function __construct()
    {
        $this->teacherId = null;
    }

    private function getTeacherId()
    {
        return $this->teacherId ?: (auth()->check() ? auth()->user()->id : null);
    }
    public function builder()
    {
        $teacher_id = $this->getTeacherId();

        // Set teacher_id in session for the Laravel-Grapes package to use
        session(['teacher_id' => $teacher_id]);

        $pages = Page::where('teacher_id', $teacher_id)->select('id', 'name', 'slug')->get();
        return view('teacher.cms.pageBuilder', compact('pages','teacher_id'));
    }

    public function store(Request $request)
    {
        $pageData = $request->all();

        // Use the authenticated teacher's ID
        $pageData['teacher_id'] = auth()->user()->id;

        $page = Page::create($pageData);

        return response()->json([
            'success' => true,
            'page' => $page
        ]);
    }

    public function show($id)
    {
        $page = Page::where('teacher_id', $this->getTeacherId())->findOrFail($id);

        $pageData = json_decode($page->page_data, true);

        // Handle nested structure - check if page_data exists within the data
        if (isset($pageData['page_data'])) {
            return response()->json($pageData['page_data']);
        }

        return response()->json($pageData);
    }
public function showBySlug($slug)
{
    $page = Page::where('slug', $slug)->firstOrFail();

    // Decode the JSON stored in page_data
    $data = json_decode($page->page_data, true);

    // Handle nested structure - check if page_data exists
    if (isset($data['page_data'])) {
        $pageData = $data['page_data'];
    } else {
        $pageData = $data;
    }

    // Extract HTML & CSS from the data structure
    $html = $pageData['gjs-html'] ?? $pageData['html'] ?? '';
    $css = $pageData['gjs-css'] ?? $pageData['css'] ?? '';

    // Decode HTML entities before processing shortcodes
    $decodedHtml = html_entity_decode($html, ENT_QUOTES, 'UTF-8');

    // Process shortcodes
    $processedHtml = app('shortcode')->process($decodedHtml);

    $renderedHtml = "<style>\n{$css}\n</style>\n" . $processedHtml;

    return view('teacher.cms.page', compact('renderedHtml'));
}


    public function updateContent(Request $request, $id)
    {
        try {
            $page = Page::where('teacher_id', $this->getTeacherId())->findOrFail($id);

            // The library sends the data in a specific format
            $pageData = $request->all();

            $page->update(['page_data' => json_encode($pageData)]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Update page content error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function allPages()
    {
        $pages = Page::where('teacher_id', $this->getTeacherId())->select('id', 'name', 'slug')->get();


        return response()->json($pages);
    }

    public function destroy($id)
    {
        try {
            Page::where('teacher_id', $this->getTeacherId())->findOrFail($id)->delete();
            return response()->json(['success' => true, 'message' => 'Page deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting page'], 500);
        }
    }

    public function showWebsiteLinks()
    {
        $pages = Page::where('teacher_id', $this->getTeacherId())->select('id', 'name', 'slug')->get();
        return view('teacher.cms.websiteLinks', compact('pages'));
    }

    public function destroyPage($id)
    {
        Page::where('teacher_id', $this->getTeacherId())->findOrFail($id)->delete();
        return redirect()->route('website.links.teacher')->with('success', 'Page deleted successfully.');
    }
}

