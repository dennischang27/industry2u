@extends('layouts.app')

@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' Terms Of Use') }}</title>
@endsection

@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>TERMS OF USE</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <meta itemprop="position" content="1">
                            <a href="{{route("home")}}" itemprop="item" title="Home">
                                Home
                                <meta itemprop="name" content="Home">
                            </a>
                        </li>
                        <li class="breadcrumb-item active">TERMS OF USE</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <ol>
                    <li><strong>GENERAL</strong></li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>Welcome to Industry2u (&ldquo;<strong>Platform</strong>&rdquo;). This Platform is owned and
                        operated by Digital BlueOcean Berhad. Please read the following terms and conditions carefully
                        before using this Platform and/or opening an Account so that you are aware of your legal rights
                        and obligations with respect to Digital BlueOcean Berhad and its affiliates and subsidiaries
                        (individually and collectively, &ldquo;<strong>DBO</strong>&rdquo;, &ldquo;<strong>we</strong>&rdquo;,
                        &ldquo;<strong>us</strong>&rdquo;, &ldquo;<strong>our</strong>&rdquo; or
                        &ldquo;<strong>ours</strong>&rdquo;). Your access to and use of this Platform and Services made
                        available via the Platform are subject to the terms of a legal agreement between you and us.
                        This page explains how the agreement is made up, and sets out some of the terms of that
                        agreement. Your agreement with us will always include, at a minimum, the terms and conditions
                        set out in this page (&ldquo;<strong>Terms of Use</strong>&rdquo;). Your agreement with us will
                        also include the terms of: (a) Privacy Policy; (b) Terms for Buyers &amp; Sellers; and (c) any
                        and all other terms, policies, procedures, guidelines, rules, directives and/or instructions of
                        whatsoever nature presently and from time to time issued, given, made and/or established by us
                        via the Platform (terms of (a), (b) and (c) are collectively referred to as the &ldquo;<strong>Additional
                            Terms</strong>&rdquo;), in addition to the Terms of Use herein. The Terms of Use and the
                        Additional Terms are collectively referred to as &ldquo;<strong>DBO Terms and
                            Conditions</strong>&rdquo;, and the DBO Terms and Conditions constitute the aforesaid
                        agreement between you and DBO.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You are advised to seek independent legal and professional advice in understanding and
                        evaluating whether to accept these Terms of Use, Additional Terms and/or DBO Terms and
                        Conditions. Before becoming a user of the Platform (&ldquo;<strong>User</strong>&rdquo;), you
                        must read and accept all of the Terms of Use, Additional Terms and/or DBO Terms and Conditions.
                        If you do not agree with any of these Terms of Use, Additional Terms and/or DBO Terms and
                        Conditions, you shall cease using the Platform and the Services immediately.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>We reserve the right to amend, change, modify, add or remove portions of these Terms of Use,
                        Additional Terms and/or DBO Terms and Conditions at any time. Such changes/amendments could be
                        posted online and shall be effective when posted on the Platform with no other notices provided.
                        You are responsible to regularly review information posted on the Platform to obtain timely
                        notice of such changes/amendments and you are deemed to be aware of and bound by any changes to
                        the foregoing upon their publication on the Platform. If you do not wish to be bound by these
                        amended Terms of Use, Additional Terms and/or DBO Terms and Conditions, you shall cease using
                        the Platform and the Services immediately. However, your continue use of the Platform and/or the
                        Services after the changes/amendments are made will be deemed to constitute acceptance of the
                        amended Terms of Use, Additional Terms and DBO Terms and Conditions.
                    </li>
                </ul>
                <p>BY USING SERVICES OR OPENING AN ACCOUNT, YOU GIVE YOUR IRREVOCABLE ACCEPTANCE OF AND CONSENT TO THE
                    TERMS OF THIS AGREEMENT, INCLUDING THESE TERMS OF USE, TERMS FOR BUYERS &amp; SELLERS, ADDITIONAL
                    TERMS, DBO TERMS AND CONDITIONS AND POLICIES REFERENCED HEREIN AND/OR LINKED HERETO. IF YOU DO NOT
                    AGREE TO ANY OF THESE TERMS OF USE, TERMS FOR BUYERS &amp; SELLERS, ADDITIONAL TERMS OR THE DBO
                    TERMS AND CONDITIONS, PLEASE DO NOT USE OUR SERVICES OR ACCESS THE PLATFORM. IF YOU ARE UNDER THE
                    AGE OF 18 OR THE LEGAL AGE FOR GIVING CONSENT HEREUNDER PURSUANT TO THE APPLICABLE LAWS IN YOUR
                    COUNTRY, YOU MUST OBTAIN PERMISSION FROM YOUR PARENT(S) OR LEGAL GUARDIAN(S) TO OPEN AN ACCOUNT ON
                    THE PLATFORM. IF YOU ARE THE PARENT OR LEGAL GUARDIAN OF A MINOR WHO IS CREATING AN ACCOUNT, YOU
                    MUST ACCEPT AND COMPLY WITH THE TERMS OF THIS AGREEMENT ON THE MINOR'S BEHALF AND YOU WILL BE
                    RESPONSIBLE FOR THE MINOR&rsquo;S ACTIONS, ANY CHARGES ASSOCIATED WITH THE MINOR&rsquo;S USE OF THE
                    PLATFORM AND/OR SERVICES OR PURCHASES MADE ON THE PLATFORM. IF YOU DO NOT HAVE CONSENT FROM YOUR
                    PARENT(S) OR LEGAL GUARDIAN(S), YOU MUST STOP USING/ACCESSING THIS PLATFORM AND/OR SERVICES.</p>
                <ol start="2">
                    <li><strong>DEFINITIONS</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>The following expressions shall have the following meanings respectively ascribed to them,
                        unless specified otherwise:
                    </li>
                </ul>
                <p>&nbsp;</p>
                <table class="table-responsive">
                    <tbody>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Account</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>includes User Account, Corporate Account and such other accounts as may be registered
                                with us, and shall mean an account which you may be required to create and registered on
                                the Platform in order to access and utilise certain facilities and features of the
                                Platform;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Additional Terms</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall have the meaning ascribed to it in Clause 1.1;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>AMLA Laws</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>means the Malaysian Anti-Money Laundering, Anti-Terrorism Financing and Proceeds of
                                Unlawful Activities Act 2001 and such other laws relating to terrorism financing or
                                money laundering；</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>&ldquo;<strong>Buyer</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall be a User of the Platform and shall have the meaning ascribed to it in Clause
                                3.1;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Corporate Account</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall mean an Account created on the Platform and registered with us by a
                                corporate/business entity in order to access and utilise facilities and features of the
                                Platform which enables it to be a Buyer and/or a Seller on the Platform;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>DBO Terms and Conditions</strong>&rdquo;</p>
                            <p>&nbsp;</p>
                        </td>
                        <td>
                            <p>shall have the meaning ascribed to it in Clause 1.1;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Password</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall have the meaning ascribed to it in Clause 6.3;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Payable Fees</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall have the meaning ascribed to it in Clause 12.2;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Platform</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>means any of DBO&rsquo;s website(s) and subdomain thereof, and its related mobile
                                applications, related databases and supporting software to which the Users are entitled
                                to access or use the Services provided by DBO;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Product</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall have the meaning ascribed to it in Clause 3.1;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Seller</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall be a User of the Platform and shall have the meaning ascribed to it in Clause
                                3.1;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Services</strong>&rdquo;</p>
                            <p>&nbsp;</p>
                        </td>
                        <td>
                            <p>means the facility provided by DBO through the Platform, including the services as set
                                out in Clause 3.1;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Submitted Content</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall have the meaning ascribed to it in Clause 8.4;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Tax Amount</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall have the meaning ascribed to it in Clause 12.1;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Transaction Fee</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall have the meaning ascribed to it in Clause 12.1;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>Third Party Sites</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall have the meaning ascribed to it in Clause 14.2;</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>User</strong>&rdquo;, &ldquo;<strong>you</strong>&rdquo; and
                                &ldquo;<strong>your</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>means a person who accesses, uses, and/or participates in the Platform in any manner,
                                whether as a Buyer or Seller, and shall have the meaning ascribed to it in Clause 1.2;
                                and</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <p>&ldquo;<strong>User Account</strong>&rdquo;</p>
                        </td>
                        <td>
                            <p>shall mean an Account created on the Platform and registered with us in order to access
                                and utilise certain facilities and features of the Platform, other than those related to
                                the buying and selling.</p>
                            <p>&nbsp;</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p>&nbsp;</p>
                <ul>
                    <li>In these Terms of Use:</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>references to a statutory provision including any subsidiary legislation made from time to time
                        under that provision;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>references to a statute or statutory provision include that statute or provision as from to time
                        modified, re-enacted or consolidated, whether before or after the date of the DBO Terms and
                        Conditions, so far as such modification, re-enactment or consolidation applies or is capable of
                        applying to any transaction entered into in accordance with the DBO Terms and Conditions and (so
                        far as liability thereunder may exist or can arise) shall include also any past statute or
                        statutory provision (as from time to time modified, re-enacted or consolidated) which such
                        statute or provision has directly or indirectly replaced;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>where the context requires, and the law permits, references to &ldquo;<strong>DBO</strong>&rdquo;,
                        &ldquo;<strong>we</strong>&rdquo;, &ldquo;<strong>us</strong>&rdquo;,
                        &ldquo;<strong>our</strong>&rdquo; or &ldquo;<strong>ours</strong>&rdquo; shall include
                        subsidiaries or related companies of Digital BlueOcean Berhad (as defined under the Companies
                        Act 2016);
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>unless a contrary indication appears, a reference in the DBO Terms and Conditions to
                        &ldquo;<strong>including</strong>&rdquo; shall not be construed restrictively but shall mean
                        &ldquo;<strong>including but without prejudice to the generality of the foregoing</strong>&rdquo;
                        and &ldquo;<strong>including, but without limitation</strong>&rdquo;;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>unless the context otherwise requires or permits, references to the singular number shall
                        include references to the plural number and vice versa; references to natural persons shall
                        include bodies corporate and vice versa; and words denoting any gender shall include all
                        genders;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>the expression &ldquo;<strong>person</strong>&rdquo; means any individual, corporation,
                        partnership, association, limited liability company, trust, governmental or quasi-governmental
                        authority or body or other entity or organisation;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>the headings and titles for each clause are purely for ease of reference and do not form part of
                        or affect the interpretation of the DBO Terms and Conditions; and
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>the tables and samples are purely for ease of reference, illustrative purposes, meant to provide
                        general guidelines only and actual information, performance and result may be different.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="3">
                    <li><strong>SERVICES</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>We provide the Services through the Platform which include the following:</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>providing a platform whereby the seller (&ldquo;<strong>Seller</strong>&rdquo;) may track and
                        monitor the sales of the goods, products, items and/or equipment
                        (&ldquo;<strong>Product</strong>&rdquo;) that the Seller supplies/sells to the buyer
                        (&ldquo;<strong>Buyer</strong>&rdquo;) through the Platform;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>accepting the Buyers&rsquo; requests and disseminating them to the Sellers;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>facilitating the Sellers to render quotations to the Buyers;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>facilitating the Sellers and the Buyers to make contact; and</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>any other facilities that may be introduced and made available by us via the Platform from time
                        to time at our sole and absolute discretion.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You acknowledge and understand that:</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>DBO is not itself a Buyer or a Seller and the actual contract for sale/supply is directly
                        between the Buyer and the Seller and DBO is not a party to that or any other contract between
                        the Buyer and the Seller. Further, DBO cannot ensure that the Buyer and Seller will actually
                        complete a transaction; and
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>the Platform is to facilitate the communication between the Buyer and the Seller, and there are
                        security, confidentiality and other risks in the use of the Services and the internet which may
                        be beyond our reasonable control and that, by electing to use and communicate through the
                        Services and the internet, you accept that all communications via the Platform are made at your
                        sole risk.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <p>As a result, DBO has no control over the quality, safety or legality of the Products, the truth or
                    accuracy of the listings, the ability of Sellers to sell the Products, or the ability of Buyers to
                    buy the Products. DBO cannot and do not control whether or not Sellers will complete the sale of the
                    Products they offer or whether Buyers will complete the purchase of Products they have purchased.
                    Further, as DBO is not involved in dealings between the Users, you agree to and do hereby release
                    DBO from claims, demands and damages in connection with such dealings, including without limitation
                    related to Products listed, sold, or purchased or the User&rsquo;s inability to complete a purchase
                    or a sale of any Product.</p>
                <p>&nbsp;&nbsp;</p>
                <ul>
                    <li>We reserve the right to change, modify, update, suspend or discontinue all or any part of this
                        Platform or the Services at any time and without notice, or where relevant, upon notice as
                        required by local laws and shall not be liable if any such upgrade, modification, suspension or
                        removal prevents you from accessing the Platform or any part of the Services. We may also impose
                        limits on certain features, restrict or disallow your access to parts of, or the entire,
                        Platform or Services in our sole discretion and without notice or liability.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>We reserve the right to refuse to provide you access to the Platform and/or the Services, or to
                        refuse to allow you to open an Account for any reason.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>For the avoidance of doubt, any new features added to or augmenting the Services are also
                        subject to these Terms of Use.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="4">
                    <li><strong>COMPUTER PROGRAMME</strong></li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>Any application, solution, software, system or such other computer program as may be provided by
                        us to you as part of the Services is subject to the provisions of these Terms of Use. We reserve
                        all rights to such computer program not expressly granted by us hereunder.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="5">
                    <li><strong>ACCESSING THE PLATFORM</strong></li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>You are responsible for making all arrangements necessary for you to have access to this
                        Platform. We shall not be liable for any telephone costs, telecommunications costs or other
                        costs that you may incur in connection with the same. You are also responsible for ensuring that
                        all persons who access this Platform through your internet connection are aware of the DBO Terms
                        and Conditions, and that they comply with them.
                    </li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ol start="6">
                    <li><strong>ACCOUNT AND SECURITY</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>You may not need to create and register with us, an account on the Platform (&ldquo;<strong>Account</strong>&rdquo;)
                        to use some of the functionality of the Platform or Services. However, certain Services and
                        features on the Platform may require registration and creation of an Account with us. For
                        instance, in order to transact via the Platform whether as a Buyer or a Seller, you would be
                        required to create a Corporate Account with us.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>To register, you would need to supply us with, in respect of the setting up of a User Account,
                        your name, national registration identity number, passport number, contact details, email
                        address, payment details, and such other personal information and documents as we may require
                        from time to time, and in respect of the setting up of a Corporate Account, particulars of the
                        business/corporate entity (e.g. company name, company number, etc), a copy each of the corporate
                        secretarial documents (e.g. the forms filed with the Companies Commission of Malaysia),
                        particulars of the banking account, SST registration number, and such other information and
                        documents relating to the business/corporate entity as we may require from time to time. You
                        agree to provide true, accurate, current and complete information and maintain up-to-date
                        information which is true, accurate, current and complete at all times by making changes,
                        additions or deletions to your Account, as required. In addition, you agree that any and all
                        such information you provide to us, other members of our group of companies and third parties
                        connected to us via the Platform may be collected, stored, processed and used in accordance with
                        our Privacy Policy. By using the Platform and/or Services, you have consented to such processing
                        and you warrant that you have the requisite rights in providing the information and all data
                        provided by you is accurate and to notify us (either by the Platform or by emails) if there are
                        any changes.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>When you register with us, you will choose a username and password that is unique to your
                        Account. You must treat such information as confidential, and you must not disclose it to any
                        third party. Similarly, you shall never use another person's Account without permission. You
                        agree that you will not misrepresent yourself or represent yourself as another User of the
                        Platform and/or the Services offered through the Platform. You are responsible for safeguarding
                        the password that you use to access the Platform (&ldquo;<strong>Password</strong>&rdquo;) and
                        for any activities or actions that occur under your Account or Password, and we may rightfully
                        assume that any person using the Platform with your user name and Password is you. In this
                        regard, you agree that:
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>no claims shall be made by you or on your behalf in respect to any losses, costs and expenses
                        incurred by you as a result of such unauthorised usage;
                    </li>
                </ul>
                <p>&nbsp;&nbsp;</p>
                <ul>
                    <li>you are fully responsible for all activities that occur under your Account even if such
                        activities or uses were not committed by you; and
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>we shall not be liable for any loss or damage arising from unauthorised use of your Password or
                        your failure to comply with this provision.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You may be able to use your Account to gain access to other products, websites or services to
                        which we have enabled access or with which we have tied up or collaborated. We have not
                        reviewed, and we assume no responsibility for any third party content, functionality, security,
                        services, privacy policies or other practices of those products, websites or services. If you
                        gain such access to third party&rsquo;s products, websites or services, the terms of service for
                        these products, websites or services, including their respective privacy policies, if different
                        from the DBO Terms and Conditions, may also apply to your use of these products, websites or
                        services.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You agree that we may for any reason, in our sole discretion and with or without notice or
                        liability to you or any third party, immediately terminate your Account, remove or discard from
                        the Platform any content associated with your Account, withdraw any subsidies, referral rewards
                        or benefits offered and/or granted to you, cancel any transactions associated with your Account,
                        temporarily withhold any sale proceeds or refunds, and/or take any other actions that we deem
                        necessary. Grounds for such actions may include, but are not limited to, actual or suspected (a)
                        extended periods of inactivity; (b) violation of the letter or spirit of these Terms of Use
                        and/or DBO Terms and Conditions; (c) illegal, fraudulent, harassing, defamatory, threatening or
                        abusive behaviour; (d) having multiple Accounts; or (e) any behaviour, which in our view, that
                        is harmful to other Users, third parties, or the business interests of DBO. Use of an Account
                        for illegal, fraudulent, harassing, defamatory, threatening or abusive purposes may be referred
                        to law enforcement authorities without notice to you. If a legal dispute arises or law
                        enforcement action is commenced relating to your Account or your use of the Services for any
                        reason, we may terminate your Account immediately with or without notice.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>We have the absolute right to disable, suspend or terminate any Password and/or Account if, in
                        our opinion:
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>we find your username to be offensive or inappropriate; or</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>you have failed to comply with any of the provisions of the DBO Terms and Conditions.</li>
                </ul>
                <p>&nbsp;</p>
                <ol start="7">
                    <li><strong>LIMITED LICENSE</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>DBO grants you a limited, non-exclusive and revocable license to access and use the Services
                        subject to these Terms of Use, and the DBO Terms and Conditions. All proprietary content,
                        trademarks, service marks, brand names, logos and other intellectual property (&ldquo;<strong>Intellectual
                            Property</strong>&rdquo;) displayed on the Platform are the property of DBO and where
                        applicable, third party proprietors identified on the Platform. No right or licence is granted
                        directly or indirectly to any party accessing the Platform to use or reproduce any Intellectual
                        Property, and no party accessing the Platform shall claim any right, title or interest therein.
                        By using or accessing the Services you agree to comply with the copyright, trademark, service
                        mark, and all other applicable laws that protect the Services, the Platform and its content. You
                        agree not to copy, distribute, republish, transmit, publicly display, publicly perform, modify,
                        adapt, rent, sell, or create derivative works of any portion of the Services, the Platform or
                        its content. You also may not, without our prior written consent, mirror or frame any part or
                        whole of the contents of this Platform on any other server or as part of any other website. In
                        addition, you agree that you will not use any robot, spider, offline reader, scraper or any
                        other automatic device or manual process to monitor or copy our content, without our prior
                        written consent.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>The license for use of this Platform and/or the Services is effective until terminated. This
                        license will terminate as set forth under these Terms of Use and DBO Terms and Conditions, or if
                        you fail to comply with any provision of these Terms of Use and DBO Terms and Conditions. In
                        such event, we may effect such termination with or without notice to you.
                    </li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ol start="8">
                    <li><strong>USER OBLIGATIONS</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>Without limitation, you undertake not to use or permit anyone else to use the Services and/or
                        the Platform:
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>in breach of any applicable laws or regulations;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>in a manner that:</li>
                </ul>
                <p>&nbsp;</p>
                <ol>
                    <li>may unreasonably encumber or impose an unreasonable or disproportionately large load on, in our
                        sole discretion, the Platform&rsquo;s infrastructure;
                    </li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>may interfere or attempt to interfere with the proper working of the Platform or any third-party
                        participation in the Platform; or
                    </li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>may bypasses our measures that are used to prevent or restrict access to the Platform;</li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>to collect or harvest any personally identifiable data, including without limitation, names or
                        other Account information, from the Platform, nor to use the communication systems provided by
                        the Platform for any commercial solicitation purposes;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>to send or receive any material which is not civil or tasteful;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>to send or receive any material which is threatening, grossly offensive, of an indecent, obscene
                        or menacing character, blasphemous or defamatory of any person, in contempt of court or in
                        breach of confidence, copyright, rights of personality, publicity or privacy or any other third
                        party rights;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>to send or receive any material for which you have not obtained all necessary licences and/or
                        approvals (from us or third parties); or which constitutes or encourages conduct that would be
                        considered an unlawful activity, a criminal offence, give rise to civil liability, or otherwise
                        be contrary to the law of or infringe the rights of any third party in any country in the world,
                        including but not limited to, fraud, money laundering and terrorist financing;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>to transmit, distribute a virus on the Platform which is malicious, technologically harmful
                        (including computer viruses, logic bombs, Trojan horses, worms, harmful components, corrupted
                        data or other malicious software or harmful data), in breach of confidence or in any way
                        offensive or obscene, corrupt data, cause annoyance to other Users, infringe upon the rights of
                        any other person&rsquo;s proprietary rights or send any unsolicited advertising or promotional
                        material;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>to cause annoyance, inconvenience or needless anxiety;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>to intercept or attempt to intercept any communications transmitted by way of a
                        telecommunications system;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>to attempt to decompile, reverse engineer, disassemble or hack the Services (or any portion
                        thereof), or to defeat or overcome any encryption technology or security measures implemented by
                        us with respect to the Services and/or data transmitted, processed or stored by us;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>for any fraudulent purpose;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>other than in conformance with accepted internet practices and practices of any connected
                        networks;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>in any way which is calculated to incite hatred against any ethnic, religious or any other
                        minority or is otherwise calculated to adversely affect any individual, group or entity; or
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>for a purpose other than which we have designed them or intended them to be used.</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You also represent that:</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>neither you nor, to your knowledge, that any of the funds, money, and/or financial transaction
                        made and/or received by using our Services and/or the Platform is in violation in any AMLA Laws;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>you do not conduct any business or engage in making or receiving any contribution of funds,
                        goods or services to or for the benefit of any person or through person prohibited under AMLA
                        Laws;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>you do not deal in, or otherwise engage in any transactions relating to, any property or
                        interests in property blocked pursuant to AMLA Laws; or
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>you do not engage in or conspire to engage in any transaction that evades or avoids, or has the
                        purpose of evading or avoiding, or attempts to violate, any of the prohibitions set forth in any
                        AMLA Laws.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>Other than those stated in Clause 8.1, the following use of the Services and/or Platform are
                        expressly prohibited and you undertake not to do (or to permit anyone else to do) any of the
                        following:
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>furnishing false data including false names, addresses and contact details and fraudulent use of
                        credit/debit card numbers;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>attempting to circumvent our security or network including accessing data not intended for you,
                        logging into a server or account you are not expressly authorised to access, or probing the
                        security of other networks;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>executing any form of network monitoring which will intercept data not intended for you;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>sending malicious email, including flooding a user or site with very large or numerous emails;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>removing any proprietary notices from the Platform;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>uploading, emailing, posting, transmitting or otherwise making available any content that you do
                        not have a right to make available under any law or under contractual or fiduciary relationships
                        (such as inside information, proprietary and confidential information learned or disclosed as
                        part of employment relationships or under non-disclosure agreements);
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>uploading, emailing, posting, transmitting or otherwise making available any content that
                        infringes any proprietary rights of any person;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>uploading, emailing, posting, transmitting or otherwise making available any content that
                        contains falsehoods or misrepresentations that could damage DBO or any third party;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>uploading, emailing, posting, transmitting or otherwise making available any unsolicited or
                        unauthorised advertising, promotional materials, junk mail, spam, chain letters, pyramid schemes
                        or any other unauthorised form of solicitation;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>advertising or soliciting a business not related to or not appropriate for the Platform, as
                        determined by DBO in its sole discretion;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>causing, permitting or authorising the modification, creation of derivative works, or
                        translation of the Services without the consent of DBO;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>using the Services or uploading any content to impersonate any person or entity, or otherwise
                        misrepresent your affiliation with a person or entity;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>using the Services for the benefit of any third party or any manner not permitted by the
                        licenses granted herein;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>using the Services or upload content in a manner that is fraudulent, unconscionable, false,
                        misleading or deceptive;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>opening and/or operating multiple user Accounts in connection with any conduct that violates
                        either the letter or spirit of these Terms of Use, and/or DBO Terms and Conditions;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>manipulating the price of any Products or interfere with the other Users&rsquo; listings;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>taking any action that may undermine the feedback or rating system;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>uploading, posting, transmitting or otherwise making available any content featuring an
                        unsupervised minor or using the Services to harm minors in any way;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>entering into fraudulent interactions or transactions via the Platform (which shall include
                        entering into interactions or transactions purportedly on behalf of a third party where you have
                        no authority to bind that third party or you are pretending to be a third party);
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>using the Platform and/or the Services (or any relevant functionality of either of them) in
                        breach of the DBO Terms and Conditions;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>engaging in any unlawful activity in connection with the use of the Platform and/or the
                        Services; or
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>engaging in any conduct which, in our opinion, restricts or inhibits any other users from
                        properly using or enjoying the Platform and/or the Services.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You understand that all content, whether public posted, privately transmitted or provided to us,
                        is the sole responsibility of the person from whom such content originated. This also means that
                        you are solely and fully responsible for the content that is uploaded, posted, transmitted or
                        otherwise made available by you on the Platform (&ldquo;<strong>Submitted Content</strong>&rdquo;)
                        and the consequences of posting or publishing it. You agree to indemnify and hold us, our
                        owners, members, managers, operators, directors, officers, agents, affiliates, and/or licensors,
                        harmless to the fullest extent allowed by law regarding all matters related to your Submitted
                        Content. You understand that by using the Platform, you may be exposed to the Content that you
                        may consider to be offensive, indecent or objectionable. To the maximum extent permitted by the
                        applicable laws, under no circumstances will we be liable in any way for any content, including
                        but not limited to, any errors or omissions in any content, or any loss or damage of any kind
                        incurred as a result of the use of, or reliance on, any content posted, emailed, transmitted or
                        otherwise made available on the Platform.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You hereby affirm, represent, and/or warrant that:</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>you own or have the necessary licenses, rights, consents, and permissions to use and authorize
                        DBO to use all patent, trademark, trade secret, copyright or other proprietary rights in and to
                        any and all Submitted Content;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>you have the written consent, release, and/or permission of each and every identifiable
                        individual person in the Submitted Content to use the name or likeness of each and every such
                        identifiable individual person; and
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>you agree to pay for all royalties, fees, and any other monies owing any person by reason of any
                        Submitted Content posted by you to or through the Platform.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You understand and agree that we may, in our sole discretion and without incurring any
                        liability, review and delete or remove any Submitted Content that violates these Terms of Use,
                        or DBO Terms and Conditions or which might be offensive, illegal, or that might violate the
                        rights, harm, or threaten the safety of Users or others.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You retain all of your ownership rights in your Submitted Content. By making the Submitted
                        Content, you represent and warrant that you have all necessary rights and/or permissions to
                        grant the licenses below to us. You further acknowledge and agree that you are solely
                        responsible for anything you post or otherwise make available on or through the Services,
                        including, without limitation, the accuracy, reliability, nature, rights clearance, compliance
                        with law and legal restrictions associated with any Content contribution. You hereby grant DBO
                        and its successors a perpetual, irrevocable, worldwide, non-exclusive, royalty-free,
                        sub-licensable and transferable license to use, copy, distribute, republish, transmit, modify,
                        adapt, create derivative works of, publicly display, and publicly perform such content
                        contribution on, through or in connection with the Services in any media formats and through any
                        media channels, including, without limitation, for promoting and redistributing part of the
                        Services (and its derivative works) without need of attribution and you agree to waive any moral
                        rights (and any similar rights in any part of the world) in that respect. You understand that
                        your contribution may be transmitted over various networks and changed to conform and adapt to
                        technical requirements.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You also hereby grant each User of the Platform a non-exclusive license to access your Submitted
                        Content through the Platform, and to read and use, such Submitted Content as permitted through
                        the functionality of the Platform and under these Terms of Use.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>We do not permit copyright infringing activities and infringement of Intellectual Property
                        rights on the Platform, and we will remove any data or Submitted Content in our sole discretion,
                        upon being notified or having reason to believe that an infringement has occurred, without prior
                        notice to a User who has or is suspected to have conducted such infringement. We may take any
                        action or steps we deem fit in our sole discretion against such infringer.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You acknowledge that we and our designees shall have the right (but not the obligation) in our
                        sole discretion to pre-screen, refuse, delete, stop, suspend, remove or move any content,
                        including without limitation any Submitted Content posted by you, that is available on the
                        Platform. Without limiting the foregoing, we and our designees shall have the right to remove
                        any content (i) that violates these Terms of Use, and/or DBO Terms and Conditions; (ii) if we
                        receive a complaint from another User; (iii) if we receive a notice of Intellectual Property
                        infringement or other legal instruction for removal; or (iv) if such content is otherwise
                        objectionable. We may also block delivery of a communication (including, without limitation,
                        status updates, postings, messages and/or chats) to or from the Services as part of our effort
                        to protect the Services or our Users, or otherwise enforce the provisions of these Terms of Use
                        and/or DBO Terms and Conditions. You agree that you must evaluate, and bear all risks associated
                        with, the use of any content, including, without limitation, any reliance on the accuracy,
                        completeness, or usefulness of such content. In this regard, you acknowledge that you have not
                        and, to the maximum extent permitted by applicable law, may not rely on any content created by
                        us or submitted to us , including, without limitation, information in any part of the Platform.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You acknowledge, consent to and agree that we may access, preserve and disclose your Account
                        information and Submitted Content if required to do so by law or pursuant to an order of a court
                        or by any governmental or regulatory authority having jurisdiction over us or in a good faith
                        belief that such access preservation or disclosure is reasonably necessary to: (a) comply with
                        legal process; (b) enforce these Terms of Use and/or DBO Terms and Conditions; (c) respond to
                        claims that any content violates the rights of third parties; (d) respond to your requests for
                        customer service; or (e) protect the rights, property or personal safety of DBO, its Users
                        and/or the public.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>Violation of any Terms of Use and/or the DBO Terms and Conditions may result in a range of
                        actions determined by us in our sole discretion, including but not limited to, any or all of the
                        following:
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>termination or suspension of Account, Password or benefits/privileges under an Account;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>imposition of limits on the Accounts, and/or benefits/privileges under an Account;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>criminal charges; or</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>civil actions, including but not limited to, a claim for damages and/or interim or injunctive
                        relief.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="9">
                    <li><strong>DISCLAIMER</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>YOU EXPRESSLY ACKNOWLEDGE AND AGREE THAT THE USE OF THE PLATFORM AND THE SERVICES IS AT YOUR
                        SOLE RISK. THE SERVICES ARE PROVIDED ON AN &ldquo;AS IS&rdquo;, &ldquo;AS AVAILABLE&rdquo;
                        BASIS. DBO, ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, CONTRACTORS AND ASSIGNS MAKE NO
                        WARRANTIES AND/OR REPRESENTATIONS AND DISCLAIM ALL WARRANTIES, REPRESENTATIONS AND/OR CONDITIONS
                        WHETHER EXPRESS OR IMPLIED ARISING OR RESULTING FROM OR UNDER AND IN CONNECTION WITH THE WEBSITE
                        AND FROM YOUR USE OR INABILITY TO USE THEREOF INCLUDING BUT NOT LIMITED TO:
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>THE ACCURACY, COMPLETENESS, MERCHANTABILITY, SATISFACTORY QUALITY, UNINTERRUPTED OR ERROR-FREE
                        SERVICE OR OPERATION, CONTINUITY AND AVAILABILITY OF SERVICE OR OPERATION, COMPATIBILITY AND
                        USABILITY WITH THIRD PARTY OR OTHER SERVICES, FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT,
                        AND NON-INFRINGEMENT OF THIRD PARTY RIGHTS OF THE PLATFORM OR ANY SERVICES THAT DBO PROVIDES;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>ANY ERRORS, MISTAKES, OMISSIONS OR INACCURACIES IN ANY MATERIAL, CONTENT, MESSAGE, TRANSMISSION
                        OR ACT, WHETHER POSTED, EMAILED, TRANSMITTED, SUBMITTED, ADVERTISED, OFFERED OR OTHERWISE MADE
                        AVAILABLE IN THE WEBSITE (WHETHER BY DBO OR ANY THIRD PARTY THROUGH THE PLATFORM);
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>ANY UNAUTHORIZED ACCESS TO OR USE OF THE PLATFORM OR DBO&rsquo;S SERVERS, DATA OR INFORMATION;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>ANY CESSATION, TERMINATION OR DISTURBANCE OF TRANSMISSION TO OR FROM THE PLATFORM;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>ANY COMPUTER VIRUSES, WORMS, TROJAN HORSES OR OTHER MALWARE OR BY TRESPASS OR BURDENING NETWORK
                        CAPACITY WHETHER TRANSMITTED TO OR THROUGH THE PLATFORM WHETHER DUE TO THE ACTIONS OF ANY THIRD
                        PARTIES OR OTHERWISE;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>ANY TRANSACTION OR TRANSMISSION BETWEEN YOU AND ANY THIRD PARTY PROVIDER OF PRODUCTS OR SERVICES
                        OF ANY KIND IN ANY MEDIUM WHATSOEVER; AND
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>ANY HARASSMENT, ABUSE, STALKING, THREATENING, DEFAMATORY, OFFENSIVE, INFRINGING, VIOLATING OR
                        ILLEGAL SUBMISSION, MATERIAL, CONTENT, MESSAGE, TRANSMISSION OR ACT BY ANY USER OF THE PLATFORM
                        OR OTHERWISE.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>YOU AGREE THAT YOU SHALL BE SOLELY RESPONSIBLE FOR YOUR COMPUTER, SYSTEM OR OTHER DEVICE FROM
                        WHICH YOU ACCESS THE PLATFORM, INCLUDING THE MAINTENANCE, OPERATION AND PERMITTED USE OF SUCH
                        COMPUTER, SYSTEM OR OTHER DEVICE. YOU SHALL ENSURE THAT ANY COMPUTER, SYSTEM OR OTHER DEVICE
                        FROM WHICH YOU ACCESS AND USE IS PROPERLY MAINTAINED AND FREE FROM ANY DEFECTS, VIRUSES OR
                        ERRORS. IT SHALL BE YOUR RESPONSIBILITY TO ENSURE THAT YOUR COMPUTER IS LOADED WITH THE LATEST
                        ANTI-VIRUS AND ANTI-SPYWARE SOFTWARE AND THAT THE SAID SOFTWARE IS AT ALL TIMES INSTALLED AND
                        UPDATED.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>WE DO NOT ENDORSE ANY SUBMITTED CONTENT OR ANY OPINION, RECOMMENDATION, OR ADVICE PROVIDED BY
                        ANY USERS AND WE EXPRESSLY DISCLAIM ANY AND ALL LIABILITY IN CONNECTION WITH ALL SUBMITTED
                        CONTENT.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>YOU HEREBY ACKNOWLEDGE AND UNDERSTAND THAT BY USING THE PLATFORM, YOU MAY BE EXPOSED TO CONTENT
                        FROM A VARIETY OF SOURCES AND WE ARE NOT RESPONSIBLE FOR THE ACCURACY, USEFULNESS, SAFETY, OR
                        INTELLECTUAL PROPERTY RIGHTS OF OR RELATING TO THESE SUBMITTED CONTENT OF ANY USERS. IN RELATION
                        TO THE SUBMITTED CONTENT THAT IS OR MAY BE INACCURATE, OFFENSIVE, INDECENT, OR OBJECTIONABLE,
                        YOU AGREE TO AND HEREBY WAIVE ANY LEGAL OR EQUITABLE RIGHTS OR REMEDIES YOU HAVE OR MAY HAVE
                        AGAINST US, AND AGREE TO INDEMNIFY AND HOLD US, OUR OWNERS, MEMBERS, MANAGERS, OPERATORS,
                        DIRECTORS, OFFICERS, AGENTS, AFFILIATES, AND/OR LICENSORS, HARMLESS TO THE FULLEST EXTENT
                        ALLOWED BY LAW REGARDING ALL MATTERS RELATED TO YOUR USE OF THE PLATFORM.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="10">
                    <li><strong>LIMITATION OF LIABILITY</strong></li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>IN ADDITION TO AND NOT IN DEROGATION OF ANY OTHER TERMS OF THE DBO TERMS AND CONDITIONS, DBO,
                        ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, CONTRACTORS AND ASSIGNS SHALL NOT IN ANY EVENT BE
                        LIABLE TO YOU OR ANY OTHER PARTY HAVING ACCESS TO THE SERVICES AND/OR THE PLATFORM WHETHER WITH
                        OR WITHOUT OUR CONSENT FOR ANY DIRECT, CONSEQUENTIAL, INCIDENTAL, SPECIAL OR INDIRECT LOSSES OR
                        DAMAGES ARISING FROM, INTER ALIA, ANY DELAY OR DISRUPTION IN THE USE OF THE SERVICES AND/OR THE
                        PLATFORM, NOTWITHSTANDING THAT WE HAVE BEEN ADVISED OF THE POSSIBILITY OF THE SAME.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>DBO, ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, CONTRACTORS AND ASSIGNS SHALL NOT BE LIABLE FOR
                        ANY LOSS ARISING FROM A CAUSE OUTSIDE OUR REASONABLE CONTROL, ANY ACTION OR OMISSION BY THE
                        RELEVANT AUTHORITIES IN EXERCISE OF THEIR REGULATORY OR SUPERVISORY FUNCTIONS, OR FOR FAILURE BY
                        THE ELECTRONIC/TELECOMMUNICATION SERVICE PROVIDER OR ANY THIRD PARTY TO MEET ITS OBLIGATIONS TO
                        YOU FOR ANY REASONS WHATSOEVER AND HOWEVER ARISING INCLUDING FAILURE OF ELECTRONIC OR MECHANICAL
                        EQUIPMENT OR COMMUNICATION/TELEPHONE LINES OR OTHER INTERCONNECTED PROBLEMS, UNAUTHORISED
                        ACCESS, THEFT, UNAUTHORISED USE OF PASSWORD, OPERATOR ERROR, WEATHER, EARTHQUAKES, STRIKES OR
                        OTHER LABOUR PROBLEMS.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>DBO, ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, CONTRACTORS AND ASSIGNS SHALL NOT BE LIABLE TO
                        YOU FOR ANY LOSSES WHATSOEVER OR HOWSOEVER CAUSED (REGARDLESS OF THE FORM OF ACTION) ARISING
                        DIRECTLY OR INDIRECTLY IN CONNECTION WITH:
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>ANY ACCESS, USE AND/OR INABILITY TO USE THE PLATFORM OR THE SERVICES;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>RELIANCE ON ANY DATA OR INFORMATION MADE AVAILABLE THROUGH THE PLATFORM AND/OR THROUGH THE
                        SERVICES. YOU SHOULD NOT ACT ON SUCH DATA OR INFORMATION WITHOUT FIRST INDEPENDENTLY VERIFYING
                        ITS CONTENTS;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>ANY SYSTEM, SERVER OR CONNECTION FAILURE, ERROR, OMISSION, INTERRUPTION, DELAY IN TRANSMISSION,
                        COMPUTER VIRUS OR OTHER MALICIOUS, DESTRUCTIVE OR CORRUPTING CODE, AGENT PROGRAM OR MACROS; AND
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>ANY USE OF OR ACCESS TO ANY OTHER WEBSITE OR WEBPAGE LINKED TO THE PLATFORM, EVEN IF WE OR OUR
                        OFFICERS OR AGENTS OR EMPLOYEES MAY HAVE BEEN ADVISED OF, OR OTHERWISE MIGHT HAVE ANTICIPATED,
                        THE POSSIBILITY OF THE SAME.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>TO THE EXTENT PERMITTED BY LAW, DBO, ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, CONTRACTORS AND
                        ASSIGNS, OTHER MEMBERS OF OUR GROUP OF COMPANIES AND THIRD PARTIES CONNECTED TO US HEREBY
                        EXPRESSLY EXCLUDE:
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol>
                    <li>ALL CONDITIONS, WARRANTIES AND OTHER TERMS WHICH MAY OTHERWISE BE IMPLIED BY STATUTE, COMMON LAW
                        OR THE LAW OF EQUITY;
                    </li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>ALL LIABILITY IN RESPECT OF:</li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>THE ACCURACY, COMPLETENESS, FITNESS FOR PURPOSE OR LEGALITY OF ANY INFORMATION ACCESSED USING
                        THE SERVICES, PLATFORM OR OTHERWISE;
                    </li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>THE TRANSMISSION OR THE RECEPTION OF OR THE FAILURE TO TRANSMIT OR TO RECEIVE ANY MATERIAL OF
                        WHATEVER NATURE; AND
                    </li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>YOUR USE OF ANY INFORMATION OR MATERIALS ON THE PLATFORM (WHICH IS ENTIRELY AT YOUR OWN RISK AND
                        IT IS YOUR RESPONSIBILITY);
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol>
                    <li>ANY LIABILITY FOR:</li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>LOSS OF INCOME OR REVENUE;</li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>LOSS OF BUSINESS;</li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>LOSS OF CONTRACTS;</li>
                </ul>
                <p>&nbsp;</p>
                <ol>
                    <li>LOSS OF ACTUAL AND/OR ANTICIPATED PROFITS;</li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>LOSS OF USE OF MONEY;</li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>LOSS OF ANTICIPATED SAVINGS;</li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>LOSS OF OPPORTUNITY;</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>LOSS OF, DAMAGE TO OR CORRUPTION OF DATA;</li>
                </ul>
                <p>&nbsp;</p>
                <ol>
                    <li>LOSS OF GOODWILL AND/OR REPUTATION;</li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>WASTED MANAGEMENT OR OFFICE TIME; AND</li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>FOR ANY OTHER LOSS OR DAMAGE OF ANY KIND, HOWEVER ARISING AND WHETHER CAUSED BY TORT (INCLUDING
                        NEGLIGENCE), BREACH OF CONTRACT OR OTHERWISE, EVEN IF FORESEEABLE.
                    </li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>YOU ACKNOWLEDGE AND AGREE THAT YOUR ONLY RIGHT WITH RESPECT TO ANY PROBLEMS OR DISSATISFACTION
                        WITH THE SERVICES IS TO DISCONTINUE ANY USE OF THE SERVICES.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>IF, NOTWITHSTANDING THE PREVIOUS SECTIONS, WE ARE FOUND BY A COURT OF COMPETENT JURISDICTION TO
                        BE LIABLE (INCLUDING FOR GROSS NEGLIGENCE), THEN, TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE
                        LAW, ITS LIABILITY TO YOU OR TO ANY THIRD PARTY IS LIMITED TO RM100 (RINGGIT MALAYSIA ONE
                        HUNDRED ONLY), OR WHERE A MINIMUM COMPENSATION IS DESIGNATED UNDER THE APPLICABLE LAW, SUCH
                        MINIMUM COMPENSATION SHALL APPLY.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="11">
                    <li><strong>INDEMNITY</strong></li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>You unconditionally and irrevocably undertake to fully and effectively indemnify us, our
                        officers, directors, employees, agents, contractors, assigns, servants, affiliate, members of
                        our group of companies and third parties connected to us and keep each of the aforesaid persons
                        indemnified from and against any and all claims, losses (including loss of profit), liabilities,
                        obligations, penalties, fines, costs and expenses (including but not limited to solicitors&rsquo;
                        fees on a solicitor and client basis) arising in any way from your use of the Platform and/or
                        Services, and/or such use thereof by any other party using your Password to access to your
                        Account with us (whether such use is authorised or unauthorised) or having access to the
                        Services and/or to any electronic or telecommunications device thereof at all times whether with
                        or without your consent or any breach or alleged breach or violation by you (or your agents or
                        representatives or persons acting under you) of any part of the DBO Terms and Conditions or any
                        third party rights including but not limited to violation of any copyright, proprietary or
                        privacy rights. This obligation to indemnify shall continue in full force and effect and shall
                        survive the termination of the Services for any reason whatsoever or the suspension, termination
                        or closure of your Account with us.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="12">
                    <li><strong>PAYABLE FEES</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>Use of the Platform and the Services as a Buyer is free. However, certain Services or functions
                        on the Platform which are provided for the Sellers may require the payment of fees as further
                        described in the Terms for Buyers &amp; Sellers, such other DBO Terms and Conditions, and such
                        other agreements as may be entered into between the Seller and DBO from time to time.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>Notwithstanding the aforesaid, we reserve the rights to charge fees, costs, charges and expenses
                        in connection with the Services as we may notify to you on the Platform from time to time and in
                        the manner stipulated by us (&ldquo;<strong>Payable Fees</strong>&rdquo;). If you do not agree
                        to such payment, you must cease any use of the Platform and Services immediately.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>We reserve the right at any time and from time to time to vary the rate of the Payable Fees or
                        vary the time and manner of payment of the Payable Fees. All fees paid to us hereunder shall be
                        non-refundable, unless we agree otherwise.
                    </li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ol start="13">
                    <li><strong>TAXES </strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>You shall bear all Taxes payable by it in connection with the Services, if any.</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>The Payable Fees to be paid by you to us shall be made in full exclusive of any Tax, and without
                        any set-off, restriction or condition and without any deduction for or on account of any
                        counterclaim or any deduction or withholding of or in respect of any Tax.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>In the event we are required by law to calculate and collect from you any amount paid or payable
                        under the DBO Terms and Conditions on account of any Tax, such amount as calculated by us, shall
                        be paid by you as additional to and without any deduction or set-off from the Payable Fees
                        payable to us.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>For the purpose of this clause, &ldquo;Tax&rdquo; is defined as any present or future, Malaysian
                        or foreign tax, levy, impost, duty, charge, fee, deduction or withholding of any nature, and any
                        interest or penalties in respect thereof.
                    </li>
                </ul>
                <p>&nbsp; &nbsp;&nbsp;</p>
                <ol start="14">
                    <li><strong>LINKS TO AND FROM OTHER WEBSITES</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>Aspects of the Platform and the Services may be supported by advertising revenue. As such, we
                        may display advertisements and promotions on the Platform. The manner, mode and extent of
                        advertising by us on the Platform are subject to change and the appearance of advertisements on
                        the Platform does not necessarily imply endorsement by us of any advertised products or
                        services. You agree that we shall not be responsible or liable for any loss or damage of any
                        sort incurred by you as a result of any such dealings or as the result of the presence of such
                        advertisers on the Platform.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>The Platform may contains links to third party sites and to resources provided by third parties
                        (&ldquo;<strong>Third Party Sites</strong>&rdquo;). You acknowledge and agree that we are not
                        responsible for the availability of such external sites or resources, and are not responsible or
                        liable for any content, advertising, products, goods or services on or available from such
                        websites or resources. Unless expressly stated on the Platform, links to Third Party Sites
                        should in no way be considered as or interpreted to be our endorsement of such Third Party Sites
                        or any product or service offered through them.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>We have no control over and we assume no responsibility for the content of the Third Party Sites
                        and we accept no liability for any loss or damage that may arise from your use of them. If you
                        access any of the Third Party Sites linked to the Platform, or use or rely upon the content of
                        such Third Party Sites, you hereby do so entirely at your own risk. Once you leave our Platform,
                        these Terms of Use and the DBO Terms and Conditions no longer govern you and you are advised to
                        check the terms and conditions of those websites. You also acknowledge that it is your
                        obligation to comply with any terms and conditions of any third parties that you may come into
                        contact with either directly or indirectly through the use of the Platform, and you accept all
                        responsibility thereof. Your dealings and communications through the Platform with any party
                        other than us are solely between you and such third party. Any complaints, concerns or questions
                        you have relating to materials provided by third parties should be forwarded directly to the
                        applicable third party.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="15">
                    <li><strong>DATA PROTECTION</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>Please see our Privacy Policy which forms part of the DBO Terms and Conditions.</li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ol start="16">
                    <li><strong>INTELLECTUAL PROPERTY RIGHTS </strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>All Intellectual Property rights subsisting in respect of the Services and the Platform shall
                        remain the sole and exclusive of our property (or that of our licensors). All rights under
                        applicable laws are hereby reserved. You shall not reproduce, retransmit, disseminate, sell,
                        distribute, publish, broadcast, circulate or commercially exploit any of our information or
                        materials on the Platform in any manner whatsoever without our prior written consent nor use the
                        information for any illegal or other purpose not permitted by us.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>You shall protect our contractual and statutory rights in or to the information or materials
                        furnished through the Services and/or Platform and you shall immediately comply with all
                        requirements from us and execute any and all applications, assignments or other instruments
                        which we deem necessary to protect our rights. &nbsp;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="17">
                    <li><strong>NOTICES</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>Any notice or demand or other document may be sent by us to you by any one or more of the
                        following methods:
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol>
                    <li>by transmitting the same to your last known email address known to us and shall be deemed to
                        have been received by you immediately upon successful the transmission thereof notwithstanding
                        any delay caused by mechanical or electronic failure or any reasons whatsoever; or
                    </li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>by publishing such notice on the Platform and shall be deemed to have been received by you
                        immediately upon the date of publishing thereof.
                    </li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>All notices or instructions including any change in your address sent by you to us shall be in
                        writing and sent by ordinary or registered post or delivered personally to us at our then
                        prevailing place of business (deemed received by us when we had in fact received the same) or
                        transmitted via facsimile or through the Platform (deemed received by us when we have actual
                        notice of the same respectively provided always all Instructions shall be communicated by you to
                        us through the designated forum provided in the Service).
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="18">
                    <li><strong>USER REPRESENTATIONS AND WARRANTIES</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>You represent and warrant that:</li>
                </ul>
                <p>&nbsp;</p>
                <ol>
                    <li>you possess the legal capacity (and in the case of a minor, valid parent or legal guardian
                        consent), right and ability to enter into these Terms of Use and to comply with its terms; and
                    </li>
                </ol>
                <p>&nbsp;</p>
                <ol>
                    <li>you will use the Services for lawful purposes only and in accordance with these Terms of Use and
                        all applicable laws, rules, codes, directives, guidelines, policies and regulations.
                    </li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>In opening a Corporate Account on the Platform, an individual User would have to, for and on
                        behalf of the corporate/business applicant, submit an application to open and set up such
                        Corporate Account, together with all the documents and information as specified by us. Where you
                        are such individual User opening or operating the Corporate Account for and on behalf of a
                        corporate/business applicant, you hereby represent and warrant to us that you have the requisite
                        authority to make such application for the said corporate/business applicant, and you have the
                        requisite authority to bind such corporate/business applicant (or User upon our approval of its
                        application), and your acceptance of the Terms of Use, and the DBO Terms and Conditions will be
                        deemed an acceptance by such corporate/business applicant (or User upon our approval of its
                        application).
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>The corporate/business User (&ldquo;<strong>Corporate User</strong>&rdquo;) shall, upon opening
                        of the Corporate Account, then designate such User(s) as its admin (&ldquo;<strong>Corporate
                            Admin</strong>&rdquo;) to operate its Corporate Account. Thereafter, the Corporate Admin
                        shall designate and identify such User(s) who is the personnel of such Corporate User that
                        belong to the same organisation. Any and all actions as may be taken on the Platform by these
                        User(s) together with the Corporate Admin (collectively, &ldquo;<strong>Corporate
                            Representatives</strong>&rdquo;) shall be deemed to be actions of such Corporate User, and
                        it hereby represents and warrants to us that any and all the Corporate Representatives shall
                        have the requisite authority and right to bind such Corporate User. &nbsp;&nbsp;&nbsp;&nbsp;
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>In connection with Clause 18.3 above, where there is a change in the Corporate Representatives,
                        the Corporate User shall be obliged to inform us promptly of such change, failing which the
                        original Corporate Representatives shall be deemed to act for and on behalf of the Corporate
                        User.
                    </li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ol start="19">
                    <li><strong>THIRD PARTY RIGHTS</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>All provisions of the DBO Terms and Conditions apply equally to and are for the benefit of us,
                        our subsidiaries, (or their) holding companies, our (or their) affiliates, our (or their) third
                        party providers and licensors and each shall the right to assert and enforce such provisions
                        directly or on its own behalf (save that the DBO Terms and Conditions may be varied or rescinded
                        without the consent of these parties).
                    </li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ol start="20">
                    <li><strong>NO OTHER TERMS</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>Except as expressly stated in the DBO Terms and Conditions, all warranties, conditions and other
                        terms, whether express or implied, by statute, common law or otherwise are hereby excluded to
                        the fullest extent permitted by law.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="21">
                    <li><strong>ASSIGNMENT</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>You shall not assign or delegate or otherwise deal with all or any of your rights or obligations
                        under the DBO Terms and Conditions without our prior written consent. We shall have the right to
                        assign or otherwise delegate all or any of our rights or obligations under the DBO Terms and
                        Conditions to any person.
                    </li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ol start="22">
                    <li><strong>SEVERANCE</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>If any provision of the DBO Terms and Conditions shall be held to be illegal, invalid or
                        unenforceable, in whole or in part, the provision shall apply with whatever deletion or
                        modification is necessary so that the provision is legal, valid and enforceable and gives effect
                        to the commercial intention of the parties. To the extent it is not possible to delete or modify
                        the provision, in whole or in part, under this Clause 22.1, then such provision or part of it
                        shall, to the extent that it is illegal, invalid or unenforceable, be deemed not to form part of
                        the DBO Terms and Conditions and the legality, validity and enforceability of the remainder of
                        the DBO Terms and Conditions shall, subject to any deletion or modification made under this
                        Clause 22.1, not be effected.
                    </li>
                </ul>
                <p>&nbsp;&nbsp;</p>
                <ol start="23">
                    <li><strong>FORCE MAJEURE</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>We shall not be liable to you for non-performance or delay in performance of any of our
                        obligations under the DBO Terms and Conditions resulting from any act of god, flood, fire, war,
                        riot, civil commotion, natural catastrophe, strike, act of governmental, change of law, or any
                        supervening event of whatsoever nature beyond our reasonable control.
                    </li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ol start="24">
                    <li><strong>SEVERAL USERS </strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>If there are two or more persons adhering to the DBO Terms and Conditions as Users, their
                        liability under the DBO Terms and Conditions is joint and several, and their rights are joint.
                    </li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ol start="25">
                    <li><strong>WAIVERS</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>No failure or delay by us to exercise any right or remedy provided under the DBO Terms and
                        Conditions or by law shall constitute a waiver of that or any other right or remedy, nor shall
                        it prevent or restrict the further exercise of that or any other right or remedy. No single or
                        partial exercise of such right or remedy shall prevent or restrict the further exercise of that
                        or any other right or remedy.
                    </li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ol start="26">
                    <li><strong>RELATIONSHIP</strong></li>
                </ol>
                <p>&nbsp;</p>
                <ul>
                    <li>Nothing in these Terms of Use and DBO Terms and Conditions shall constitute a partnership, joint
                        venture or principal-agent relationship between you and DBO, nor does it authorise you to incur
                        any costs or liabilities on DBO&rsquo;s behalf.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>All Sellers are independent of DBO. Neither DBO nor any Users may direct or control the
                        day-to-day activities of the other, or create or assume any obligation on behalf of the other.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="27">
                    <li><strong>DISPUTES</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>In the event a problem arises in a transaction, the Buyer and Seller agree to communicate with
                        each other first to attempt to resolve such dispute by mutual discussions, which we shall use
                        reasonable commercial efforts to facilitate. If the matter cannot be resolved by mutual
                        discussions, Users may approach the claims tribunal of their local jurisdiction to resolve any
                        dispute arising from a transaction.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>Each Buyer and Seller covenants and agrees that it will not bring suit or otherwise assert any
                        claim against DBO, its officers, directors, employees, agents, contractors and assigns (except
                        where DBO or any of the aforesaid persons is the Seller of the product that the claim relates
                        to) in relation to any transaction made on the Platform or any dispute related to such
                        transaction.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ol start="28">
                    <li><strong>GOVERNING LAW </strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>These Terms of Use and the DBO Terms and Conditions shall be governed by, and construed in
                        accordance with, the Malaysian law. Unless otherwise required by applicable laws, any dispute,
                        controversy, claim or difference of any kind whatsoever shall arising out of or relating to
                        these Terms of Use and/or the DBO Terms and Conditions against or relating to DBO or any
                        Indemnified Party under these Terms of Use shall be referred to and settled by arbitration in
                        accordance with the Arbitration Rules of the Asian International Arbitration Centre held in
                        Kuala Lumpur, Malaysia. The arbitral tribunal shall consists of a sole arbitrator who is legally
                        trained and who has experience in the information technology field in Malaysia and is
                        independent of either party. The place of arbitration shall be Malaysia. Any award by the
                        arbitration tribunal shall be final and binding upon the parties.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>Notwithstanding the foregoing, DBO reserves the right to pursue the protection of Intellectual
                        Property rights and confidential information through injunctive or other equitable relief
                        through the courts.
                    </li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ol start="29">
                    <li><strong>LANGUAGES</strong></li>
                </ol>
                <p><strong>&nbsp;</strong></p>
                <ul>
                    <li>The DBO Terms and Conditions are drafted in the English language. Where we provide you with a
                        translation of the English language version of the DBO Terms and Conditions, then you agree that
                        the translation is provided for your convenience only and that the English language version of
                        the DBO Terms and Conditions shall govern your relationship with us.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                    <li>If there is any contradiction between the English language version of the DBO Terms and
                        Conditions and any translation as we provide, the English language version of the DBO Terms and
                        Conditions shall prevail.
                    </li>
                </ul>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
    </div>
@endsection
