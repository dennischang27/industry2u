<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="robots" content="all">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <meta name="theme-color" content="#157ED2">
  <title>{{ config('app.name', 'Industry2u') .  __(' Upgrade to Supplier') }}</title>
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
            width: 33%;
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
              <h2 class="text-center text-light">Apply For Supplier Account</h2>
              <form id="sellerform" novalidate class="form" method="post" enctype="multipart/form-data"
                    action="{{route('apply.seller.company.post')}}">
                  @csrf
                  <!-- progressbar -->
                      <div class="col-md-12 text-center">
                      <ul id="progressbar">
                          <li class="active">{{ __('Agreement') }}</li>
                          <li>{{ __('Company Information') }}</li>
                          <li>{{ __('Business information & confirm') }}</li>
                      </ul>
                      </div>
                      <!-- fieldsets -->
                      <fieldset>
                          <h2 class="fs-title">Supplier Agreement</h2>
                          <h3 class="fs-subtitle">Read the agreement carefully and proceed further !</h3>
                          <hr>

                          <div style="max-height:400px;overflow:scroll">
                              <p align="center">
                                  <strong>TERMS FOR BUYERS &amp; SELLERS</strong>
                              </p>
                              <p>
                                  <strong>1. </strong>
                                  <strong>GENERAL</strong>
                              </p>
                              <p>
                                  1.1. All the following terms and conditions (“    <strong>Terms for Buyers &amp; Sellers</strong>”) shall apply to the
                                  formation of contract, and the sale and purchase of Products between the
                                  Buyer and the Seller, and shall govern: (i) the use of our Services and
                                  Platform by the Buyer, amongst others, to become a Buyer, to communicate
                                  with the Seller, to obtain quotation and to purchase the Product(s) through
                                  the Platform; and (ii) the use of our Services and Platform by the Seller,
                                  amongst others, to become a Seller, to communicate with the Buyer, to list
                                  and display Product(s) for sale, to provide quotation and to sell the
                                  Product(s) through the Platform. These terms and conditions shall be read
                                  together with and supplementary to the: (a) Terms of Use; (b) Privacy
                                  Policy; and (c) any and all other terms, policies, procedures, guidelines,
                                  rules, directives and/or instructions of whatsoever nature presently and
                                  from time to time issued, given, made and/or established by us via the
                                  Platform.
                              </p>
                              <p>
                                  1.2. You hereby acknowledge and understand that the Platform is merely to
                                  facilitate the communication between the Buyer and the Seller, and DBO is
                                  not itself a Buyer or a Seller and the actual contract for sale/supply of
                                  the Product is directly made between the Buyer. As a result, DBO has no
                                  control over the quality, safety or legality of the Products, the truth or
                                  accuracy of the listings, the ability of Sellers to sell the Products, or
                                  the ability of Buyers to buy the Products. DBO cannot and do not control
                                  whether or not Sellers will complete the sale of the Products they offer or
                                  whether Buyers will complete the purchase of Products they have purchased.
                              </p>
                              <p>
                                  1.3. We reserve the right to amend, change, modify, add or remove portions
                                  of the provisions of these Terms for Buyers &amp; Sellers at any time. Such
                                  changes/amendments could be posted online and shall be effective when
                                  posted on the Platform with no other notices provided. You are responsible
                                  to regularly review information posted on the Platform to obtain timely
                                  notice of such changes/amendments and you are deemed to be aware of and
                                  bound by any changes to the foregoing upon their publication on the
                                  Platform. If you do not wish to be bound by these amended Terms for Buyers
                                  &amp; Sellers, you shall cease using the Platform and the Services
                                  immediately. However, your continue use of the Platform, or continue access
                                  of the tool(s) provided to the Buyers or the Sellers after the
                                  changes/amendments are made will be deemed to constitute acceptance of the
                                  amended Terms for Buyers &amp; Sellers.
                              </p>
                              <p>
                                  1.4. You hereby agree and understand that these Terms for Buyers &amp;
                                  Sellers, read together with the other DBO Terms and Conditions, shall
                                  prevail in respect of any matters addressed herein.
                              </p>
                              <p>
                                  BY ACCESING, BROWSING AND/OR USING THE PLATFORM AND SERVICES AND ACCESSING
                                  THE TOOLS PROVIDED WHETHER TO THE BUYER OR THE SELLER, YOU GIVE YOUR
                                  IRREVOCABLE ACCEPTANCE OF AND CONSENT TO THESE TERMS FOR BUYERS &amp;
                                  SELLERS, AS WELL AS THE OTHER DBO TERMS AND CONDITIONS. IF YOU DO NOT AGREE
                                  TO THESE TERMS FOR BUYERS &amp; SELLERS AND THE OTHER DBO TERMS AND
                                  CONDITIONS, PLEASE REFRAIN FROM USING OUR SERVICES, ACCESSING THE PLATFORM,
                                  BUYING AND/OR SELLING ON THE PLATFORM.
                              </p>
                              <p>
                                  <strong>2. </strong>
                                  <strong>DEFINITIONS</strong>
                              </p>
                              <p>
                                  2.1. All expression used herein will have the same meaning as set out in
                                  the Terms of Use at [insert link] except where the context otherwise
                                  requires or where expressly stated to the contrary:
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <table cellspacing="0" cellpadding="0" border="1">
                                  <tbody>
                                  <tr>
                                      <td width="170" valign="top">
                                          <p>
                                              “<strong>Application Form</strong>”
                                          </p>
                                      </td>
                                      <td width="384" valign="top">
                                          <p>
                                              shall have the meaning ascribed to it in Clause 3.3;
                                          </p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td width="170" valign="top">
                                          <p>
                                              “<strong>Content</strong>”
                                          </p>
                                      </td>
                                      <td width="384" valign="top">
                                          <p>
                                              shall have the meaning ascribed to it in Clause 4.1.1.;
                                          </p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td width="170" valign="top">
                                          <p>
                                              “<strong>Contract</strong>”
                                          </p>
                                      </td>
                                      <td width="384" valign="top">
                                          <p>
                                              means the contract formed between the Seller and the Buyer
                                              on the Platform in respect of the sale and purchase of the
                                              Product;
                                          </p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td width="170" valign="top">
                                          <p>
                                              “<strong>Seller Content</strong>”
                                          </p>
                                      </td>
                                      <td width="384" valign="top">
                                          <p>
                                              means the Content posted or otherwise made available by the
                                              Seller through the Platform in connection with the sale of
                                              the Product; and
                                          </p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td width="170" valign="top">
                                          <p>
                                              “<strong>Successful Transaction</strong>”
                                          </p>
                                      </td>
                                      <td width="384" valign="top">
                                          <p>
                                              means a successful purchase transaction of the Product, for
                                              which each of the following steps has been completed:
                                          </p>
                                          <p>
                                              (a) the Buyer and the Seller makes the Contract via the
                                              Platform;
                                          </p>
                                          <p>
                                              (b) the Seller successfully delivers the Product to the
                                              Buyer, and the Buyer successfully makes the payment for the
                                              Product; and
                                          </p>
                                          <p>
                                              (c) the Platform system updates and displays the status for
                                              that particular transaction as having been completed in
                                              accordance with Clause 7.1 below.
                                          </p>
                                      </td>
                                  </tr>
                                  </tbody>
                              </table>
                              <p>
                                  2.2. In these Terms for Buyers &amp; Sellers:
                              </p>
                              <p>
                                  (a) references to a statutory provision including any subsidiary
                                  legislation made from time to time under that provision;
                              </p>
                              <p>
                                  (b) references to a statute or statutory provision include that statute or
                                  provision as from to time modified, re-enacted or consolidated, whether
                                  before or after the date of these Terms for Buyers &amp; Sellers, so far as
                                  such modification, re-enactment or consolidation applies or is capable of
                                  applying to any transaction entered into in accordance with these Terms for
                                  Buyers &amp; Sellers and (so far as liability thereunder may exist or can
                                  arise) shall include also any past statute or statutory provision (as from
                                  time to time modified, re-enacted or consolidated) which such statute or
                                  provision has directly or indirectly replaced;
                              </p>
                              <p>
                                  (c) where the context requires, and the law permits, references to “<strong>DBO</strong>”, “<strong>we</strong>”, “<strong>us</strong>”, “    <strong>our</strong>” or “<strong>ours</strong>” shall include subsidiaries
                                  or related companies of Digital BlueOcean Berhad (as defined under the
                                  Companies Act 2016);
                              </p>
                              <p>
                                  (d) unless a contrary indication appears, a reference in these Terms for
                                  Buyers &amp; Sellers to “<strong>including</strong>” shall not be construed
                                  restrictively but shall mean “
                                  <strong>
                                      including but without prejudice to the generality of the foregoing
                                  </strong>
                                  ” and “<strong>including, but without limitation</strong>”;
                              </p>
                              <p>
                                  (e) unless the context otherwise requires or permits, references to the
                                  singular number shall include references to the plural number and vice
                                  versa; references to natural persons shall include bodies corporate and
                                  vice versa; and words denoting any gender shall include all genders;
                              </p>
                              <p>
                                  (f) the expression “<strong>person</strong>” means any individual,
                                  corporation, partnership, association, limited liability company, trust,
                                  governmental or quasi-governmental authority or body or other entity or
                                  organisation;
                              </p>
                              <p>
                                  (g) the headings and titles for each clause are purely for ease of
                                  reference and do not form part of or affect the interpretation of these
                                  Terms for Buyers &amp; Sellers; and
                              </p>
                              <p>
                                  (h) the tables and samples are purely for ease of reference, illustrative
                                  purposes, meant to provide general guidelines only and actual information,
                                  performance and result may be different.
                              </p>
                              <p>
                                  <strong>3. </strong>
                                  <strong>REQUIREMENTS TO BECOME A BUYER/SELLER</strong>
                              </p>
                              <p>
                                  3.1. To qualify in applying for becoming a Buyer or a Seller on the
                                  Platform, you must own a business (including, but not limited to, a
                                  corporate or other business entity), and you shall submit all documents
                                  relating to the incorporation, registration, such other aspects of such
                                  corporate or business entity, and such other documents as we may deem
                                  necessary at any time and from time to time.
                              </p>
                              <p>
                                  3.2. In applying to become a Buyer or a Seller, and continuing to be a
                                  Buyer or a Seller, it is hereby represented and warranted that:
                              </p>
                              <p>
                                  3.2.1. you are a corporate or business entity that has been validly and
                                  legally incorporated and/or registered with the relevant authorities
                                  (including but not limited to, the registrar of companies or its
                                  equivalent) in the jurisdiction of which such entity is located;
                              </p>
                              <p>
                                  3.2.2. you have the power, capacity and ability to enter into, perform and
                                  comply with the obligations as stated in these Terms for Buyers &amp;
                                  Sellers and DBO Terms and Conditions;
                              </p>
                              <p>
                                  3.2.3. all authorisations, actions, conditions and things required to be
                                  taken, fulfilled and done in order to enable you to exercise your rights
                                  and perform and comply with your obligations under these Terms for Buyers
                                  &amp; Sellers and DBO Terms and Conditions and to ensure that those
                                  obligations are valid, legal and enforceable, have been or will be taken,
                                  fulfilled and done and in this respect;
                              </p>
                              <p>
                                  3.2.4. you shall keep the records with us in respect of the composition of
                                  Corporate Representatives accurate and up to date at all time, and shall
                                  inform us of any change in your Corporate Representatives; and
                              </p>
                              <p>
                                  3.2.5. all the Corporate Representatives representing you shall have the
                                  requisite authority to bind you, and the acceptance of these Terms for
                                  Buyers &amp; Sellers, the Terms of Use, Privacy Policy, and the other DBO
                                  Terms and Conditions will be deemed an acceptance on your part.
                              </p>
                              <p>
                                  3.3. An application to become a Buyer or a Seller via a designated form (“    <strong>Application Form</strong>”) together with the documents as stated
                                  in Clause 3.1 above shall be submitted to DBO on the Platform, and it shall
                                  be subject to DBO’s approval.
                              </p>
                              <p>
                                  3.4. DBO reserves the right to request for additional documents or
                                  information as it deems necessary from you in assessing your application to
                                  become a Buyer or a Seller.
                              </p>
                              <p>
                                  3.5. An incomplete application due to your failure to complete the
                                  Application Form, and/or to furnish the requested documents or information,
                                  will not be processed unless and until such application is completed duly
                                  and/or the requested documents or information are provided to us, and we
                                  shall have no liability arising out of or in connection with such
                                  unprocessed application.
                              </p>
                              <p>
                                  3.6. In applying to become a Buyer or a Seller, you hereby acknowledge that
                                  you have read, understood and irrevocably agreed to all the provisions in
                                  these Terms for Buyers &amp; Sellers, Terms of Use, Privacy Policy and/or
                                  DBO Terms and Conditions.
                              </p>
                              <p>
                                  3.7. We reserve the right to approve, decline or suspend any application
                                  submitted to become a Buyer or a Seller for whatever reason(s) at our sole
                                  and absolute discretion without having to assign any reason thereto, and
                                  such decision shall be final and conclusive.
                              </p>
                              <p>
                                  3.8. You warrant that all documents and information provided to us as part
                                  of your application process is accurate, current and complete at all times
                                  and you will immediately let us know if there are any changes to the same.
                                  If we rely on the contents of your application and accept you as a Buyer or
                                  a Seller, you irrevocably agree that you shall indemnify and keep us
                                  indemnified and hold us harmless for any expense, loss or damage that we
                                  may suffer arising from any inaccurate or false statement or
                                  misrepresentation of facts submitted to us by you.
                              </p>
                              <p>
                                  <strong>4. </strong>
                                  <strong>PARTIES’ GENERAL UNDERTAKINGS </strong>
                              </p>
                              <p>
                                  4.1. You agree and undertake that:
                              </p>
                              <p>
                                  4.1.1. you shall be solely and fully responsible for all information,
                                  linked pages, features, data, text, images, photographs, graphics, music,
                                  sounds, video (including live streams), messages, tags, content,
                                  programming, software, application services (including, without limitation,
                                  any mobile application services) or other materials made available through
                                  the Platform by you in connection with the sale and/or purchase of the
                                  Product (“<strong>Content</strong>”);
                              </p>
                              <p>
                                  4.1.2. all the Content shall be true, accurate, complete and up to date;
                              </p>
                              <p>
                                  4.1.3. you shall not violate any laws, third party rights or DBO’s policies
                                  as may be adopted by DBO from time to time, including but not limited to,
                                  DBO Terms and Conditions;
                              </p>
                              <p>
                                  4.1.4. you shall not take any action that may undermine the feedback or
                                  ratings systems;
                              </p>
                              <p>
                                  4.1.5. you shall not use a false e-mail address, impersonate any person or
                                  entity, or otherwise mislead as to the origin of content uploaded by you;
                              </p>
                              <p>
                                  4.1.6. you shall be responsible for keeping your Account password secure.
                                  We cannot and will not be liable for any loss or damage arising out of or
                                  in connection with the Buyer’s/Seller’s omission, neglect or failure to
                                  maintain the security of its Account and password; and
                              </p>
                              <p>
                                  4.1.7. you shall be responsible to update the status of a transaction
                                  accurately without undue delay so to minimise the potential for disputes in
                                  respect of the Contract.
                              </p>
                              <p>
                                  4.2. You hereby represent and warrant that:
                              </p>
                              <p>
                                  4.2.1. you have, at all time, all requisite certificates, licences,
                                  approvals, permits and such other authorisations under all prevailing laws
                                  and regulations in place to engage in the sale or purchase of the Product
                                  via the Platform;
                              </p>
                              <p>
                                  4.2.2. the Content:
                              </p>
                              <p>
                                  (a) shall not contain any nudity, obscenity, vulgarity or offensive
                                  material;
                              </p>
                              <p>
                                  (b) is not illegal or threatening;
                              </p>
                              <p>
                                  (c) is not defamatory or libellous;
                              </p>
                              <p>
                                  (d) is not invasive of privacy;
                              </p>
                              <p>
                                  (e) does not include any personal data in contravention of the Personal
                                  Data Protect Act 2010;
                              </p>
                              <p>
                                  (f) is not commercial solicitation, pyramid schemes, chain letters, mass
                                  mailings or any form of spam;
                              </p>
                              <p>
                                  (g) is not political campaigning in any form;
                              </p>
                              <p>
                                  (h) does not consist of or contain computer viruses or other forms of
                                  computer codes, technologies or programs that may harm the Platform, or the
                                  interests or property of DBO and/or of the other Users;
                              </p>
                              <p>
                                  (i) does not infringe the intellectual property right of DBO and/or any
                                  third party;
                              </p>
                              <p>
                                  (j) does not violate these Terms for Buyers &amp; Sellers, Terms of Use,
                                  DBO Terms and Conditions, Privacy Policy or any other policies of DBO as
                                  made known to you directly or through the Platform; and/or
                              </p>
                              <p>
                                  (k) is otherwise injurious or objectionable to DBO or any third parties.
                              </p>
                              <p>
                                  4.3. As a Buyer or to engage in any action or activity with the intention
                                  to purchase the Product on the Platform, in addition to those stated in
                                  Clauses 4.1 and 4.2 above, you further agree and undertake that:
                              </p>
                              <p>
                                  4.3.1. you shall use the Platform, the Services and/or the Content in bona
                                  fide where you shall have genuine intention to purchase and procure for the
                                  Product, and the Platform, the Services and/or the Content shall not be
                                  used to manipulate the price of any Product, or to harm any business
                                  interest of other Users and/or of DBO;
                              </p>
                              <p>
                                  4.3.2. the Seller may impose its own terms and conditions applicable to its
                                  sale and your purchase of the Product, and it is your obligation to check
                                  if you are agreeable to such terms and conditions before you shall proceed
                                  to place an order for a Product on the Platform. It is further agreed that
                                  DBO is a party to such individual terms and conditions as may be imposed by
                                  the Seller, and DBO shall have no control over those terms and conditions;
                              </p>
                              <p>
                                  4.3.3. you shall not commit to purchasing the Product with no intention of
                                  paying for it;
                              </p>
                              <p>
                                  4.3.4. you shall not request or negotiate a price for the sale of Product:
                              </p>
                              <p>
                                  (a) with no genuine intention to purchase the Product;
                              </p>
                              <p>
                                  (b) for the purpose of using pricing, quotations or other information
                                  received in doing so for commercial or competitive purposes, business or
                                  market intelligence purposes or general surveying; or
                              </p>
                              <p>
                                  (c) for any purpose which DBO may designate as improper or inappropriate in
                                  its sole discretion from time to time;
                              </p>
                              <p>
                                  4.3.5. where you accept an offer made by the Seller in accordance with
                                  Clauses 5.1.1 and 5.4.1, you shall be obligated to complete the purchase of
                                  the Product as per the Contract between you and the Seller, subject to any
                                  rights you may have to cancel the order under the Contract or the
                                  applicable laws; and
                              </p>
                              <p>
                                  4.3.6. under no circumstances will DBO be liable in any way for any of such
                                  contents, including but not limited to, any errors or omissions in the
                                  information pertaining to the Product, or any loss or damage of any kind
                                  incurred as a result of the use of, or reliance on, any content posted,
                                  emailed, transmitted or otherwise made available on the Platform.
                              </p>
                              <p>
                                  4.4. As a Seller or to engage in any action or activity with the intention
                                  to sell the Product on the Platform, in addition to those stated in Clauses
                                  4.1 and 4.2 above, you further agree and undertake that:
                              </p>
                              <p>
                                  4.4.1. you shall use the Platform, the Services and/or the Content in bona
                                  fide where you shall have genuine intention to sell the Product, and the
                                  Platform, the Services and/or the Content shall not be used to manipulate
                                  the price of any Product, interfere with another Seller’s listings, or to
                                  harm any business interest of other Users and/or of DBO;
                              </p>
                              <p>
                                  4.4.2. you shall ensure that your own respective terms and conditions
                                  applicable to the sale of Product are made known to and agreed to by the
                                  Buyer, and shall not conflict or be inconsistent with any of the Seller
                                  Content;
                              </p>
                              <p>
                                  4.4.3. where the Buyer accepts the offer in accordance with Clauses 5.1.1
                                  and 5.4.1, you shall be obligated to complete the sale of the Product as
                                  per the Contract between you and the Seller, subject to any rights you may
                                  have to cancel the order under the Contract or the applicable laws;
                              </p>
                              <p>
                                  4.4.4. you shall be fully responsible for the information made available on
                                  the Platform in connection with the supply of Product, including
                                  photographs, drawings, data about the extent of the delivery, appearance,
                                  performance, dimensions, weight, consumption of operating materials,
                                  operating costs or any information disclosed by you through the Platform
                                  (for example, any forum or chat system on the Platform);
                              </p>
                              <p>
                                  4.4.5. you shall not register or list on the Platform a Product which you
                                  do not offer or are unable to offer;
                              </p>
                              <p>
                                  4.4.6. you shall not provide a quotation containing terms and conditions
                                  which you do not intend or are unable to comply with;
                              </p>
                              <p>
                                  4.4.7. you shall not use any misleading titles, words or phrases that do
                                  not accurately describe the Product you supply;
                              </p>
                              <p>
                                  4.4.8. you shall not include any information that is fraudulent or
                                  otherwise incorrect, and/or commit any action that would amount to
                                  misrepresentation to the Buyer;
                              </p>
                              <p>
                                  4.4.9. you shall not solicit the Buyer to pay or do anything not permitted
                                  by these Terms for Buyers &amp; Sellers, Terms of Use, Privacy Policy, the
                                  other DBO Terms and Conditions or policies as may be issued by DBO as it
                                  may in its sole discretion determine from time to time;
                              </p>
                              <p>
                                  4.4.10. offer any Product or do anything that contravenes these Terms for
                                  Buyers &amp; Sellers, Terms of Use, Privacy Policy, the other DBO Terms and
                                  Conditions and/or any laws.
                              </p>
                              <p>
                                  4.4.11. you shall not post or list any inappropriate Seller Content or
                                  Products on the Platform;
                              </p>
                              <p>
                                  4.4.12. you shall not transfer your Seller Account to another person
                                  without DBO’s consent;
                              </p>
                              <p>
                                  4.4.13. you shall be responsible to ensure that there is adequate stock of
                                  Products to meet demand at all times;
                              </p>
                              <p>
                                  4.4.14. you shall be responsible for any defect or non-conformity and
                                  complying with any recall or safety alert with respect to any Product
                                  listed for sale by you on the Platform. You agree to immediately remove
                                  such Product upon issuance of any recall or safety alert or allegation of
                                  infringement of intellectual property rights with respect to such Product;
                              </p>
                              <p>
                                  4.4.15. you have, at all time, all requisite certificates, licences,
                                  approvals, permits and such other authorisations under all prevailing laws
                                  and regulations in place to engage in the provision of the Product via the
                                  Platform;
                              </p>
                              <p>
                                  4.4.16. the Product shall:
                              </p>
                              <p>
                                  (a) be free from encumbrances;
                              </p>
                              <p>
                                  (b) be of merchantable quality and fit for purposes intended;
                              </p>
                              <p>
                                  (c) conform with all applicable laws, regulations, rules and requirements
                                  as imposed by relevant authorities;
                              </p>
                              <p>
                                  (d) not violate or conflict in any respect with any order, injunction,
                                  decree, determination, award or other direction of any court or tribunal;
                              </p>
                              <p>
                                  (e) not be counterfeit or replica items, and shall be genuine, bona fide
                                  product and does not violate the right of any third party; and
                              </p>
                              <p>
                                  (f) be lawful and legal to be sold in Malaysia and are in compliance with
                                  all applicable laws;
                              </p>
                              <p>
                                  4.4.17. the Seller, if required by the applicable law, is registered for
                                  consumption tax or such other tax collection purposes; and
                              </p>
                              <p>
                                  4.4.18. Where requested by DBO, you shall immediately furnish such evidence
                                  as necessary to prove that:
                              </p>
                              <p>
                                  (a) you have obtained all required approvals, licences, authorisations
                                  and/or certification from all relevant parties including but not limited to
                                  the appropriate authorities and/or brand owners or principals for the sale
                                  of Products listed by you on the Platform; and
                              </p>
                              <p>
                                  (b) you are the owner and/or are authorised or licensed to use any
                                  intellectual property rights embedded in or used in conjunction with the
                                  Products listed by you on the Platform.
                              </p>
                              <p>
                                  4.5. All communications regarding the transaction or potential transactions
                                  between the Buyers and the Sellers shall be made through the Platform, and
                                  each of them is prohibited from directly entering into a transaction with
                                  the other party without using the Platform with the intention to injure the
                                  business interest of DBO, or to avoid paying the Transaction Fee.
                              </p>
                              <p>
                                  <strong>5. </strong>
                                  <strong>FORMATION OF A CONTRACT</strong>
                              </p>
                              <p>
                                  5.1. The Buyer may submit its request and specific requirements, where
                                  applicable, of the Product. Such requests would be disseminated to the
                                  Seller on the Platform. The Seller may, pursuant to request of the Buyer,
                                  provide quotation to the Buyer via the Platform in respect of the relevant
                                  Product. Upon the provision of the quotation, it is agreed that:
                              </p>
                              <p>
                                  5.1.1. such quotation shall constitute an offer which is capable of being
                                  accepted by the Buyer within 7 days from the provision of such quotation (“    <strong>Offer Period</strong>”), and in such circumstance, DBO shall be
                                  entitled but not obliged to process order made by the Buyer within the
                                  Offer Period without further consent from the Seller; and
                              </p>
                              <p>
                                  5.1.2. the Seller shall reserve the relevant Product and make sure that the
                                  relevant Product is available for sale during the Offer Period.
                              </p>
                              <p>
                                  5.2. Where relevant, the quotation shall be provided by the Seller in the
                                  format prescribed by us, and shall contain minimum particulars and
                                  information as required by us. In addition, the Buyer and the Seller hereby
                                  acknowledge and agree that the quotation and order shall be made directly
                                  between them, and DBO is not a party thereto.
                              </p>
                              <p>
                                  5.3. In providing quotation to the Buyer and addressing any enquiry
                                  received from the Buyer, the Seller shall respond:
                              </p>
                              <p>
                                  5.3.1. with accurate and complete information; and
                              </p>
                              <p>
                                  5.3.2. in a prompt and efficient manner.
                              </p>
                              <p>
                                  5.4. The Contract shall be formed at the point:
                              </p>
                              <p>
                                  5.4.1. where the Buyer places order in response to the Seller’s respective
                                  quotation on the Platform for the Product within the Offer Period; or
                              </p>
                              <p>
                                  5.4.2. where the Seller accepts the order placed by the Buyer, in the event
                                  that the Buyer has not placed order within the Offer Period.
                              </p>
                              <p>
                                  A confirmation in respect of the formation of the Contract shall be sent to
                                  the Buyer and the Seller via the Platform. For the avoidance of doubt, in
                                  the event the Buyer fails to accept the Seller’s quotation within the Offer
                                  Period, such offer as contained in the quotation by the Seller shall be
                                  revoked, and the order placed by the Buyer thereafter shall be treated as
                                  an offer from the Buyer where the Seller shall have the discretion whether
                                  to accept the same.
                              </p>
                              <p>
                                  5.5. Once the Contract is formed, the invoice shall be generated via the
                                  Platform and sent to the Buyer for and on behalf of the Seller, and the
                                  parties shall carry out their respective obligations under the Contract in
                                  accordance with the provisions of the Contract, including but not limited
                                  to, the duty to deliver the Product, to fulfil any sales or customer
                                  service or warranty services, to make payment for the Product, etc. It is
                                  further agreed and declared by the Seller and the Buyer that no
                                  modification, change and cancellation can be made to the Contract, and it
                                  is the parties’ responsibility to ensure that all details of the order are
                                  accurate before placing the order and entering into the Contract.
                              </p>
                              <p>
                                  <strong>6. </strong>
                                  <strong>PERFORMANCE OF A CONTRACT</strong>
                              </p>
                              <p>
                                  6.1. Each of the Buyer and the Seller shall be responsible for the
                                  performance of their respective obligations under the Contract. DBO accepts
                                  no obligations and liabilities whatsoever arising out of, in connection
                                  with or in relation to the formation, performance, execution or termination
                                  of the Contract.
                              </p>
                              <p>
                                  6.2. It is recommended for the Buyer to inspect the Product upon delivery
                                  thereof by the Seller as soon as practicably possible, so to minimise the
                                  potential for disputes in respect of the condition, conformity, quality,
                                  quantity or such other aspects of the Product between the parties.
                              </p>
                              <p>
                                  6.3. It is further agreed to by the Buyer and the Seller that DBO shall not
                                  be responsible and liable for any and all aspects of the Contract,
                                  including but not limited to, the delivery of the Product, the payment for
                                  the Product, the condition and conformity with the specification of the
                                  Product. DBO, by providing the Platform, is not in a position to guarantee
                                  the performance and completion of the Contract.
                              </p>
                              <p>
                                  6.4. In the event that the Buyer or the Seller fails to discharge its
                                  respective obligations under the Contract, you as the non-defaulting party
                                  to the relevant transaction may notify us in writing via a designated form
                                  on the Platform of such incident/occurrence, and we shall be entitled to
                                  rely on such information provided by you and shall have the right to impose
                                  such penalties against such defaulting party in accordance with the
                                  policies as may be issued by us from time to time, including but not
                                  limited to, blacklist, suspend and/or terminate the defaulting party’s
                                  Account.
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  6.5. Any dispute between the Buyer and the Seller shall be resolved between
                                  themselves. In the event a problem arises in a transaction, they shall
                                  communicate with each other first to attempt to resolve such dispute by
                                  mutual discussions. If the matter cannot be resolved by mutual discussions,
                                  Users may approach the claims tribunal of their local jurisdiction to
                                  resolve any dispute arising from a transaction.
                              </p>
                              <p>
                                  6.6. To enable the other Users in determining whether to make a transaction
                                  on the Platform, it is agreed that DBO may implement a rating system on the
                                  Platform where:
                              </p>
                              <p>
                                  6.6.1. DBO may grade or rate your performance as a Seller or a Buyer on the
                                  Platform based on such criteria as DBO may determine from time to time in
                                  its sole and absolute discretion, or based on the feedback, comments or
                                  rating submitted by the other party to the transaction in respect of the
                                  Product supplied/purchased by you, as well as the performance of the
                                  Contract on your part; and
                              </p>
                              <p>
                                  6.6.2. the other party to the transaction may grade or rate your
                                  performance as a Seller or a Buyer on the Platform where it may post
                                  contents, including ratings and reviews, on the Platform.
                              </p>
                              <p>
                                  In the event of any misbehaviour the Platform, or any breach of these Terms
                                  for Buyers &amp; Sellers or the other DBO Terms and Conditions, we reserve
                                  the right to review and downgrade your rating. Our decision is final and
                                  cannot be contested. It is further irrevocably agreed and declared that we
                                  shall have no liability whatsoever arising out of or in connection with
                                  such rating system, and contents posted by the other parties to the
                                  respective transactions.
                              </p>
                              <p>
                                  6.7. In respect of the aforesaid rating system, the Buyer and the Seller
                                  must rate each other in good faith and honestly, and each of them must not
                                  make unfounded/malicious statements that can be harmful to the other party
                                  without basis. Further, it is acknowledged and agreed that the rating,
                                  review or feedback so submitted may be made publicly available and you
                                  shall be solely responsible for your review and DBO is not responsible to
                                  ascertain whether any opinion expressed is true. As such, you should ensure
                                  that any review posted is fair and not unlawful. Notwithstanding the
                                  aforesaid, if DBO is of the view that your published review of is not
                                  appropriate for public disclosure, or is defamatory or likely to violate
                                  the law or breach any DBO Terms and Conditions, DBO shall be entitled to
                                  delete such review at its sole and absolute discretion and without notice
                                  to you.
                              </p>
                              <p>
                                  6.8. DBO may implement such program(s) as it deems fit at any time and from
                                  time to time to encourage the Buyer and Seller in updating the status of
                                  the Contract between them, and leaving honest rating/review for each other
                                  (“<strong>Eligible</strong> <strong>Program</strong>”), including but not
                                  limited to, rewarding loyalty points, rebate or such other incentive to the
                                  Buyers and/or Sellers through their participation in specified activities
                                  as DBO may from time to time determine in its discretion. Generally, rebate
                                  would be credited to the Buyer’s Account upon its completion of
                                  rating/review for the Seller. The Eligible Program may be subject to
                                  additional and specific terms and conditions as may be issued by DBO on the
                                  Platform from time to time. DBO shall be entitled to revoke, discontinue,
                                  amend or modify any aspect of such Eligible Program, and it shall have no
                                  liability whatsoever arising out of, from or in connection with such
                                  revocation, discontinuance, amendment or modification.
                              </p>
                              <p>
                                  In relation to such rebate:
                              </p>
                              <p>
                                  6.8.1. the Buyer may redeem the rebate available in its Account by sending
                                  a request to DBO and use the rebate to offset the purchase price of the
                                  Product when making purchase of a Product from a Seller on the Platform.
                                  DBO would pay the relevant portion of the purchase price for which the
                                  rebate is redeemed to the Seller for and on behalf of the Buyer upon the
                                  delivery of the Product by the Seller to the Buyer. Nonetheless, where the
                                  purchase of the Product is not completed between the Seller and the Buyer
                                  eventually, DBO shall be entitled to direct the Seller to make refund of
                                  monies in respect of the rebate to DBO and it is subject to the refund and
                                  return policy as may be adopted by DBO from time to time.
                              </p>
                              <p>
                                  <strong>7. </strong>
                                  <strong>INVOICING</strong>
                              </p>
                              <p>
                                  7.1. DBO shall be entitled to charge the Transaction Fee for the Successful
                                  Transaction completed or deemed completed through the Platform. The
                                  Transaction Fee shall be 1% of the final amount for each Successful
                                  Transaction. For the avoidance of doubt, a transaction between the Seller
                                  and the Buyer is regarded as complete, and deemed to be a Successful
                                  Transaction only upon the occurrence of the following: -
                              </p>
                              <p>
                                  7.1.1. the Buyer confirms receipt of the Product ordered and delivered in
                                  satisfactory condition by clicking on the “Confirm Receipt” button; or
                              </p>
                              <p>
                                  7.1.2. if the Buyer fails to confirm receipt of the Product, the Product
                                  will be deemed to have been successfully delivered upon the expiry of the 7
                                  days after the Seller confirms its delivery of the Product by clicking on
                                  the “Delivered” button, and the Platform system will automatically change
                                  the status of the transaction on the Platform upon expiry of the said 7
                                  days.
                              </p>
                              <p>
                                  7.2. DBO shall be entitled to invoice the Seller upon the completion or
                                  deemed completion of a Successful Transaction. It is irrevocably agreed by
                                  the Seller that DBO shall be entitled to send the invoice via the Platform,
                                  and the invoice shall be deemed duly served at the time the invoice is sent
                                  to the Seller on the Platform as reflected in the Seller’s Account.
                              </p>
                              <p>
                                  7.3. The details of transactions occurred via Platform shall be tracked in
                                  the Seller Account, including but not limited to the amount of fees payable
                                  to DBO. The Seller shall be responsible for checking such details as
                                  reflected in the Seller Account from time to time. We shall have no
                                  liability for any printing, production, typographical, mechanical or other
                                  errors in the summaries of the Seller Account on the Platform, and it is
                                  the duty of the Seller to notify us of any printing, production,
                                  typographical, mechanical or other errors.
                              </p>
                              <p>
                                  7.4. DBO shall bill the Seller on a monthly basis, on every 15<sup>th</sup>
                                  of each calendar month (each a “<strong>Settlement Date</strong>”) in
                                  respect of the Payable Fees arising out of the transactions
                                  completed/deemed completed during the monthly billing period (i.e. the
                                  period from the 16<sup>th</sup> day of the preceding month up to the 15    <sup>th</sup> day of the same calendar month of the respective Settlement
                                  Date).
                              </p>
                              <p>
                                  7.5. The Seller shall make the payment of the Payable Fees to DBO within 14
                                  days from the Settlement Date (“<strong>Payment Due Date</strong>”),
                                  failing which, without prejudice to any other rights and remedies that DBO
                                  is entitled to, DBO shall be entitled to:
                              </p>
                              <p>
                                  7.5.1. an interest calculated on a daily basis at the rate of 10% per annum
                                  on any outstanding sum from the Payment Due Date until full sum is received
                                  by DBO, together with the interest thereon; and
                              </p>
                              <p>
                                  7.5.2. impose such penalties against the Seller in accordance with the
                                  policies as may be issued by us from time to time, including but not
                                  limited to, blacklist, suspend and/or terminate the Seller’s Account.
                              </p>
                              <p>
                                  7.6. It is hereby agreed that the Seller shall check and verify the details
                                  of every transaction transacted on the Platform within 24 hours from the
                                  occurrence thereof, and the details of the Payable Fees from time to time.
                                  Should there be any mistake, error or miscalculation, the Seller shall
                                  promptly notify DBO of the same, failing which the details thereof shall be
                                  deemed verified and confirmed by the Seller, and the Seller shall lose the
                                  right to make complaint thereof.
                              </p>
                              <p>
                                  <strong>8. </strong>
                                  <strong>RIGHTS OF DBO</strong>
                              </p>
                              <p>
                                  8.1. DBO reserves the right to refuse registration, suspend or cease the
                                  provision of any Services, feature of the Platform, the program as may be
                                  implemented by DBO from time to time without any liability in its sole and
                                  absolute discretion.
                              </p>
                              <p>
                                  8.2. DBO shall have the right, but not the obligation, to monitor and edit
                                  any Content. Notwithstanding such monitoring, DBO takes no responsibility
                                  and assumes no liability for any Content and reserves the right, but not
                                  the obligation, to remove any Content.
                              </p>
                              <p>
                                  8.3. Without limiting other remedies, DBO may limit, suspend or terminate
                                  the Platform, the Services and the Account, prohibit access to the Platform
                                  and its contents, delay or remove hosted contents and take technical and
                                  legal steps to keep you off the Platform if, based on DBO’s sole and
                                  absolute discretion, DBO is of the view that you are or may be potentially
                                  creating problems or possible legal liabilities, infringing the
                                  intellectual property rights of DBO and/or of any third party, or in breach
                                  of any of the DBO Terms and Conditions or these Terms for Buyers &amp;
                                  Sellers.
                              </p>
                              <p>
                                  8.4. Where there are no transaction of the Product under the
                                  Buyer’s/Seller’s Account or where a Buyer/Seller has been inactive for more
                                  than 12 months, DBO reserves the right to cancel and suspend and/or
                                  terminate your Account and/or remove all of your Product listings without
                                  notice to you.
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  <strong>9. </strong>
                                  <strong>INDEMNITY</strong>
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  9.1. You shall indemnify DBO against all claims resulting from content
                                  posted, supplied or uploaded to the Platform by you, including but not
                                  limited to the Content uploaded by you.
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  9.2. You unconditionally and irrevocably undertake to fully and effectively
                                  indemnify us, our employees, agents, servants, affiliate, members of our
                                  group of companies and third parties connected to us (each, an “<strong>Indemnified Party</strong>”, and collectively, the “    <strong>Indemnified Parties</strong>”) and keep each of the Indemnified
                                  Party indemnified from and against any and all claims, losses (including
                                  but not limited to, loss of profit), liabilities, obligations, penalties,
                                  fines, costs and expenses (including but not limited to, solicitors’ fees
                                  on a solicitor and client basis) (collectively, “<strong>claims</strong>”)
                                  arising in any way from: (i) your breach of any representation, warranty,
                                  obligation or covenant under these Terms for Buyers &amp; Sellers, Terms of
                                  Use, and other DBO Terms and Conditions; (ii) your gross negligence or
                                  wilful misconduct; (iii) any warranty, condition, representation, indemnity
                                  or guarantee relating to us and our related entities granted by you to any
                                  person, including but not limited to, the Buyers; (iv) any third party
                                  claim that the Product infringes the intellectual property or other rights
                                  of a third party; (v) the performance, non-performance or improper
                                  performance by you of the Contract; and (vi) any claim arising out of your
                                  misuse of the others’ data, or any violation of an applicable data privacy
                                  or security law.
                              </p>
                              <p>
                                  9.3. In the event of any breach or threatened breach by you of any
                                  provisions of these Terms for Buyers &amp; Sellers, in addition to all
                                  other rights and remedies available to us under these Terms for Buyers
                                  &amp; Sellers and under applicable law, we shall have the right to: (i)
                                  immediately cancel and terminate your Account; and (ii) be indemnified for
                                  any losses, damages or liability incurred by us in connection with such
                                  violation, in accordance with the provisions of this Clause 9.
                              </p>
                              <p>
                                  <strong>10. </strong>
                                  <strong>DISCLAIMER </strong>
                                  <strong>OF</strong>
                                  <strong> WARRANTY</strong>
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  10.1. The Platform, the Services, the tools provided to the Buyer and/or
                                  the Seller on the Platform and such other facilities as may be made
                                  available by us to the Buyer and/or the Seller are provided on an “as is”
                                  and “as available” basis. We make no representation, warranty, condition or
                                  undertaking of any kind, whether expressed or implied, including but not
                                  limited to, warranties of merchantability and fitness for a particular
                                  purpose. Without limiting the foregoing, we further disclaim all
                                  representations and warranties, express or implied, that the Platform, the
                                  Services, the tools provided to the Buyer and/or the Seller on the Platform
                                  and such other facilities as may be made available by us to the Buyer
                                  and/or the Seller satisfy all of your requirements and/or will be
                                  uninterrupted, error-free or free from harmful components.
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  <strong>11. </strong>
                                  <strong>LIMITATION OF LIABILITY </strong>
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  11.1. IN ADDITION TO AND NOT IN DEROGATION OF ANY OF THESE TERMS FOR BUYERS
                                  &amp; SELLERS, DBO, ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, CONTRACTORS
                                  AND ASSIGNS SHALL NOT IN ANY EVENT BE LIABLE TO YOU OR ANY OTHER PARTY
                                  HAVING ACCESS TO THE SERVICES AND/OR THE PLATFORM WHETHER WITH OR WITHOUT
                                  OUR CONSENT FOR ANY DIRECT, CONSEQUENTIAL, INCIDENTAL, SPECIAL OR INDIRECT
                                  LOSSES OR DAMAGES ARISING FROM, INTER ALIA, ANY DELAY OR DISRUPTION IN THE
                                  USE OF THE SERVICES AND/OR THE PLATFORM, NOTWITHSTANDING THAT WE HAVE BEEN
                                  ADVISED OF THE POSSIBILITY OF THE SAME.
                              </p>
                              <p>
                                  11.2. DBO, ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, CONTRACTORS AND
                                  ASSIGNS SHALL NOT BE LIABLE FOR ANY LOSS ARISING FROM A CAUSE OUTSIDE OUR
                                  REASONABLE CONTROL, ANY ACTION OR OMISSION BY THE RELEVANT AUTHORITIES IN
                                  EXERCISE OF THEIR REGULATORY OR SUPERVISORY FUNCTIONS, OR FOR FAILURE BY
                                  THE ELECTRONIC/TELECOMMUNICATION SERVICE PROVIDER OR ANY THIRD PARTY TO
                                  MEET ITS OBLIGATIONS TO YOU FOR ANY REASONS WHATSOEVER AND HOWEVER ARISING
                                  INCLUDING FAILURE OF ELECTRONIC OR MECHANICAL EQUIPMENT OR
                                  COMMUNICATION/TELEPHONE LINES OR OTHER INTERCONNECTED PROBLEMS,
                                  UNAUTHORISED ACCESS, THEFT, UNAUTHORISED USE OF PASSWORD, OPERATOR ERROR,
                                  WEATHER, EARTHQUAKES, STRIKES OR OTHER LABOUR PROBLEMS.
                              </p>
                              <p>
                                  11.3. DBO, ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, CONTRACTORS AND
                                  ASSIGNS SHALL NOT BE LIABLE TO YOU FOR ANY LOSSES WHATSOEVER OR HOWSOEVER
                                  CAUSED (REGARDLESS OF THE FORM OF ACTION) ARISING DIRECTLY OR INDIRECTLY IN
                                  CONNECTION WITH:
                              </p>
                              <p>
                                  (a) ANY ACCESS, USE AND/OR INABILITY TO USE THE PLATFORM OR THE SERVICES;
                              </p>
                              <p>
                                  (b) RELIANCE ON ANY DATA OR INFORMATION MADE AVAILABLE THROUGH THE PLATFORM
                                  AND/OR THROUGH THE SERVICES. YOU SHOULD NOT ACT ON SUCH DATA OR INFORMATION
                                  WITHOUT FIRST INDEPENDENTLY VERIFYING ITS CONTENTS;
                              </p>
                              <p>
                                  (c) ANY SYSTEM, SERVER OR CONNECTION FAILURE, ERROR, OMISSION,
                                  INTERRUPTION, DELAY IN TRANSMISSION, COMPUTER VIRUS OR OTHER MALICIOUS,
                                  DESTRUCTIVE OR CORRUPTING CODE, AGENT PROGRAM OR MACROS; AND
                              </p>
                              <p>
                                  (d) ANY USE OF OR ACCESS TO ANY OTHER WEBSITE OR WEBPAGE LINKED TO THE
                                  PLATFORM, EVEN IF WE OR OUR OFFICERS OR AGENTS OR EMPLOYEES MAY HAVE BEEN
                                  ADVISED OF, OR OTHERWISE MIGHT HAVE ANTICIPATED, THE POSSIBILITY OF THE
                                  SAME.
                              </p>
                              <p>
                                  11.4. TO THE EXTENT PERMITTED BY LAW, DBO, ITS OFFICERS, DIRECTORS,
                                  EMPLOYEES, AGENTS, CONTRACTORS AND ASSIGNS, OTHER MEMBERS OF OUR GROUP OF
                                  COMPANIES AND THIRD PARTIES CONNECTED TO US HEREBY EXPRESSLY EXCLUDE:
                              </p>
                              <p>
                                  a) ALL CONDITIONS, WARRANTIES AND OTHER TERMS WHICH MAY OTHERWISE BE
                                  IMPLIED BY STATUTE, COMMON LAW OR THE LAW OF EQUITY;
                              </p>
                              <p>
                                  b) ALL LIABILITY IN RESPECT OF:
                              </p>
                              <p>
                                  i. THE ACCURACY, COMPLETENESS, FITNESS FOR PURPOSE OR LEGALITY OF ANY
                                  INFORMATION ACCESSED USING THE SERVICES, PLATFORM OR OTHERWISE;
                              </p>
                              <p>
                                  ii. THE TRANSMISSION OR THE RECEPTION OF OR THE FAILURE TO TRANSMIT OR TO
                                  RECEIVE ANY MATERIAL OF WHATEVER NATURE; AND
                              </p>
                              <p>
                                  iii. YOUR USE OF ANY INFORMATION OR MATERIALS ON THE PLATFORM (WHICH IS
                                  ENTIRELY AT YOUR OWN RISK AND IT IS YOUR RESPONSIBILITY);
                              </p>
                              <p>
                                  c) ANY LIABILITY FOR:
                              </p>
                              <p>
                                  i. LOSS OF INCOME OR REVENUE;
                              </p>
                              <p>
                                  ii. LOSS OF BUSINESS;
                              </p>
                              <p>
                                  iii. LOSS OF CONTRACTS;
                              </p>
                              <p>
                                  iv. LOSS OF ACTUAL AND/OR ANTICIPATED PROFITS;
                              </p>
                              <p>
                                  v. LOSS OF USE OF MONEY;
                              </p>
                              <p>
                                  vi. LOSS OF ANTICIPATED SAVINGS;
                              </p>
                              <p>
                                  vii. LOSS OF OPPORTUNITY;
                              </p>
                              <p>
                                  viii. LOSS OF, DAMAGE TO OR CORRUPTION OF DATA;
                              </p>
                              <p>
                                  ix. LOSS OF GOODWILL AND/OR REPUTATION;
                              </p>
                              <p>
                                  x. WASTED MANAGEMENT OR OFFICE TIME; AND
                              </p>
                              <p>
                                  xi. FOR ANY OTHER LOSS OR DAMAGE OF ANY KIND, HOWEVER ARISING AND WHETHER
                                  CAUSED BY TORT (INCLUDING NEGLIGENCE), BREACH OF CONTRACT OR OTHERWISE,
                                  EVEN IF FORESEEABLE.
                              </p>
                              <p>
                                  11.5. YOU ACKNOWLEDGE AND AGREE THAT YOUR ONLY RIGHT WITH RESPECT TO ANY
                                  PROBLEMS OR DISSATISFACTION WITH THE SERVICES IS TO DISCONTINUE ANY USE OF
                                  THE SERVICES.
                              </p>
                              <p>
                                  11.6. IF, NOTWITHSTANDING THE PREVIOUS SECTIONS, WE ARE FOUND BY A COURT OF
                                  COMPETENT JURISDICTION TO BE LIABLE (INCLUDING FOR GROSS NEGLIGENCE), THEN,
                                  TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, ITS LIABILITY TO YOU OR
                                  TO ANY THIRD PARTY IS LIMITED TO RM100 (RINGGIT MALAYSIA ONE HUNDRED ONLY),
                                  OR WHERE A MINIMUM COMPENSATION IS DESIGNATED UNDER THE APPLICABLE LAW,
                                  SUCH MINIMUM COMPENSATION SHALL APPLY.
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  <strong>12. </strong>
                                  <strong>SEVERANCE</strong>
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  12.1. If any of these Terms for Buyers &amp; Sellers shall be held to be
                                  illegal, invalid or unenforceable, in whole or in part, the provision shall
                                  apply with whatever deletion or modification is necessary so that the
                                  provision is legal, valid and enforceable and gives effect to the
                                  commercial intention of the parties. To the extent it is not possible to
                                  delete or modify the provision, in whole or in part, under this Clause
                                  12.1, then such provision or part of it shall, to the extent that it is
                                  illegal, invalid or unenforceable, be deemed not to form part of these
                                  Terms for Buyers &amp; Sellers and the legality, validity and
                                  enforceability of the remainder of these Terms for Buyers &amp; Sellers
                                  shall, subject to any deletion or modification made under this Clause 12.1,
                                  not be effected.
                              </p>
                              <p>
                                  <strong>13. </strong>
                                  <strong>SEVERAL PERSONS</strong>
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  13.1. If there are two or more persons adhering to these Terms for Buyers
                                  &amp; Sellers, whether as Buyer or Seller, their liability under these
                                  Terms for Buyers &amp; Sellers is joint and several, and their rights are
                                  joint.
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  <strong>14. </strong>
                                  <strong>WAIVERS</strong>
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  14.1. No failure or delay by us to exercise any right or remedy provided
                                  under these Terms for Buyers &amp; Sellers or by law shall constitute a
                                  waiver of that or any other right or remedy, nor shall it prevent or
                                  restrict the further exercise of that or any other right or remedy. No
                                  single or partial exercise of such right or remedy shall prevent or
                                  restrict the further exercise of that or any other right or remedy.
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  <strong>15. </strong>
                                  <strong>GOVERNING LAW </strong>
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  15.1. These Terms for Buyers &amp; Sellers shall be governed by, and
                                  construed in accordance with, the Malaysian law. Unless otherwise required
                                  by applicable laws, any dispute, controversy, claim or difference of any
                                  kind whatsoever shall arising out of or relating to these Terms for Buyers
                                  &amp; Sellers against or relating to DBO or any Indemnified Party under
                                  these Terms for Buyers &amp; Sellers shall be referred to and settled by
                                  arbitration in accordance with the Arbitration Rules of the Asian
                                  International Arbitration Centre held in Kuala Lumpur, Malaysia. The
                                  arbitral tribunal shall consists of a sole arbitrator who is legally
                                  trained and who has experience in the information technology field in
                                  Malaysia and is independent of either party. The place of arbitration shall
                                  be Malaysia. Any award by the arbitration tribunal shall be final and
                                  binding upon the parties.
                              </p>
                              <p>
                                  15.2. Notwithstanding the foregoing, DBO reserves the right to pursue the
                                  protection of intellectual property rights and confidential information
                                  through injunctive or other equitable relief through the courts.
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  <strong>16. </strong>
                                  <strong>COMPETITIVE OR SIMILAR MATERIALS</strong>
                              </p>
                              <p>
                                  <strong> </strong>
                              </p>
                              <p>
                                  16.1. You, in particular the Seller, hereby acknowledge and agree that we
                                  are not precluded from discussing, viewing, developing for ourselves,
                                  having developed, acquiring, licensing or developing for or by third
                                  parties, as well as marketing and distributing materials, products which
                                  are competitive with your Products, regardless of their similarity to your
                                  Products.
                              </p>

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
                          <label class="float-left">Company Name: <small class="text-danger">*</small></label>
                          <input class="@error('name') is-invalid @enderror" value="{{ old('name') }}"
                                 title="Please enter company name" required type="text" name="name"
                                 placeholder="Please enter company name" />
                          <div class="errorTxt"></div>
                          @error('name')
                            <span class="invalid-feedback text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
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

                          <label class="float-left">{{ __('Address') }} <small class="text-danger">*</small></label>
                          <input class="@error('street') is-invalid @enderror" required name="street" type="text"
                                 value="{{old('street')}}" placeholder="Please Enter Company Address"
                                 title="Please Enter Company Address">
                          <div class="errorTxt"></div>
                          @error('street')
                          <span class="invalid-feedback text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                  <label class="float-left">{{ __('Postal Code') }}: <small class="text-danger">*</small></label>
                                  <input class="@error('postal_code') is-invalid @enderror" title="Please enter valid Postal Code" required number name="postal_code"
                                         type="text" value="{{old('postal_code')}}" placeholder="{{ __('Please enter valid Postal Code') }}">
                                  <div class="errorTxt"></div>
                                  @error('postal_code')
                                     <span class="invalid-feedback text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                              </div>
                              <div class="form-group col-md-6">
                                  <label class="float-left">{{ __('City') }}: <small class="text-danger">*</small></label>
                                  <input class="@error('city') is-invalid @enderror" title="Please enter City" required name="city"
                                         type="text" value="{{old('city')}}" placeholder="{{ __('Please enter City') }}">
                                  <div class="errorTxt"></div>
                                  @error('city')
                                  <span class="invalid-feedback text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                              </div>
                          </div>
                          <input type="hidden" name="country_id" value="1">
                          <div class="form-group">
                              <label class="float-left">{{ __('State') }}: <small class="text-danger">*</small></label>
                              <select title="Please select State" required name="state_id"
                                      class="@error('state_id') is-invalid @enderror form-control select2" id="state_id">
                                  <option value="">Please select state</option>
                                  @foreach($state as $s)
                                      <option value="{{$s->id}}" /> {{$s->name}} </option>
                                  @endforeach
                              </select>
                              <div class="errorTxt"></div>
                              @error('state_id')
                              <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                          <div class="form-group">
                              <label>{{ __('Company logo') }}:</label>
                              <br>
                              <input type="file" name="logo" accept="image/png, image/jpeg" class="form-control @error('logo') is-invalid @enderror">
                              @error('logo')
                              <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                          <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                          <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>
                          <fieldset>
                              <h2 class="fs-title">Business Information</h2>
                              <h3 class="fs-subtitle">Pleese fill up business information for your company.</h3>
                              <hr>

                              <br>
                              <h3 class="fs-title">SSM Documents</h3>
                              <div class="form-row">
                                  @foreach($doc_types as $doc_type)
                                      <div class="col-md-4">
                                          <label style="font-weight: 700">{{ __($doc_type->name) }}</label>

                                          <input id="file_{{ $doc_type->id }}" accept="image/png, image/jpeg, application/pdf" type="file"
                                                 class="form-control @error('file.' .$doc_type->id) is-invalid @enderror"
                                                 value="{{ old('file') ? old('file')[$doc_type->id] : null }}" name="file[{{ $doc_type->id }}]" autofocus />
                                          @error('file.' . $doc_type->id)
                                          <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
                                          @enderror
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
                                  <input pattern="[0-9]+" title="Invalid SST number" type="text" name="sst_no"
                                         value="{{old('sst_no')}}" placeholder="{{ __('Please enter SST number') }}">
                              </div>
                              <div class="form-row">
                                  @foreach($doc_type_sst as $doc_type)
                                      <div class="col-md-4">
                                          <label style="font-weight: 700">{{ __($doc_type->name) }}</label>
                                          <input id="sstfile_{{ $doc_type->id }}" accept="image/png, image/jpeg, application/pdf" type="file"
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
