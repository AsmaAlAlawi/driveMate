<!--<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحويل للصفحة الرئيسية</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script>
        window.location.href = "{{ route('home') }}";
    </script>
</head>
<body>
    <p>جاري التحويل...</p>



        <script src="js/instructorsrating.js"></script>
</body>
</html>

-->$_COOKIE

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحويل للصفحة الرئيسية</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .redirect-card {
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            text-align: center;
        }

        .redirect-card h2 {
            margin: 0 0 10px;
            color: #6D1B2D;
        }

        .redirect-card p {
            margin: 0 0 15px;
            color: #555;
        }

        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #6D1B2D;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <script>
        setTimeout(function() {
            window.location.href = "{{ route('home') }}";
        }, 1000);
    </script>
</head>
<body>
    <div class="redirect-card">
        <h2>جاري التحويل…</h2>
        <p>سوف يتم تحويلك للصفحة الرئيسية خلال لحظات</p>
        <div class="loader"></div>
    </div>

    <script src="{{ asset('js/instructorsrating.js') }}"></script>
</body>
</html>
