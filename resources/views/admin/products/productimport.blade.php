@extends('admin.layouts.app')
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Import Products</h1>
    <!-- End Page Heading -->
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="{{ route("seller.products.template.download") }}" class="btn btn-md btn-primary"> Download Example For xls/csv File</a>
        </div>

    </div>
    <div class="card  mb-4">
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><strong>Choose your xls/csv File:</strong></label>

                    </div>
                    <form action="{{route('seller.products.template.upload')}}" method="POST" enctype="multipart/form-data">
                        @csrf
            <div class="form-group row">
                <div class="col-4">
                    <input class="form-control " id="uploaded_file" accept=".xls, .xlsx" type="file" value="{{@old('uploaded_file')}}" name="uploaded_file" required="" autofocus="">
                </div>
                <div class="col-4">
                    <input class="btn btn-primary" type="submit" value="Upload">
                </div>
            </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card card-danger">
        <div class=" card-header with-border">
            <div class="card-title">Instructions</div>
        </div>
        <div class=" card-body">
            <p><b>Follow the instructions carefully before importing the file.</b></p>
            <p>The columns of the file should be in the following order.</p>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Column No</th>
                    <th>Column Name</th>
                    <th>Description</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>1</td>
                    <td><b>Category</b> (Required)</td>
                    <td>Name of category</td>
                </tr>

                <tr>
                    <td>2</td>
                    <td><b>Subcategory</b> (Required)</td>
                    <td>Name of subcategory</td>
                </tr>

                <tr>
                    <td>3</td>
                    <td><b>Product Name</b> (Required)</td>
                    <td>Name of your product</td>
                </tr>

                <tr>
                    <td>4</td>
                    <td><b>Series No</b> (Required)</td>
                    <td>Series No of your product</td>
                </tr>

                <tr>
                    <td>5</td>
                    <td><b>Product Description</b> (Required)</td>
                    <td>Detail of your product</td>
                </tr>

                <tr>
                    <td>6</td>
                    <td><b>Product Brands</b> (Required)</td>
                    <td>Name of your brand</td>
                </tr>

                <tr>
                    <td>7</td>
                    <td><b>Price</b> (Required)</td>
                    <td>Your Product price [<b>Note:</b> Price must entered in this format eg. 50000 (No comma and character).<br>
                        The list price is for supplier internal reference and only used in generating quotations and invoices]</td>
                </tr>

                <tr>
                    <td>8</td>
                    <td><b>Product Image Name</b> (Optional)</td>
                    <td>Name for the product image, you can still doign single upload later.</td>
                </tr>

                <tr>
                    <td>9</td>
                    <td><b>Specification</b> (Optional)</td>
                    <td>PDF file name for specification, page from and page to</td>
                </tr>

                <tr>
                    <td>10</td>
                    <td><b>Dimension</b> (Optional)</td>
                    <td>PDF file name for Dimension,  page from and page to</td>
                </tr>

                <tr>
                    <td>11</td>
                    <td><b>Attribute</b> (Recommended)</td>
                    <td>Your Product Attributes  <br/>[<b>Note:</b> Attributes per category is recommended to fill up for better filter and product features.).]</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
