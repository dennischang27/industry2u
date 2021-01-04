<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="robots" content="all">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <meta name="theme-color" content="#157ED2">
  <title>{{ config('app.name', 'Industry2u') .  __(' Upgrade to seller') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/css/style.css') }}">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <style>

        /*basic reset*/
        * {
            margin: 0;
            padding: 0;
        }
        html {
            height: 100%;
            background: #157ed2;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to left, #6441A5, #2a0845);
            /* Chrome 10-25, Safari 5.1-6 */
        }

        body {
            background: transparent;
        }

        /*form styles*/
        #sellerform {
            position: relative;
            margin-top: 30px;
        }

        .error {
            color: red;
        }

        #sellerform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0px;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
            padding: 20px 30px;
            box-sizing: border-box;
            width: 80%;
            margin: 0 10%;

            /*stacking fieldsets above each other*/
            position: relative;
        }

        /*Hide all except first fieldset*/
        #sellerform fieldset:not(:first-of-type) {
            display: none;
        }

        /*inputs*/
        #sellerform input[type="text"],
        input[type="email"],
        #sellerform textarea {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 13px;
        }

        #sellerform input:focus,
        #sellerform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #fdd922;
            outline-width: 0;
            transition: All 0.5s ease-in;
            -webkit-transition: All 0.5s ease-in;
            -moz-transition: All 0.5s ease-in;
            -o-transition: All 0.5s ease-in;
        }

        /*buttons*/
        #sellerform .action-button {
            width: 100px;
            background: #fdd922;
            font-weight: bold;
            color: #111;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #sellerform .action-button:hover,
        #sellerform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #fdd922;
        }

        #sellerform .action-button-previous {
            width: 100px;
            background: #C5C5F1;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #sellerform .action-button-previous:hover,
        #sellerform .action-button-previous:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #C5C5F1;
        }

        /*headings*/
        .fs-title {
            font-size: 18px;
            text-transform: uppercase;
            color: #2C3E50;
            margin-bottom: 10px;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .fs-subtitle {
            font-weight: normal;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }

        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
        }

        #progressbar li {
            list-style-type: none;
            color: white;
            text-transform: uppercase;
            font-size: 9px;
            width: 50%;
            float: left;
            position: relative;
            letter-spacing: 1px;
            text-align: center;
        }

        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 24px;
            height: 24px;
            line-height: 26px;
            display: block;
            font-size: 12px;
            color: #333;
            background: white;
            border-radius: 25px;
            margin: 0 auto 10px auto;
        }

        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: white;
            position: absolute;
            left: -50%;
            top: 9px;
            z-index: -1;
            /*put it behind the numbers*/
        }

        #progressbar li:first-child:after {
            /*connector not needed before the first step*/
            content: none;
        }

        /*marking active/completed steps green*/
        /*The number of the step and the connector before it = green*/
        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #fdd922;
            color: #111;
        }


        /* Not relevant to this form */
        .dme_link {
            margin-top: 30px;
            text-align: center;
        }

        .dme_link a {
            background: #FFF;
            font-weight: bold;
            color: #ee0979;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 5px 25px;
            font-size: 12px;
        }

        .dme_link a:hover,
        .dme_link a:focus {
            background: #C5C5F1;
            text-decoration: none;
        }
        .select2-selection__rendered {
            line-height: 37px !important;
        }
        .select2-container .select2-selection--single {
            height: 37px !important;
        }
        .select2-container  {
            margin-bottom: 15px;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
    </style>
</head>

<body>
  <!-- MultiStep Form -->
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <br>
              <h2 class="text-center text-light">Apply For Seller Account</h2>
              <form id="sellerform" novalidate class="form" method="post" enctype="multipart/form-data"
                    action="{{route('upgrade.seller.company.post', $company)}}">
                  @csrf
                  <!-- progressbar -->
                      <div class="col-md-12 text-center">
                      <ul id="progressbar">
                          <li class="active">{{ __('Agreement') }}</li>
                          <li>{{ __('Company Information') }}</li>
                      </ul>
                      </div>
                      <!-- fieldsets -->
                      <fieldset>
                          <h2 class="fs-title">Seller Agreement</h2>
                          <h3 class="fs-subtitle">Read the agreement carefully and proceed further !</h3>
                          <hr>

                          <div style="max-height:400px;overflow:scroll">
                             Agreement here
                          </div>
                          <hr>
                          <label class="font-weight-bold">
                              <input {{ old('eula') ? "checked" : "" }} required type="checkbox" name="eula" title="Please agree to the term">
                              I Agree with terms and conditions
                          </label>
                          <div class="errorTxt"></div>
                          @error('eula')
                          <span class="invalid-feedback text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          <input type="button" name="next" class="next action-button" value="Next" />
                      </fieldset>
                      <fieldset>
                          <h2 class="fs-title">Company Information</h2>
                          <h3 class="fs-subtitle">Tell us something more about your company</h3>

                          @if($company->logo)
                          <div class="form-group">
                              <label>{{ __('Company logo') }}:</label>
                              <br>
                              @if($image = @file_get_contents(asset('storage/'.$company->logo)))
                                  <img src="{{ asset('storage/'.$company->logo) }}" width="100" height="100" border="1">
                              @else
                                  <img src=" {{ asset('images/noimage.jpg') }}" width="100" height="100">
                              @endif

                          </div>
                          @endif
                          @if($company->name)
                              <div class="row">
                                  <div class="col-md-4">
                                      <label>Company Name:</label>
                                  </div>
                                  <div class="col-md-8">
                                      <p>{{ $company->name }}</p>
                                  </div>
                              </div>
                          @else
                              <label class="float-left">Company Name: <small class="text-danger">*</small></label>
                              <input class="@error('name') is-invalid @enderror" value="{{ $company->name }}"
                                     title="Please enter company name" required type="text" name="name"
                                     placeholder="Please enter company name" />
                              <div class="errorTxt"></div>
                              @error('name')
                              <span class="invalid-feedback text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                              @enderror
                          @endif
                              @if($company->reg_no)
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label>Business Registration Number:</label>
                                      </div>
                                      <div class="col-md-8">
                                          <p>{{ $company->reg_no }}</p>
                                      </div>
                                  </div>
                              @else
                                  <label class="float-left">{{ __('Business Registration Number') }} <small class="text-danger">*</small></label>
                                  <input class="@error('reg_no') is-invalid @enderror" required name="reg_no"  type="text"
                                         value="{{old('reg_no')}}" placeholder="Please Enter Business Registration Number"
                                         title="Please Enter Business Registration Number.">
                                  <div class="errorTxt"></div>
                                  @error('reg_no')
                                  <span class="invalid-feedback text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                  @enderror
                              @endif
                              @if($company->reg_no)
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label> Business Type:</label>
                                      </div>
                                      <div class="col-md-8">
                                          <p>{{ $company->industry->name }}</p>
                                      </div>
                                  </div>
                              @else
                                  <label class="float-left">{{ __('Business Type') }}: <small class="text-danger">*</small></label>
                                  <select title="Please select business type" required name="industry_id"
                                          class="@error('industry_id') is-invalid @enderror form-control select2" id="industry_id">
                                      <option value="">Please select business type</option>
                                      @foreach($industry as $s)
                                          <option value="{{$s->id}}" /> {{$s->name}} </option>
                                      @endforeach
                                  </select>
                                  <div class="errorTxt"></div>
                                  @error('industry_id')
                                    <span class="invalid-feedback text-danger" role="alert">
                                         <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                              @endif
                              @if($company->phone)
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label>Contact Number:</label>
                                      </div>
                                      <div class="col-md-8">
                                          <p>{{ $company->phone }}</p>
                                      </div>
                                  </div>
                              @else
                                  <label class="float-left">{{ __('Contact Number') }} <small class="text-danger">*</small></label>
                                  <input class="@error('phone') is-invalid @enderror" required number name="phone" pattern="[0-9]+" type="text"
                                         value="{{old('phone')}}" placeholder="Please Enter Contact Number."
                                         title="Please Enter Valid Phone No">
                                  <div class="errorTxt"></div>
                                  @error('phone')
                                  <span class="invalid-feedback text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                  @enderror
                              @endif

                          <div class="row">
                              <div class="col-md-4">
                                  <label>Address:</label>
                              </div>
                              <div class="col-md-8">
                                  <p>{{ $company->street }} <br>
                                      {{ $company->postal_code }} {{ $company->postal_code }}<br>
                                      {{ $company->state->name }}
                                  </p>
                              </div>
                          </div>

                              <h3 class="fs-title">SSM Documents</h3>
                                  <div class="form-group row">
                                      @foreach($doc_type_ssm as $document)
                                          <div class="col-md-6">
                                              <label style="font-weight: 700">{{ __($document->name) }} : </label>

                                              @if(isset($myssmDocuments[$document->id]))
                                                  <a href="{{ asset('storage/'.$myssmDocuments[$document->id]->file_path) }}" target="_blank">My {{ $myssmDocuments[$document->id]->doc_type->name }}</a>
                                              @endif
                                          </div>
                                      @endforeach
                                  </div>
                              <hr>
                              <h2 class="fs-title">Payment Information</h2>
                               <div class="form-row">
                                   <div class="form-group col-md-6">
                                       <label class="float-left">{{ __('Bank Name') }}: <small class="text-danger">*</small></label>
                                       <select title="Please select Bank Name" required name="bank_id"
                                               class="@error('bank_id') is-invalid @enderror form-control select2" id="bank_id">
                                           <option value="">Please select Bank Name</option>
                                           @foreach($bank as $s)
                                               <option value="{{$s->id}}" /> {{$s->name}} </option>
                                           @endforeach
                                       </select>
                                   </div>
                                   <div class="form-group col-md-6">
                                       <label class="float-left">{{ __('Bank Account Number') }}: <small class="text-danger">*</small></label>
                                       <input class="@error('bank_account') is-invalid @enderror" title="Invalid bank account no." required number name="bank_account"
                                              type="text" value="{{old('bank_account')}}" placeholder="{{ __('Please enter bank account number') }}">
                                       <div class="errorTxt"></div>
                                       @error('bank_account')
                                       <span class="invalid-feedback text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                       @enderror
                                   </div>
                              </div>
                              <hr>
                              <h2 class="fs-title">SST INFORMATION</h2>
                              <div class="form-group">
                                  <label>{{ __('SST Number') }}</label>
                                  <input  title="Invalid SST number" type="text" name="sst_no"
                                         value="{{old('sst_no')}}" placeholder="{{ __('Please enter SST number') }}">
                              </div>
                              <div class="form-row">
                                  @foreach($doc_type_sst as $doc_type)
                                      <div class="col-md-4">
                                          <label style="font-weight: 700">{{ __($doc_type->name) }}</label>
                                          <input id="sstfile_{{ $doc_type->id }}" accept="jpg, jpeg, png, pdf" type="file"
                                                 class="form-control @error('sstfile.' .$doc_type->id) is-invalid @enderror"
                                                 value="{{ old('sstfile') ? old('sstfile')[$doc_type->id] : null }}" name="sstfile[{{ $doc_type->id }}]" autofocus />
                                          @error('sstfile.' . $doc_type->id)
                                            <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
										    </span>
                                          @enderror
                                      </div>
                                  @endforeach
                              </div>
                             <hr>
                          <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                          <input type="submit" name="submit" class="submit action-button" value="Submit" />
                      </fieldset>
              </form>
          </div>
      </div>
  </div>

  <br>
  <!-- /.MultiStep Form -->
</body>
<!-- Bootstrap JS -->
<!-- jQuery 3.5.4 -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Select2 JS -->
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<!-- jQuery UI JS -->
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/additional-methods.min.js') }}"></script>
<script>
    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function () {

        if ($('#sellerform').valid()) {
            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50) + "%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'position': 'absolute'
                    });
                    next_fs.css({
                        'left': left,
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        }

    });

    $(".previous").click(function () {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'left': left
                });
                previous_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".submit").click(function () {
        return true;
    });

    $('.select2').select2({
        allowClear: true,
        width: '100%'
    });
</script>
<script>
    jQuery(function ($) {
        var validator = $('form').validate({
            rules: {
                first: {
                    required: true
                },
                second: {
                    required: true
                }
            },
            messages: {},
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>
</html>
