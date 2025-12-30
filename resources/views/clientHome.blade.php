@extends('clientView.home')
@section('formuleClient')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Baloo+2&display=swap");

    body {
        font-family: "Baloo 2", cursive;
        font-size: 16px;
        color: #ffffff;
        text-rendering: optimizeLegibility;
        font-weight: initial;
        background-color: #f3f5f7;
    }

    .container {
        width: 90% !important;
        height: 110% !important;
        max-width: 90% !important;
        max-height: 100% !important;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
        margin: 20px;
        margin-bottom: 10px;
        /* Add a bottom margin of 10px */
        background-color: #fff;
        width: auto !important;
        max-width: 110%;
    }

    .h1 {
        margin-bottom: 30px;
        text-transform: uppercase;
        text-align: center;
        font-size: 2.5rem;
        color: #ffffff;
    }

    .postcard {
        display: flex;
        box-shadow: 0 4px 21px -12px rgba(0, 0, 0, 0.66);
        border-radius: 10px;
        margin-bottom: 20px;
        overflow: hidden;
        color: #ffffff;
        background-color: #95242a;
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .postcard:hover {
        transform: scale(1.05);
    }

    .postcard__img {
        height: 300px;
        max-height: 700px;
        width: 300px;
    }

    .postcard__text {
        padding: 20px;
    }

    .postcard__title {
        margin-bottom: 10px;
        font-size: 1.75rem;
        font-weight: bold;
        color: #ffffff !important;
    }

    .postcard__bar {
        width: 50px;
        height: 5px;
        margin: 10px 0;
        border-radius: 5px;
        background-color: #ffffff;
        transition: width 0.2s ease;
    }

    .postcard:hover .postcard__bar {
        width: 100px;
    }

    .postcard__preview-txt {
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: justify;
    }

    .postcard__tagbox {
        display: flex;
        flex-wrap: wrap;
        font-size: 14px;
        margin-top: 20px;
        padding: 0;
        justify-content: center;
    }

    .postcard__tagbox .tag__item {
        display: inline-block;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
        padding: 2.5px 10px;
        margin: 0 5px 5px 0;
        cursor: default;
        user-select: none;
        transition: background-color 0.3s;
    }

    .postcard__tagbox .tag__item:hover {
        background-color: rgba(255, 255, 255, 0.4);
    }




    #footer {
        background-color: transparent;
    }

    #footer .container-xl-custom {
        max-width: 1000px;
    }

    #footer h5 {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    #footer ul.list {
        font-size: 12px;
        margin-bottom: 10px;
    }

    #footer ul.list li {
        margin-bottom: 2px;
    }

    #footer ul.list li a {
        color: #ffffff;
    }

    #footer .social-icons a {
        margin-right: 6px;
    }

    .footer-bottom {
        padding: 5px 0;
        background-color: #f8f9fa;
    }

    .footer-bottom .logo-link img {
        margin-bottom: 5px;
    }

    .footer-bottom p {
        font-size: 10px;
        color: #6c757d;
        margin-bottom: 0;
    }

    @media (max-width: 767px) {
        #footer .container-xl-custom {
            padding-left: 10px;
            padding-right: 10px;
        }

        #footer .col-md-4 {
            flex: 0 0 50%;
            max-width: 50%;
            margin-bottom: 10px;
        }

        .footer-bottom .container-xl-custom {
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>
<div class="container">
    <div class="card">
        <section class="light">
            <div class="container py-2">
                <div class="h1 text-center text-dark" id="pageHeaderTitle">ABOUT US</div>

                <article class="postcard light blue">
                    <a class="postcard__img_link" href="#">
                        <img class="postcard__img" src="dist/img/téléchargement (3).jpeg" alt="Image Title" />
                    </a>
                    <div class="postcard__text ">
                        <h1 class="postcard__title "><a href="#">Transit in Time</a></h1>
                        <div class="postcard__subtitle small">

                        </div>
                        <div class="postcard__bar"></div>
                        <div class="postcard__preview-txt">Founded in 1994 by Mr. Vicente Javier Benavent, Puerto
                            transit
                            operates in transit, national and international transport, consignment and customs
                            consulting,
                            Puerto Transit has been able to position itself in the market through high quality services,
                            which
                            mark their evolution through a strategic renewal designed by Mr. Ismail Ettahiri, the
                            Managing
                            director. This strategy is part of a continuity of adapting to changes in the market, and
                            responding
                            to the perpetual requests of our customers.</div>


                    </div>
                </article>
                <article class="postcard light green">
                    <a class="postcard__img_link" href="#">
                        <img class="postcard__img" src="dist/img/generic2.jpg" alt="Image Title" />
                    </a>
                    <div class="postcard__text t-dark">
                        <h1 class="postcard__title green"><a href="#">Services</a></h1>
                        <div class="postcard__subtitle small">

                        </div>
                        <div class="postcard__bar"></div>
                        <div class="postcard__preview-txt">Today, we are proud of our ability to offer a complete
                            service
                            that
                            allows our customers to rely on a single service provider, while optimizing the most
                            critical
                            international issues, in particular cost and time, with regard to the performance of our
                            services,
                            they have been approved by numerous certifications, also our reference customers perpetually
                            confirm
                            their satisfaction.
                            After 28 years of activity, we still aspire to develop our technical and human resources to
                            evolve
                            hand in hand with our customers, and participate in the prosperity of their greatest
                            ambitions.
                        </div>

                    </div>
                </article>
                <article class="postcard light yellow">
                    <a class="postcard__img_link" href="#">
                        <img class="postcard__img" src="dist/img/generic-1 (1).jpg" alt="Image Title" />
                    </a>
                    <div class="postcard__text t-dark">
                        <h1 class="postcard__title yellow"><a href="#">Employee Culture</a></h1>
                        <div class="postcard__subtitle small">

                        </div>
                        <div class="postcard__bar"></div>

                        <div class="postcard__preview-txt"> “The Puerto Transit Way” is dedicated to empowering our
                            people
                            to
                            think outside of the box, we value creativity and encourage employees to wow customers every
                            step of
                            the way.

                            Puerto Transit hires people that will fit into their culture and instills their ten core
                            values
                            in
                            all new employees.

                            We wants employees to have a great time every time they come to work, and we always
                            encourage
                            employees to express themselves and showcase their personalities.
                        </div>
                    </div>
                </article>


                <article class="postcard light red">
                    <a class="postcard__img_link" href="#">
                        <img class="postcard__img" src="dist/img/blog-post-thumb-3.jpg" alt="Image Title" />
                    </a>
                    <div class="postcard__text t-dark">
                        <h1 class="postcard__title red"><a href="#">Balance commerciale </a></h1>
                        <div class="postcard__subtitle small">

                        </div>
                        <div class="postcard__bar"></div>
                        <div class="postcard__preview-txt">
                            Les importations ont atteint en 2021 un niveau record de 526,6 MMDH, en progression de 24,5%
                            ou
                            +103,8
                            MMDH par rapport à 2020 et de 7,3% ou +35,7 MMDH par rapport à 2019. L’accroissement des
                            importations
                            est le résultat de l’augmentation des achats de la totalité des groupes de produits,
                            principalement
                            :
                            ▸ Les importations de produits finis de consommation : +30% ou +28,2 MMDH par rapport à 2020
                            et
                            +9%
                            ou
                            +10,2 MMDH par rapport à 2019
                            Au même titre que les importations, les exportations ont également affiché un niveau record
                            se
                            situant à
                            326,9 MMDH, en hausse de 24,3% ou +63,8 MMDH par rapport à 2020 et de 15% ou +42,4 MMDH par
                            rapport à 2019.</div>

                    </div>
                </article>
            </div>
        </section>

        <footer id="footer" class="bg-color-primary border-0 mt-0">

            <div class="footer-bottom">
                <div class="container container-xl-custom pt-2 pb-1">
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <h5 class="ls-0">OUR ADDRESS</h5>
                            <ul class="list list-unstyled">
                                <li>17, Bd Mohamed V,</li>
                                <li>Res. BOVAPES-BUILDING,</li>
                                <li>TANGIER - MOROCCO</li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <h5 class="ls-0">LINKS</h5>
                            <ul class="list list-unstyled">
                                <li><a href="about-us.html">About us</a></li>
                                <li><a href="blog.html">News</a></li>
                                <li><a href="careers.html">Careers</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <h5 class="ls-0">SERVICES</h5>
                            <ul class="list list-unstyled">
                                <li><a href="#">Customs Clearance</a></li>
                                <li><a href="#">Consignment Transport</a></li>
                                <li><a href="#">Facilities And Accompaniment</a></li>
                                <li><a href="#">Express National &amp; International Transport</a></li>
                                <li><a href="#">IT Solutions</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <h5 class="ls-0">Contact</h5>
                            <ul class="list list-unstyled">
                                <li>
                                    <span class="d-block line-height-2">Call Now</span>
                                    <a href="tel:+212539348179"
                                        class="text-color-light text-6 text-lg-4 text-xl-6 font-weight-bold">+212 539
                                        348
                                        179</a>
                                </li>
                                <li><a href="contact.html">Send a Message</a></li>
                                <span class="d-block" style="padding-top: 10px;">Follow Us</span>
                                <ul class="social-icons social-icons-clean custom-social-icons-icon-light">
                                    <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="container container-xl-custom">
                    <div class="row">
                        <div class="col">
                            <hr class="my-0 bg-color-light opacity-2">
                        </div>
                    </div>
                    <div class="row py-1">
                        <div class="col-lg-6 text-center text-lg-start">
                            <a href="index.html" class="logo-link">
                                <img alt="Puerto Transit" height="100px" src="dist/img/transit.jpg">
                            </a>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end">
                            <p class="text-5 mb-0">Transit in Time © 2023. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection
