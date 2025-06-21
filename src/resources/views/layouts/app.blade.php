
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品管理システム</title>

    {{-- BootstrapのCDN（必要な場合） --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- カスタムCSS --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    {{-- フォントやアイコンを追加したい場合 --}}
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Noto Sans JP', sans-serif; background-color: #f8f9fa;">

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('products.index') }}"></a>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    {{-- Bootstrap JS（必要な場合） --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>