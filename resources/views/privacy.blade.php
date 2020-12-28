@extends('layouts.app')

@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' PRIVACY POLICY') }}</title>
@endsection

@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>PRIVACY POLICY</h1>
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
                        <li class="breadcrumb-item active">PRIVACY POLICY</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="section">
    <div class="container">
        <div class="row" style="min-height: 50vh;">
            <div class="col-12" style="margin: auto;">
                <p><strong>English</strong> | <a href="{{ route("privacybm") }}" target="_blank"><span >Bahasa Malaysia</span></a></p>
                <p>Digital BlueOcean Berhad, its affiliates and subsidiaries (individually and collectively,
                    &ldquo;<strong>DBO</strong>&rdquo;, &ldquo;<strong>we</strong>&rdquo;, &ldquo;<strong>us</strong>&rdquo;
                    or &ldquo;<strong>our</strong>&rdquo;) take our responsibilities under applicable privacy laws and
                    regulations (&ldquo;<strong>Privacy Laws</strong>&rdquo;) seriously and are committed to protecting
                    the privacy of our platform users with regards to their personal data. Our Privacy Policy set out
                    below is put together in accordance with the Privacy Laws and is designed to assist you in
                    understanding how we collect, use, disclose and/or process the personal data you have provided to us
                    and/or we possess about you, whether now or in the future, as well as to assist you in making an
                    informed decision before providing us with any of your personal data. Please read this Privacy
                    Policy carefully.</p>
                <p>By using the services we provide via our website (&ldquo;<strong>Services</strong>&rdquo;),
                    registering for an account with us, visiting our website, or accessing the Services, you acknowledge
                    and agree that you accept the practices, requirements, and/or policies outlined in this Privacy
                    Policy, and you hereby consent to us collecting, using, disclosing and/or processing your personal
                    data as described herein. IF YOU DO NOT CONSENT TO THE PROCESSING OF YOUR PERSONAL DATA AS DESCRIBED
                    IN THIS PRIVACY POLICY, PLEASE DO NOT USE OUR SERVICES OR ACCESS OUR WEBSITE. If we change our
                    Privacy Policy, we will post those changes or the amended Privacy Policy on our website. We reserve
                    the right to amend this Privacy Policy at any time.</p>
                <p><strong>Personal data that we collect about you</strong></p>
                <p>Personal data means any information in our possession that relates directly or indirectly to an
                    individual to the extent that the individual can be identified from that and from other information
                    in our possession.</p>
                <p>Personal data includes, but not limited to, name, address, copies and details of identification
                    documents, contact details, gender, details of bank account, billing address, employment history,
                    credit and references check, marital status, commission or alleged commission of offence, personal
                    financial, social security detail, as well as information and data generated in the ordinary course
                    of the relationship with us which may include signatures, answers to questions intended for security
                    verification, emergency contact numbers and call back contact details.</p>
                <p><strong>How we collect your personal data </strong></p>
                <p>We may collect your personal data during our course of dealings with you through applications and
                    other forms submitted by you through our website or otherwise, letter of offers, agreements signed
                    by you and your access to our website, and personal data of our partners to which you hereby render
                    your unconditional consent for us to receive, process and assess for, in relation to, the provision
                    of our services or products. We may also obtain information about your general internet usage by
                    using cookies which are stored on the hard drive of your computer. The above does not purport to be
                    exhaustive and sets out some common instances of when personal data about you may be collected. Some
                    third parties who advertise on our website may also use cookies but we do not have access to them,
                    or control over them. You can set your web browser to refuse cookies, but if you do then you may not
                    be able to enjoy the full use of our website. Your personal data may also be collected from a
                    variety of sources, including without limitation, during meetings, events, seminars, conferences,
                    talks, road shows, surveys organised or sponsored by us, as well as public domain sources. These
                    includes pursuant to any communications made from or with us.</p>
                <p><strong>Purpose of personal data collected </strong></p>
                <p>You hereby acknowledge, confirm and consent that we may collect, record, hold, store and/or process
                    your personal data for the following purposes:</p>
                <ol>
                    <li>to establish a relationship between you and us and/or companies related to or affiliated to us,
                        our service providers and business partners;
                    </li>
                    <li>to consider and/or process your application/transaction with us or your transactions or
                        communications with third parties via the Services;
                    </li>
                    <li>to manage, operate, administer and provide you with as well as to facilitate the provision of
                        our Services, including, without limitation, remembering your preferences;
                    </li>
                    <li>to tailor your experience through the Services by displaying content according to your interests
                        and preferences, providing a faster method for you to access your account and submit information
                        to us and allowing us to contact you, if necessary;
                    </li>
                    <li>to process applications for products and Services;</li>
                    <li>for identification and/or verification;</li>
                    <li>for evaluation and/or due diligence purposes;</li>
                    <li>for carrying out your instructions and the provision of products and Services to you, whether
                        provided personally or through telephone or electronic means, including processing of receipts
                        and payments;
                    </li>
                    <li>to maintain and administer any software updates and/or other updates and support that may be
                        required from time to time to ensure the smooth running of our Services;
                    </li>
                    <li>for data processing purposes;</li>
                    <li>to evaluate and monitor provision of Services;</li>
                    <li>to respond to, process, deal with or complete a transaction and/or to fulfil your requests for
                        certain products and services and notify you of service issues and unusual account actions;
                    </li>
                    <li>to deal with or facilitate customer service, carry out your instructions, deal with or respond
                        to any enquiries given by (or purported to be given by) you or on your behalf;
                    </li>
                    <li>to allow other users to interact or connect with you on our website, including to inform you
                        when another user has sent you a private message or posted a comment for you on our website;
                    </li>
                    <li>to understand your needs and offering products and services to meet those needs;</li>
                    <li>for the research and development of products and services for customers use;</li>
                    <li>to allow us, our related and/or affiliated companies, service providers and business partners to
                        promote their products and services;
                    </li>
                    <li>for debt collection purposes;</li>
                    <li>for enforcement of our rights and obligations of other parties to us and/or our affiliates;</li>
                    <li>operating internal controls including determining amounts owed to or by you, payment to or
                        collection of such amounts from you and from any persons providing security for your obligations
                        and enforcing any charge or other security granted by or for you in respect of our product and
                        services;
                    </li>
                    <li>to enable a party to evaluate any actual or proposed assignment, participation,
                        sub-participation and/or novation of our rights and/or obligations;
                    </li>
                    <li>to meet legal and regulatory requirements, which may include disclosure, notification and record
                        retention requirements;
                    </li>
                    <li>to produce statistics and research for internal and statutory reporting and/or record-keeping
                        requirements;
                    </li>
                    <li>for any transfer or proposed transfer of any part of our interests, obligations, business and/or
                        operations;
                    </li>
                    <li>to store, host, back up (whether for disaster recovery or otherwise) of your personal data,
                        whether within or outside of your jurisdiction;
                    </li>
                    <li>to perform research, evaluation, administrative and operational tasks (including market or
                        customer survey, due diligence, service improvement and product development, risk management,
                        systems development, credit rating, and training);
                    </li>
                    <li>for such other purposes as permitted by applicable law or with your consent; and</li>
                    <li>for all other purposes incidental and associated with any of the above,</li>
                </ol>
                <p>(collectively referred to as &ldquo;<strong>Permitted Purposes</strong>&rdquo;).</p>
                <p>This may require, among other things, share statistical and demographic information about our users
                    and their use of the Services with suppliers of advertisements and programming.</p>
                <p>In addition, we may transfer or permit the transfer of your personal data outside of your
                    jurisdiction for any of the purposes set out in this Privacy Policy. However, we will not transfer
                    or permit any of your personal data to be transferred outside of such jurisdiction unless the
                    transfer is in compliance with applicable laws.</p>
                <p><strong>Use and disclosure</strong></p>
                <p>Your personal data will not be disclosed by us to any third party without your consent, save for
                    disclosure to:</p>
                <ol>
                    <li>our group of companies (including our parent company, representatives, subsidiaries, affiliates,
                        related and/or associated companies);
                    </li>
                    <li>our trustees, business partners, vendors, suppliers, agents, contractors, service providers,
                        insurance companies, professional advisers, banks and/or financial institutions who provide
                        banking, trust, remittance, administrative, mailing, telecommunications, call centres, business
                        process, travel, visa, knowledge management, human resource, data processing, information
                        technology, computer, payment, debt collection, credit reference checks or securities clearing
                        or other services to us;
                    </li>
                    <li>our auditors, business consultants, accountants, lawyers or other professional advisers and/or
                        consultants as we deem necessary and appropriate;
                    </li>
                    <li>to any party who undertakes to keep your personal data confidential only to the extent necessary
                        to fulfil the relevant Permitted Purposes, or to whom we are compelled or required by law to
                        disclose to, including disclosure to courts, tribunals, legal, regulatory, tax and other
                        government authorities; or
                    </li>
                    <li>any actual or proposed assignee of DBO or transferee of DBO&rsquo;s rights in respect of all or
                        part of the assets or business of DBO.
                    </li>
                </ol>
                <p><strong>Data integrity</strong></p>
                <p>By providing us with your personal data, you are consenting for us to act as data user for the
                    purposes of the Privacy Laws and to be able to collect and process your personal data in accordance
                    with this Privacy Policy. You confirm that all personal data that is provided to us is true,
                    accurate and complete, and that none of the personal data provided is misleading or outdated. In the
                    event of any change to your personal data, you will promptly update us.</p>
                <p><strong>Security of your personal data</strong></p>
                <p>We implement a variety of security measures and strive to ensure the security of your personal data
                    on our systems. User personal data is contained behind secured networks and is only accessible by a
                    limited number of employees who have special access rights to such systems.</p>
                <p>You should be aware, however, that no method of transmission over the Internet or method of
                    electronic storage is completely secure. While security cannot be guaranteed, we strive to protect
                    the security of your information and are constantly reviewing and enhancing our information security
                    measures.</p>
                <p><strong>Third party&rsquo;s personal data </strong></p>
                <p>In the event you have provided us with personal data relating to third parties (for example about
                    your spouse or children or the authorised persons or directors from an organisation or company) in
                    connection with the services or products requested by you, you confirm that you have (i) obtained
                    such individuals consent or are otherwise entitled to provide the individuals personal data to us
                    for us to process and use accordingly, and (ii) informed the relevant individuals of our policy on
                    personal data and referred them to this Privacy Policy.</p>
                <p><strong>Right to access and correct personal data </strong></p>
                <p>You have a right to request access to, request for a copy of and to request a correction of the
                    personal data and to contact us with any inquiries or complaints in respect of your personal data.
                    Subject to our right to rely on any statutory exemptions and/or exceptions to collect, use and
                    disclose your personal data, you have the right at any time to request us to limit the processing
                    and use of your personal data.</p>
                <p>Where permitted by the Privacy Laws, we reserve the right to charge a reasonable administrative fee
                    for retrieving your personal data records. If so, we will inform you of the fee before processing
                    your request.</p>
                <p><strong>Withdrawal of consent </strong></p>
                <p>You may communicate the withdrawal of your consent to the continued use, disclosure, storing and/or
                    processing of your personal data by contacting us using the contact details below, subject to the
                    conditions and/or limitations imposed by applicable laws or regulations.</p>
                <p>Please note that if you communicate your withdrawal of your consent to our use, disclosure, storing
                    or processing of your personal data for the purposes and in the manner as stated above or exercise
                    your other rights as available under applicable local laws, we may not be in a position to continue
                    to provide the Services to you or perform any contract we have with you, and we will not be liable
                    in the event that we do not continue to provide the Services to, or perform our contract with you.
                    Our legal rights and remedies are expressly reserved in such an event.</p>
                <p><strong>Minors</strong></p>
                <p>We do not sell products to minors (which is to be determined based on the applicable law), nor do we
                    intend to provide any of the Services or the use of our website to minors. We do not knowingly
                    collect any personal data relating to minors.</p>
                <p>You hereby confirm and warrant that you are above the age of minority and you are capable of
                    understanding and accepting the terms of this Privacy Policy. If you are a minor, you may use our
                    website only with the involvement of a parent or legal guardian.</p>
                <p>As a parent or legal guardian, please do not allow minors under your care to submit personal data to
                    us. In the event that such personal data of a minor is disclosed to us, you hereby consent to the
                    processing of the minor&rsquo;s personal data and accept and agree to be bound by this Privacy
                    Policy and take responsibility for his or her actions.</p>
                <p>We will not be responsible for any unauthorised use of the Services on our website by yourself, users
                    who act on your behalf or any unauthorised users. It is your responsibility to make your own
                    informed decisions about the use of the Services on our website and take necessary steps to prevent
                    any misuse of the Services on our website.</p>
                <p><strong>Third party sites</strong></p>
                <p>Our website may contain links to other websites operated by other parties, such as our business
                    affiliates, merchants or payment gateways. We are not responsible for the privacy practices of
                    websites operated by these other parties. You are advised to check on the applicable privacy
                    policies of those websites to determine how they will handle any information they collect from
                    you.</p>
                <p><strong>Disclaimer regarding security and third party sites</strong></p>
                <p>WE DO NOT GUARANTEE THE SECURITY OF PERSONAL DATA AND/OR OTHER INFORMATION THAT YOU PROVIDE ON THIRD
                    PARTY SITES. We do implement a variety of security measures to maintain the safety of your personal
                    data that is in our possession or under our control. Your personal data is contained behind secured
                    networks and is only accessible by a limited number of persons who have special access rights to
                    such systems, and are required to keep the personal data confidential. When you place orders or
                    access your personal data, we offer the use of a secure server. All personal data or sensitive
                    information you supply is encrypted into our databases to be only accessed as stated above.</p>
                <p>In an attempt to provide you with increased value, we may choose various third party websites to link
                    to, and frame within, our website. We may also participate in co-branding and other relationships to
                    offer e-commerce and other services and features to our visitors. These linked sites have separate
                    and independent privacy policies as well as security arrangements. Even if the third party is
                    affiliated with us, we have no control over these linked sites, each of which has separate privacy
                    and data collection practices independent of us. Data collected by our co-brand partners or third
                    party web sites (even if offered on or through our website) may not be received by us.</p>
                <p>We therefore have no responsibility or liability for the content, security arrangements (or lack
                    thereof) and activities of these linked sites. These linked sites are only for your convenience and
                    you therefore access them at your own risk. Nonetheless, we seek to protect the integrity of our
                    website and the links placed upon each of them and therefore welcome any feedback about these linked
                    sites (including, without limitation, if a specific link does not work).</p>
                <p><strong>Requests or queries </strong></p>
                <p>The abovementioned requests or queries or any queries relating to the collection and processing of
                    personal data should be in writing or electronic mail and addressed to pdpa@industry2u.asia.</p>
                <p><strong>Severability</strong></p>
                <p>We have made every effort to ensure that this Privacy Policy adheres strictly with the relevant
                    provisions of Privacy Laws and other applicable laws. However, in the event that any of these
                    provisions are found to be unlawful, invalid or otherwise unenforceable, that provision is to be
                    deemed severed from this Privacy Policy and shall not affect the validity and enforceability of the
                    rest of this Privacy Policy. This clause shall apply only within jurisdictions where a particular
                    term is illegal.</p>
                <p><strong>Changes to </strong><strong>Privacy Policy</strong></p>
                <p>We reserve the right to amend this Privacy Policy at any time. We will notify you of any amendments
                    to this Privacy Policy via announcements on our website or through any other mode we view
                    appropriate and suitable.</p>
                <p><strong>English version shall prevail </strong></p>
                <p>In accordance with Section 7(3) of the Personal Data Protection Act 2010, this Privacy Policy is
                    issued in both English and Bahasa Malaysia. In the event of any inconsistencies or discrepancies
                    between the English version and the Bahasa Malaysia version, the English version shall prevail. For
                    avoidance of doubt, the fact that you do use, participate in or benefit from our services shall
                    constitute a valid and acceptable proof of your unconditional consent to or approval of the content
                    of this Privacy Policy including the aforesaid amendment from time to time.</p>
                <p>&nbsp;</p>
                <p>Version dated 15 November 2020</p>
            </div>
        </div>
    </div>
    </div>
@endsection
