<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Path\To\DOMDocument;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ServiceController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:service-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:service-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(auth()->user()->hasRole('Admin'));
        return view('services.index', [
            'title' => 'Services',
            'subtitle' => 'All',
            // 'services' => Service::all()
            'services' => Service::latest()->when(!auth()->user()->hasRole('Admin'), function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create', [
            'title' => 'Service',
            'subtitle' => 'Create',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ddd($request);
        $validate = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:services',
            'category_id' => 'required',
            'cover' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        // $storage = "storage/services-img";
        // $dom = new \DOMDocument();
        // libxml_use_internal_errors(true);
        // $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        // libxml_clear_errors();
        // $images = $dom->getElementsByTagName('img');
        // foreach ($images as $img) {
        //     $src = $img->getAttribute('src');
        //     if (preg_match('/data:image/', $src)) {
        //         preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
        //         $mimetype = $groups['mime'];
        //         $FileNameContent = uniqid();
        //         $FileNameContentRand = substr(md5($FileNameContent), 6, 6) . '_' . time();
        //         $filepath = ("$storage/$FileNameContentRand.$mimetype");
        //         $image = Image::make($src)
        //             ->resize(1200, 1200)
        //             ->encode($mimetype, 100)
        //             ->save(public_path($filepath));
        //         $new_src = asset($filepath);
        //         $img->removeAttribute('src');
        //         $img->setAttribute('src', $new_src);
        //         $img->setAttribute('class', 'img-responsive');
        //     }
        // }
        // $validate['body'] = $dom->saveHTML();

        if ($request->file('cover')) {
            $validate['cover'] = $request->file('cover')->store('services-img');
        }

        $validate['user_id'] = auth()->user()->id;
        $validate['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Service::create($validate);
        return redirect('/services')->with('success', 'Service has been added!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('services.show', [
            'title' => 'Service',
            'subtitle' => 'Show',
            'service' => $service
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('services.edit', [
            'title' => 'Service',
            'subtitle' => 'Edit',
            'service' => $service,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'body' => 'required',
        ];


        if ($request->slug != $service->slug) {
            $rules['slug'] = 'required|unique:services';
        }

        // $storage = "storage/services-img";
        // $dom = new \DOMDocument();
        // libxml_use_internal_errors(true);
        // $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        // libxml_clear_errors();
        // $images = $dom->getElementsByTagName('img');
        // foreach ($images as $img) {
        //     $src = $img->getAttribute('src');
        //     if (preg_match('/data:image/', $src)) {
        //         preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
        //         $mimetype = $groups['mime'];
        //         $FileNameContent = uniqid();
        //         $FileNameContentRand = substr(md5($FileNameContent), 6, 6) . '_' . time();
        //         $filepath = ("$storage/$FileNameContentRand.$mimetype");
        //         $image = Image::make($src)
        //             ->resize(1200, 1200)
        //             ->encode($mimetype, 100)
        //             ->save(public_path($filepath));
        //         $new_src = asset($filepath);
        //         $img->removeAttribute('src');
        //         $img->setAttribute('src', $new_src);
        //         $img->setAttribute('class', 'img-responsive');
        //     }
        // }

        $validate = $request->validate($rules);

        if ($request->file('cover')) {
            if ($request->oldCover) {
                Storage::delete($request->oldCover);
            }
            $validate['cover'] = $request->file('cover')->store('services-img');
        }
        // $validate['body'] = $dom->saveHTML();
        $validate['user_id'] = auth()->user()->id;
        $validate['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Service::where('id', $service->id)->update($validate);
        return redirect('/services')->with('success', 'Service has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if ($service->cover) {
            Storage::delete($service->cover);
        }
        Service::destroy($service->id);
        return redirect('/services')->with('success', 'Service has been deleted');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Service::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
