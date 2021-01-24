<?php

namespace App\Http\Controllers\Seller;


use Request;
use Exception;
use App\Imports\ProductImport;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelConstant;
use App\Models\Attribute;
use App\Models\Product;
use Auth;
use Image;
use Validator;
use Storage;

class ProductUploadController extends Controller
{
    private $fileName = "product_listing_template.xlsx";

    public function downloadOriginalTemplate() {
        try{
            $user = parent::getUser();

            $exporter = new ProductExport(Attribute::all(), Product::query());

            Excel::store($exporter, $user->company->id . "/" . $this->fileName);
            $excel = Excel::download($exporter, $this->fileName);

            return $excel;
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function downloadTemplate() {
        try{
            $user = parent::getUser();

            $exporter = new ProductExport(Attribute::all());

            Excel::store($exporter, "public/companies/".$user->company->id . "/" . $this->fileName);
            $excel = Excel::download($exporter, $this->fileName);

            return $excel;
        }catch(Exception $ex){
            throw $ex;
        }
    }

    private function validateUploadTemplate($data) {
        $rules = [
            'uploaded_file' => [
                'file', 'required', 'max:4096'
            ]
        ];

        $validator = Validator::make($data, $rules);

        return $validator;
    }

    public function uploadTemplate() {
        try{
            $validator = $this->validateUploadTemplate(Request::all());

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $user = parent::getUser();

            $uploadedFile = Request::file('uploaded_file');

            if($uploadedFile) {
                $mime = $uploadedFile->getClientMimeType();
                if(!in_array($mime, parent::EXCEL_TYPE)) {
                    throw new Exception("File type is " . $mime . ", only allow " . join("," ,parent::EXCEL_TYPE) . ".");
                }

                set_time_limit(0);

               $uploadedFile->storeAs('companies/' . $user->company->id, time().'upload_file_template.' . $uploadedFile->getClientOriginalExtension(), 'public');

                $importer = new ProductImport($user, false, false);

                Excel::import($importer, $uploadedFile, null, ExcelConstant::XLSX);
                return back()->with(['product_process' => $importer]);
            } else {
                throw new Exception('File not found');
            }
        } catch(Exception $ex) {
            return back()->withErrors(['uploaded_file' => $ex->getMessage()]);
        }
    }

}