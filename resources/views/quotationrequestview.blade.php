<table style="width:100%">
    <tr>
        @if($isLogoExist)
            <td style="width:20%">
                <img id="company_image" src="storage/{{$data->logo}}" width="120" height="120">
            </td>
            <td style="width:50%;vertical-align:top;">
                <div style="font-size: 25px;">{{$data->purchaser_company_name}}</div>
                <div>(reg no: {{$data->purchaser_reg_no}})</div>
            </td>
            <td style="width:30%;vertical-align:top;text-align: right;">
                <div>{{$data->purchaser_street}}</div>
                <div>{{$data->purchaser_postal_code}} {{$data->purchaser_city}},</div>
                <div>{{$data->purchaser_state_id}}, {{$data->purchaser_country}}</div>
                <div>&nbsp;</div>
                <div>Tel: {{$data->purchaser_phone}}</div>
            </td>
        @else
            <td style="width:50%;vertical-align:top;">
                <div style="font-size: 25px;">{{$data->purchaser_company_name}}</div>
                <div>(reg no: {{$data->purchaser_reg_no}})</div>
            </td>
            <td style="width:50%;vertical-align:top;text-align: right;">
                <div>{{$data->purchaser_street}}</div>
                <div>{{$data->purchaser_postal_code}} {{$data->purchaser_city}},</div>
                <div>{{$data->purchaser_state_id}}, {{$data->purchaser_country}}</div>
                <div>&nbsp;</div>
                <div>Tel: {{$data->purchaser_phone}}</div>
            </td>
        @endif
    </tr>
</table>
<hr>
<table style="width:100%;vertical-align:top;">
    <tr>
        <td style="width:60%;text-align: left;">
            To: {{$data->supplier_company_name}}
        </td>
        <td style="text-align: right;font-size: 25px;vertical-align:top;">
            Quotation Request
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;padding-top:20px;">
            <b>Billing Address</b>
        </td>
        <td style="text-align: right;padding-top:20px;">
            No: {{$data->qr_no}}
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;">
            {{$data->supplier_street}}, {{$data->supplier_postal_code}} {{$data->supplier_city}}, {{$data->supplier_state_id}}, {{$data->supplier_country}}
        </td>
        <td style="text-align: right;vertical-align:top;">
            Date: {{date('d/m/Y', strtotime($data->created_at))}}
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;">
            &nbsp;
        </td>
        <td style="text-align: right;vertical-align:top;">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;">
            ATTN: {{$data->first_name}} {{$data->last_name}}
        </td>
        <td style="text-align: right;vertical-align:top;">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;">
            Tel: {{$data->user_phone}}
        </td>
        <td style="text-align: right;vertical-align:top;">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td style="width:60%;text-align: left;">
            Email: {{$data->user_email}}
        </td>
        <td style="text-align: right;vertical-align:top;">
            &nbsp;
        </td>
    </tr>
</table>
<hr>
<table style="width:100%;">
    <tr>
        <td style="width:80%;text-align: left;">
            <b>DESCRIPTION</b>
        </td>
        <td style="width:10%;">
            <b>QTY</b>
        </td>
        <td style="width:10%;">
            <b>UOM</b>
        </td>
    </tr>
</table>
<hr>
<table style="width:100%;">
    @foreach ($products as $product)    
        <tr>
            <td style="width:80%;text-align: left;padding-bottom:10px;">
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
        </tr>
    @endforeach
</table>