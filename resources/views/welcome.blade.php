<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            button{
                color:#b91d19;
            }
            @media (min-width: 1200px){
                .container {
                    width: 500px;
                    margin-top: 100px;
                }
                button{
                    margin-top:10px;
                }
            }
            button{
                margin-left: 50px;
            }
        </style>
    </head>

    <body>
        <div class="position-ref full-height" id="app">
            <div class="container">
                <img src="https://image.freepik.com/free-vector/instagram-icon_1057-2227.jpg" alt="instagram-image" height="300px" width="300px">
                    <button class="btn instagrame-login" onclick="sendToInstagram()">Fetch your Instagram pictures</button>
            </div>
        </div>

        <script>
             function sendToInstagram(){
                 window.location =  "{{ request()->instagram_auth_url }}"
             }

        </script>
    </body>
</html>
