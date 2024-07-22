<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stats;
use App\Models\Medias;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Form;
use Validator;
use Auth;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role == 1) {
                return $next($request);
            }

            abort(403, 'Unauthorized');
        });
    }

    public function index(Request $request){
        // Retrieve the search query parameter from the request
        $query = $request->input('query');

        // Build the query for media items
        $mediasQuery = Medias::orderBy('id', 'desc');

        // If a search query is provided, filter the results
        if ($query) {
            $mediasQuery->where('url', 'like', '%' . $query . '%');
        }

        // Get paginated results
        $medias = $mediasQuery->paginate(6);

        // Get counts for media status
        $total = Medias::count();
        $play = Medias::where('status', 1)->count();
        $stop = Medias::where('status', 0)->count();

        // Return the view with the media list and counts
        return view('admin.pages.media.index')
            ->with('medias', $medias)
            ->with('activeLink', 'media')
            ->with('total', $total)
            ->with('stop', $stop)
            ->with('play', $play)
            ->with('query', $query);  // Pass the query parameter to the view
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.media.create')->with('activeLink', 'media');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'url' => 'required|url'
        ]);

        // Save data to the database
        $media = new Medias();
        $media->title = $request->input('title');
        $media->url = $request->input('url');
        $media->save();
        return redirect('/admin/media')->with('status','Media Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {

        return view('admin.pages.media.show')->with('products', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //echo "<pre>"; print_r($id); die;
        $media = Medias::find($id);
        return view('admin.pages.media.edit')->with('media', $media)->with('activeLink', 'media');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //echo "<pre>"; print_r($request->all()); die;
        $media = Medias::find($id);
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required|url'
        ]);

        $media->title = $request->input('title');
        $media->url = $request->input('url');
        $media->update();
        return redirect('/admin/media')->with('status','Media Updated Successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  Products $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {


        //delete image from local folder "/photo/"
        //Storage::delete($product->product_image);

        //delete product title, description, amount and image from MySQL
        $media = Medias::find($id);
        $media->delete();
        return redirect('/admin/media')->with('status', 'Media Deleted Successfully!');
    }

    public function changestatus(Request $request){
        $media = Medias::where('id',$request->id)->update(['status'=>$request->status]);
        return redirect()->back()->with('status', 'Status Changed Successfully');
    }

    public function groupaction(Request $request){
        Medias::query()->update(['status' => $request->status]);
        return redirect()->back()->with('status', 'Status Changed Successfully');
    }

    public function stats(Request $request, $id){
        $media = Medias::where('id',$request->id)->first();
        $stats = Stats::where('media', $id)->paginate(8);
        return view('admin.pages.media.stats')->with('stats', $stats)->with('media', $media)->with('activeLink', 'media');
    }
}
