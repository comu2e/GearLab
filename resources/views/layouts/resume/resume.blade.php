<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Resume</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet"
          type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset("css/resume_styles.css")}}" rel="stylesheet"/>
</head>
<body id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="{{url('/')}}"><i class="fa fa-home" size=120%></i></a>

    <a class="navbar-brand js-scroll-trigger" href="#page-top">

        <span class="d-block d-lg-none">高橋　英士</span>
        <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                                             src={{asset('img/profile.jpeg')}} alt=""/></span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
            class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#experience">Experience</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#education">Education</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#skills">Skills</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#interests">Interests</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#awards">Awards</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a></li>
        </ul>
    </div>
</nav>
<!-- Page Content-->
<div class="container-fluid p-0">
    <!-- About-->
    <section class="resume-section" id="about">
        <div class="resume-section-content">
            <h1 class="mb-0">
                高橋
                <span class="text-primary">英士</span>
            </h1>

            <p class="lead mb-5">私はものづくりをすることが大好きです。幼い頃から電子工作・プログラミング・実家の山・竹林でブッシュクラフト
                などをしてきました。
                現在は東洋紡にて透析膜の製造管理を仕事としています。
            <div class="social-icons">
                <a class="social-icon" href="https://github.com/comu2e"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </section>
    <hr class="m-0"/>
    <!-- Experience-->
    <section class="resume-section" id="experience">
        <div class="resume-section-content">
            <h2 class="mb-5">経歴</h2>
            <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                <div class="flex-grow-1">
                    <h3 class="mb-0">製造管理職</h3>
                    <div class="subheading mb-3">透析膜製造</div>
                    <p>工場での自社内/お客様の歩留まり改善を行っています。</p>
                </div>
                <div class="flex-shrink-0"><span class="text-primary">2017/5- 現在</span></div>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                <div class="flex-grow-1">
                    <h3 class="mb-0">研究開発職</h3>
                    <div class="subheading mb-3">ガス分離膜/新規透析膜</div>
                    <p>研究所にてガス分離膜の研究開発を行っていました。</p>
                </div>
                <div class="flex-shrink-0"><span class="text-primary"> 2016/4- 2017/5</span></div>
            </div>

        </div>
    </section>
    <hr class="m-0"/>
    <!-- Education-->
    <section class="resume-section" id="education">
        <div class="resume-section-content">
            <h2 class="mb-5">教育</h2>


            <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                <div class="flex-grow-1">
                    <h3 class="mb-0">京都工芸繊維大学</h3>
                    <div class="subheading mb-3">2016:材料制御課程　修士課程　修了</div>
                    <div>物性物理学　-Polyacrylonitrile のガラス転移近傍における 緩和時間の温度変調に対する追随性の研究
                        -
                    </div>
                    <div class="subheading mb-3">2014:高分子機能工学課程　卒業</div>

                </div>
                <div class="flex-shrink-0"><span class="text-primary"> 2010/4 - 2016/3</span></div>
            </div>


            <div class="d-flex flex-column flex-md-row justify-content-between">
                <div class="flex-grow-1">
                    <h3 class="mb-0">私立　京都共栄学園　高等学校卒業</h3>

                </div>
                <div class="flex-shrink-0"><span class="text-primary">2006/4-  2009 3</span></div>
            </div>
        </div>
    </section>
    <hr class="m-0"/>
    <!-- Skills-->
    <section class="resume-section" id="skills">
        <div class="resume-section-content">
            <h2 class="mb-5">スキル</h2>
            <div class="subheading mb-3">プログラミング言語＆ツール</div>
            <ul class="list-inline dev-icons">
                <div>
                    <li class="list-inline-item"><i class="fab fa-html5"></i></li>
                    <li class="list-inline-item"><i class="fab fa-css3"></i></li>
                </div>
                <hr>
                <div>
                    <li class="list-inline-item"><i class="fab fa-php"></i></li>
                    <li class="list-inline-item"><i class="fab fa-python"></i></li>
                    <li class="list-inline-item"><i class="fab fa-swift"></i></li>
                    <li class="list-inline-item"><i class="fab fa-js"></i></li>
                </div>
                <div>
                    <li class="list-inline-item"><i class="fab fa-laravel"></i></li>
                    <li class="list-inline-item"><i class="fab fa-vuejs"></i></li>

                </div>
                <hr>
                <li class="list-inline-item"><i class="fab fa-git"></i></li>
                <li class="list-inline-item"><i class="fab fa-github"></i></li>
                <li class="list-inline-item"><i class="fab fa-docker"></i></li>
                <hr>
                <div>
                    <li class="list-inline-item"><i class="fab fa-aws"></i>
                    </li>
                    <small>EC2/VPC/S3/ECS・ECR</small>
                </div>
                <hr>
            </ul>
            <h class="subheading mb-3">資格</h>
            <ul class="list-inline dev-icons">
                <li class="list-inline-item">QC検定2級　2020年3月取得</li>
                <li class="list-inline-item">TOEIC®Listening&Readingスコア 805点　2016年取得</li>

                <hr>
            </ul>
        </div>
    </section>
    <hr class="m-0"/>
    <!-- Interests-->
    <section class="resume-section" id="interests">
        <div class="resume-section-content">
            <h2 class="mb-5">趣味・興味</h2>
            <p>
                山口県岩国市に転勤してからはアウトドアの趣味がメインで毎週キャンプ・山登りを楽しんでいます。
            </p>
            <p class="mb-0">
                インドアではpythonを用いた機械学習や統計などの勉強をしています。
                また、時々paizaを使った競技プログラミングなどもしています。(現在Aランクです)
                <a href=""></a>
            </p>
        </div>
    </section>
    <hr class="m-0"/>
    <!-- Awards-->
    <section class="resume-section" id="awards">
        <div class="resume-section-content">
            <h2 class="mb-5">受賞経験</h2>
            <ul class="fa-ul mb-0">
                <li>
                    <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                    　優勝　受賞　2017年11月11日 Yahoo×KITハッカソン
                    <div>
                        <img src="{{asset('img/hackthon.jpg')}}" alt="" width="30%">

                    </div>
                    　
                </li>
                <li>
                    <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                    グッドパッチ賞　受賞　2017年2月11日HackOsaka & MonozukuriHub　MeetUp
                    <div>
                        <img src="{{asset('img/goodpatch.jpg')}}" alt="" width="30%">
                    </div>
                </li>
                <li>
                    <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                    マイクロソフト賞　受賞　2016年12月19日　未来のピッチ
                    <div>
                        <img src="{{asset('img/mirai.jpg')}}" alt="" width="30%">
                    </div>

                </li>
                <li>
                    <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                    1
                    <sup>st</sup>
                    マイクロソフト賞　受賞　2016年11月5日　未来のピッチ
                    <div>
                        <img src="{{asset('img/yahoo.jpg')}}" alt="" width="30%">

                    </div>
                </li>

            </ul>
        </div>
    </section>
    <!-- Interests-->
    <section class="resume-section" id="portfolio">
        <div class="resume-section-content">
            <h2 class="mb-5">ポートフォリオ</h2>
            <h2 class="mb-10">
                <a href="{{url('/gears')}}" >
                    GearLab
                </a>
                </h2>
        </div>
    </section>
    <hr class="m-0"/>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('js/resume_scripts.js')}}"></script>
</body>
</html>
