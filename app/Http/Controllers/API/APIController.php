<?php

namespace App\Http\Controllers\API;

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

class APIController extends Controller
{
    public function getMediaData()
    {
        // Fetch only id and url from the Medias model where status is 1
        $mediaData = Medias::select('id', 'url','hour','minute','second')->where('status', 1)->get();
        
        // Prepare the response data
        $response = [
            'message' => 'Request successful',
            'media_list' => $mediaData,
            'total_count' => $mediaData->count()
        ];

        // Return the data as JSON
        return response()->json($response);
    }

    public function updatestats(Request $request){
        $media = Medias::find($request->id);
        if ($media) {
            $media->status = 0;
            $media->save();
        }

        Stats::insert(['media' => $request->id,'ip'=> $request->ip]);

        // Prepare the response data
        $response = [
            'message' => 'stats insertted successful'
        ];

        // Return the data as JSON
        return response()->json($response);
    }
}
