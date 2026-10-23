
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'begum | Haber ve Makale')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: #F7F5EF;
            color: #343330;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.7;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button, input, textarea, select {
            font: inherit;
        }

        .site-header {
            border-bottom: 1px solid #E4E0D5;
            background: #F7F5EF;
        }

        .header-inner {
            width: min(1180px, calc(100% - 48px));
            min-height: 88px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            display: inline-flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .brand-name {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 34px;
            font-weight: bold;
            letter-spacing: -2px;
        }

        .brand-caption {
            margin-top: 7px;
            color: #77746D;
            font-size: 9px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .header-nav {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 24px;
            flex-wrap: wrap;
        }

        .nav-link,
        .nav-button {
            color: #343330;
            font-size: 13px;
        }

        .nav-link:hover,
        .nav-button:hover {
            opacity: .65;
        }

        .nav-admin {
            border-bottom: 1px solid #343330;
            padding-bottom: 4px;
        }

        .logout-form {
            display: inline;
            margin: 0;
        }

        .nav-button {
            border: 0;
            padding: 0;
            background: transparent;
            cursor: pointer;
        }

        .site-main {
            width: min(1180px, calc(100% - 48px));
            min-height: 65vh;
            margin: 0 auto;
            padding-bottom: 90px;
        }

        .hero {
            padding: 105px 0 95px;
            border-bottom: 1px solid #E4E0D5;
        }

        .eyebrow {
            margin: 0 0 18px;
            color: #77746D;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 2.2px;
            line-height: 1.7;
            text-transform: uppercase;
        }

        .hero h1,
        .page-heading h1 {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(42px, 6.5vw, 76px);
            font-weight: normal;
            letter-spacing: -2.5px;
            line-height: 1.08;
        }

        .hero-description {
            max-width: 570px;
            margin: 25px 0 0;
            color: #77746D;
            font-size: 16px;
            line-height: 1.9;
        }

        .editorial-section {
            padding-top: 65px;
        }

        .section-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 30px;
        }

        .section-heading .eyebrow {
            margin-bottom: 8px;
        }

        .section-heading h2 {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(28px, 4vw, 40px);
            font-weight: normal;
            letter-spacing: -1px;
        }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 32px;
        }

        .category-link {
            display: inline-block;
            padding: 8px 15px;
            border: 1px solid #E4E0D5;
            border-radius: 30px;
            color: #77746D;
            font-size: 12px;
        }

        .category-link:hover,
        .category-link.active {
            border-color: #292824;
            background: #292824;
            color: #FFFEFA;
        }

        .post-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .post-card {
            display: flex;
            min-height: 285px;
            flex-direction: column;
            justify-content: space-between;
            padding: 26px;
            border: 1px solid #E4E0D5;
            background: #FFFEFA;
            transition: transform .2s ease, border-color .2s ease;
        }

        .post-card:hover {
            transform: translateY(-3px);
            border-color: #C9C2B3;
        }

        .post-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .post-number {
            color: #A49E91;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 18px;
        }

        .post-category {
            padding: 5px 9px;
            background: #F0EDE3;
            color: #77746D;
            font-size: 10px;
        }

        .post-card-content h3 {
            margin: 28px 0 12px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 25px;
            font-weight: normal;
            line-height: 1.3;
            overflow-wrap: anywhere;
        }

        .post-card-content p {
            margin: 0 0 24px;
            color: #77746D;
            font-size: 13px;
            line-height: 1.8;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #E5C85A;
            padding-bottom: 5px;
            font-size: 12px;
            font-weight: bold;
        }

        .read-more span {
            font-size: 17px;
        }

        .button {
            display: inline-flex;
            min-height: 44px;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 11px 19px;
            border: 1px solid transparent;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
        }

        .button-yellow {
            background: #E5C85A;
            color: #292824;
        }

        .button-yellow:hover {
            background: #D8B947;
        }

        .button-dark {
            background: #292824;
            color: #FFFEFA;
        }

        .button-dark:hover {
            background: #48463F;
        }

        .button-outline {
            border-color: #E4E0D5;
            background: transparent;
            color: #343330;
        }

        .button-outline:hover {
            background: #EFEBE1;
        }

        .empty-state {
            grid-column: 1 / -1;
            padding: 55px 30px;
            border: 1px solid #E4E0D5;
            background: #FFFEFA;
            text-align: center;
        }

        .empty-state h3 {
            margin: 0 0 10px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 26px;
            font-weight: normal;
        }

        .empty-state p:not(.eyebrow) {
            color: #77746D;
            font-size: 13px;
        }

        .page-section {
            max-width: 780px;
            margin: 0 auto;
            padding-top: 75px;
        }

        .page-heading {
            margin-bottom: 35px;
        }

        .page-heading .eyebrow {
            margin-bottom: 12px;
        }

        .page-heading h1 {
            font-size: clamp(36px, 5vw, 54px);
        }

        .page-heading > p:last-child {
            color: #77746D;
            font-size: 14px;
        }

        .form-card {
            padding: 32px;
            border: 1px solid #E4E0D5;
            background: #FFFEFA;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: bold;
        }

        .form-control {
            display: block;
            width: 100%;
            min-height: 46px;
            padding: 12px 14px;
            border: 1px solid #E4E0D5;
            border-radius: 0;
            outline: none;
            background: #FFFEFC;
            color: #343330;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #9B927D;
            box-shadow: 0 0 0 2px rgb(229 200 90 / 18%);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
            line-height: 1.7;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 28px;
        }

        .form-error {
            margin: 6px 0 0;
            color: #A33B32;
            font-size: 12px;
        }

        .notice {
            margin-bottom: 24px;
            padding: 15px 18px;
            border: 1px solid #D8B7B1;
            background: #FBF0ED;
            color: #842E27;
            font-size: 13px;
        }

        .notice p {
            margin: 3px 0;
        }

        .notice-success {
            border-color: #C8D7C0;
            background: #F0F5EC;
            color: #38552F;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #E4E0D5;
            background: #FFFEFA;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13px;
        }

        .admin-table th,
        .admin-table td {
            padding: 17px 16px;
            border-bottom: 1px solid #E4E0D5;
            vertical-align: top;
        }

        .admin-table th {
            background: #F0EDE5;
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .admin-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .table-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .text-link {
            color: #343330;
            font-size: 12px;
            text-decoration: underline;
            text-decoration-color: #E5C85A;
            text-underline-offset: 4px;
            cursor: pointer;
        }

        .text-danger {
            color: #A33B32;
        }

        .article-detail {
            max-width: 790px;
            margin: 0 auto;
            padding-top: 55px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #77746D;
            font-size: 12px;
        }

        .back-link:hover {
            color: #343330;
        }

        .article-header {
            padding: 60px 0 35px;
        }

        .article-header h1 {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(38px, 6vw, 66px);
            font-weight: normal;
            letter-spacing: -1.8px;
            line-height: 1.15;
            overflow-wrap: anywhere;
        }

        .article-category {
            margin-bottom: 18px;
        }

        .article-excerpt {
            margin-top: 22px;
            color: #77746D;
            font-size: 17px;
            line-height: 1.9;
        }

        .article-divider {
            width: 65px;
            height: 3px;
            margin-top: 32px;
            background: #E5C85A;
        }

        .article-content {
            color: #46443E;
            font-size: 16px;
            line-height: 2;
            overflow-wrap: anywhere;
            white-space: pre-line;
        }

        .article-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 60px;
            padding-top: 25px;
            border-top: 1px solid #E4E0D5;
        }

        .article-footer .eyebrow {
            margin: 0;
        }

        .site-footer {
            border-top: 1px solid #E4E0D5;
        }

        .footer-inner {
            display: flex;
            width: min(1180px, calc(100% - 48px));
            min-height: 110px;
            margin: 0 auto;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .footer-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 23px;
            font-weight: bold;
            letter-spacing: -1px;
        }

        .footer-note {
            margin: 0;
            color: #77746D;
            font-size: 11px;
            text-align: right;
        }

        @media (max-width: 850px) {
            .post-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .hero {
                padding: 75px 0 65px;
            }

            .header-inner {
                min-height: 80px;
            }

            .header-nav {
                gap: 14px;
            }
        }

        @media (max-width: 600px) {
            .header-inner,
            .site-main,
            .footer-inner {
                width: calc(100% - 32px);
            }

            .header-inner {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px 0;
                gap: 18px;
            }

            .brand-name {
                font-size: 30px;
            }

            .header-nav {
                width: 100%;
                justify-content: flex-start;
                gap: 16px;
            }

            .nav-link,
            .nav-button {
                font-size: 12px;
            }

            .hero {
                padding: 58px 0 50px;
            }

            .hero h1 {
                font-size: 44px;
                letter-spacing: -1.5px;
            }

            .hero-description {
                font-size: 14px;
            }

            .editorial-section {
                padding-top: 45px;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .post-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .post-card {
                min-height: 245px;
                padding: 22px;
            }

            .page-section {
                padding-top: 48px;
            }

            .form-card {
                padding: 22px 18px;
            }

            .article-header {
                padding-top: 42px;
            }

            .article-header h1 {
                font-size: 40px;
            }

            .article-content {
                font-size: 15px;
            }

            .footer-inner {
                align-items: flex-start;
                flex-direction: column;
                justify-content: center;
                padding: 25px 0;
                gap: 8px;
            }

            .footer-note {
                text-align: left;
            }

            .admin-table th,
            .admin-table td {
                padding: 12px;
            }
        }
    </style>
</head>

<body>
<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="{{ route('home') }}" aria-label="begum ana sayfa">
            <span class="brand-name">begum.</span>
            <span class="brand-caption">Haber · Makale</span>
        </a>

        <nav class="header-nav" aria-label="Ana menü">
            <a class="nav-link" href="{{ route('home') }}">Ana Sayfa</a>

            @if (session('admin_logged_in'))
                <a class="nav-link nav-admin" href="{{ route('admin.posts.index') }}">
                    Haberleri Yönet
                </a>

                <form class="logout-form" method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="nav-button" type="submit">Çıkış Yap</button>
                </form>
            @else
                <a class="nav-link" href="{{ route('admin.login') }}">
                    Yönetici Girişi
                </a>
            @endif
        </nav>
    </div>
</header>

<main class="site-main">
    @yield('content')
</main>

<footer class="site-footer">
    <div class="footer-inner">
        <a class="footer-brand" href="{{ route('home') }}">begum.</a>
    </div>
</footer>
</body>
</html>
