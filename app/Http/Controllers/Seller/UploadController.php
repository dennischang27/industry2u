<?php

namespace App\Http\Controllers\Seller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;

class UploadController extends Controller
{

    function __construct()
    {

    }


    public function uploadfile()
    {

        $user = Auth::user();
        $files = Storage::files("public/companies/".$user->company->id."/products/");
        $i=1;
        // return view('seller.products.upload',compact('files', 'i'));
        return view('user.sales.products.uploadproducts',compact('files', 'i'));

    }

    public function uploadfileprocess(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(storage_path("app/public/companies/".$user->company->id."/products/"),$fileName);

        return response()->json(['success'=>$fileName]);
    }
    public function deletefile(Request $request)
    {
        $user = Auth::user();
        $image_path = storage_path("app/public/companies/".$user->company->id."/products/".$request->file_name);
        if (File::exists($image_path)) {
            //File::delete($image_path);
            unlink($image_path);
        }
        return redirect()->route('seller.products.uploadfile')
            ->with('success','Files deleted successfully');
    }
}
