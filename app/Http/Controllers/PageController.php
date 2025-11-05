<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function builder()
    {
        $pages = Page::select('id', 'name', 'slug')
                    ->where('teacher_id', auth()->id())
                    ->get();
        return view('teacher.cms.pageBuilder', compact('pages'));
    }

    public function store(Request $request)
    {
        $teacherId = auth()->id();
        
        $pageId = DB::table('pages')->insertGetId([
            'name' => $request->name,
            'slug' => $request->slug,
            'page_data' => $request->page_data,
            'teacher_id' => $teacherId,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $page = Page::find($pageId);

        return response()->json([
            'success' => true,
            'page' => $page,
            'teacher_id' => $teacherId
        ]);
    }

    public function show($id)
    {
        $page = Page::findOrFail($id);
        return response()->json(json_decode($page->page_data));
    }

    public function showBySlug($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        // Decode the JSON stored in page_data
        $data = json_decode($page->page_data, true);

        // Extract HTML & CSS from the data structure
        $html = $data['gjs-html'] ?? $data['html'] ?? '';
        $css = $data['gjs-css'] ?? $data['css'] ?? '';

        // Format CSS properly by adding line breaks and proper spacing
        $formattedCss = str_replace(['{', '}', ';'], [" {\n  ", "\n}\n", ";\n  "], $css);
        $formattedCss = preg_replace('/\s+/', ' ', $formattedCss);

        // Combine for rendering
        $renderedHtml = "<style>\n{$formattedCss}\n</style>\n" . $html;

        return view('teacher.cms.page', compact('renderedHtml'));
    }

    public function updateContent(Request $request, $id)
    {
        try {
            $page = Page::findOrFail($id);

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
        $pages = Page::select('id', 'name', 'slug')
                    ->where('teacher_id', auth()->id())
                    ->get();
        return response()->json($pages);
    }

    public function destroy($id)
    {
        try {
            Page::findOrFail($id)->delete();
            return response()->json(['success' => true, 'message' => 'Page deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting page'], 500);
        }
    }

    public function showWebsiteLinks()
    {
        $pages = Page::select('id', 'name', 'slug')->where('teacher_id',auth()->id())->get();
        return view('teacher.cms.websiteLinks', compact('pages'));
    }

    public function destroyPage($id)
    {
        Page::findOrFail($id)->delete();
        return redirect()->route('website.links.teacher')->with('success', 'Page deleted successfully.');
    }
}

