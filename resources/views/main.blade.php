<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to the Calligraphy home</title>
    <!--ink rel="stylesheet" href="">

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style-->

        <link rel="stylesheet" href="/css/app.css" />
        <link rel="stylesheet" href="/css/all.css" />
</head>
<body>

    @include ('navbar')

    <div class='container'>

        @include('flash')

        @yield('content')

    </div>
    <div class='footer'>
        @yield('footer')
    </div>

    <script src="/js/all.js"></script>
    <script>
        $('div.alert').not('.alert-important').delay(3000).slideUp(300);

        // $('#tag_list').select2({
        //     placeholder: "Select a tag",
        //     tags: true
        // });
        $('#tag_list').select2({
            placeholder: "Select a tag"
        });
    </script>

</body>
</html>