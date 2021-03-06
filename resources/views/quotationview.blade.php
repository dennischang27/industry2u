<table style="width:100%">
    <tr>
        @if($isLogoExist)
            <td style="width:20%">
                <img id="company_image" src="storage/{{$data->logo}}" width="120" height="120">
            </td>
            <td style="width:50%;vertical-align:top;">
                <div style="font-size: 25px;">{{$data->supplier_company_name}}</div>
                <div>(reg no: {{$data->supplier_reg_no}})</div>
            </td>
            <td style="width:30%;vertical-align:top;text-align: right;">
                <div>{{$data->supplier_street}}</div>
                <div>{{$data->supplier_postal_code}} {{$data->supplier_city}},</div>
                <div>{{$data->supplier_state_id}}, {{$data->supplier_country}}</div>
                <div>&nbsp;</div>
                <div>Tel: {{$data->supplier_phone}}</div>
            </td>
        @else
            <td style="width:50%;vertical-align:top;">
                <div style="font-size: 25px;">{{$data->supplier_company_name}}</div>
                <div>(reg no: {{$data->supplier_reg_no}})</div>
            </td>
            <td style="width:50%;vertical-align:top;text-align: right;">
                <div>{{$data->supplier_street}}</div>
                <div>{{$data->supplier_postal_code}} {{$data->supplier_city}},</div>
                <div>{{$data->supplier_state_id}}, {{$data->supplier_country}}</div>
                <div>&nbsp;</div>
                <div>Tel: {{$data->supplier_phone}}</div>
            </td>
        @endif
    </tr>
</table>
<hr>
<table style="width:100%;vertical-align:top;">
    <tr>
        <td style="width:60%;text-align: left;">
            To: {{$data->purchaser_company_name}}
        </td>
        <td style="text-align: right;font-size: 25px;vertical-align:top;">
            Quotation
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;padding-top:20px;">
            <b>Billing Address</b>
        </td>
        <td style="text-align: right;padding-top:20px;">
            No: {{$data->quotation_no}}
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;">
            {{$data->purchaser_street}}, {{$data->purchaser_postal_code}} {{$data->purchaser_city}}, {{$data->purchaser_state_id}}, {{$data->purchaser_country}}
        </td>
        <td style="text-align: right;vertical-align:top;">
            Date: {{date('d/m/Y', strtotime($data->updated_at))}}
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;">
            &nbsp;
        </td>
        <td style="text-align: right;vertical-align:top;"> 
            Ref No: {{$data->qr_no}}
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;">
            ATTN: {{$data->first_name}} {{$data->last_name}}
        </td>
        <td style="text-align: right;vertical-align:top;">
            Valid Until: {{date('d/m/Y', strtotime($data->quotation_valid_until))}}
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;">
            Tel: {{$data->purchaser_phone}}
        </td>
        <td style="text-align: right;vertical-align:top;">
            Term: {{$data->payment_term_code}}
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;">
            Email: {{$data->user_email}} 
        </td>
        <td style="text-align: right;vertical-align:top;">
            Prepared By: {{$supplier_user_name}}
        </td>
    </tr>
</table>
<hr>
<table style="width:100%;">
    <tr>
        <td style="width:60%;text-align: left;">
            <b>DESCRIPTION</b>
        </td>
        <td style="width:10%;">
            <b>QTY</b>
        </td>
        <td style="width:10%;">
            <b>UOM</b>
        </td>
        @hasanyrole('Engineer|Clerical Staff')
        @else
        <td style="width:10%;">
            <b>Price</b>
        </td>
        <td style="width:10%;">
            <b>Total</b>
        </td>
        @endhasanyrole
    </tr>
</table>
<hr>
<table style="width:100%;">
    @foreach ($products as $product)    
        <tr>
            <td style="width:60%;text-align: left;padding-bottom:10px;">
                <div>{{ ++$i }}. {{$product->product_name}}</div>
                <div><span style="padding-left:16px;">series no: {{$product->series_no}}</span></div>
                <div><span style="padding-left:16px;">category : {{$product->category_name}}</span></div>
            </td>
            <td style="width:10%;vertical-align:top;padding-bottom:10px;">
                {{$product->quantity}}
            </td>
            <td style="width:10%;vertical-align:top;padding-bottom:10px;">
                PCS
            </td>
            @hasanyrole('Engineer|Clerical Staff')
            @else
            <td style="width:10%;vertical-align:top;padding-bottom:10px;">
                @php
                    $total_discount_amount = $product->price * ($product->total_discount/100);
                    $product_price_after_discount = round($product->price - $total_discount_amount,2);
                @endphp
                {{number_format($product_price_after_discount, 2, '.', ',')}}
            </td>
            <td style="width:10%;vertical-align:top;padding-bottom:10px;">
                {{number_format($product->total_amount, 2, '.', ',')}}
            </td>
            @endhasanyrole
        </tr>
    @endforeach
</table>
<hr>
@hasanyrole('Engineer|Clerical Staff')
@else
<table style="width:100%;">
    <tr>
        <td style="width:60%;text-align: left;padding-bottom:10px;"></td>
        <td style="width:10%;vertical-align:top;padding-bottom:10px;"></td>
        <td style="width:10%;vertical-align:top;padding-bottom:10px;text-align: right;padding-right:25px;">Total</td>
        <td style="width:10%;vertical-align:top;padding-bottom:10px;text-align: right;padding-right:30px;">{{number_format($final_amount, 2, '.', ',')}}</td>
    </tr>
</table>
@endhasanyrole
<table style="width:100%;margin-top:50px;">
    <tr>
        <td style="width:30%;text-align: left;">{{ $data->supplier_company_name }}</td>
        <td style="width:70%;text-align: left;"></td>
    </tr>
    <tr>
        <td style="width:30%;text-align: left;"><hr></td>
        <td style="width:70%;text-align: left;"></td>
    </tr>
    <tr>
        <td style="width:30%;text-align: left;">Computer generated document, no signature is required</td>
        <td style="width:70%;text-align: left;"></td>
    </tr>
</table>