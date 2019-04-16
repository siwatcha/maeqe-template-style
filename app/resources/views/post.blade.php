<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Template</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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

            .pagination {
                padding-top: 30px;
                padding-bottom: 50px;
                width: 100%;
                display: inline-block;
            }

            .pagination .list-page {
                display: table;
                margin: 0 auto;
            }

            .pagination a {
                color: black;
                float: left;
                padding: 8px 16px;
                text-decoration: none;
            }

            a.page-btn {
                font-weight: bold;
            }

            .pagination a.active {
                color: white;
                background-color: red;
                border-radius: 50%;
            }

            .media-body{
                padding-left: 20px;
            }

            .list-group {
                padding-top: 25px;
            }

            .list-group a{
                box-shadow: 5px 5px 10px #E4E4E4;
                margin-top: 15px;
            }

            .list-group a:nth-child(even){
                background: #ECECEC;
            }
            
            .img-author {
                border-radius: 50%;
                width: 50%;
                padding-bottom: 10px;
            }

            .author {
                padding-top: 10px;
                text-align: center;
                border-left: 1px solid #C2C2C2;
            }

            .author p {
                font-weight: bold;

            }
            
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.page-btn').on('click', function(){
                    $(this).addClass('active');
                });
                $('.previous').on('click', function() {
                    text = $('.pagination').find('.active').text();
                    page = parseInt(text) - 1;
                    if(text != '1') {
                        location.href = "http://localhost:8000/post?page="+ page ;
                    }
                });
                $('.next').on('click', function() {
                    text = $('.pagination').find('.active').text();
                    last_page = $('.last-page').val();
                    page = parseInt(text) + 1;
                    if(text != last_page) {
                        location.href = "http://localhost:8000/post?page="+ page ;
                    }
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="list-group">
                @foreach ($posts['datas'] as $post)
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="media">
                            <img src="{{ $post['image_url'] }}" class="img-thumbnail">
                        <div class="media-body" style="color:black">
                            <h4 class="mt-0" style="font-weight: bold">{{ $post['title'] }}</h5>
                            {{ $post['body'] }}  
                            <p style="padding-top:5px">
                                <span class="glyphicon glyphicon-time text-muted"></span>
                                <small class="text-muted">{{ $post['created_at'] }}</small>
                            </p>              
                        </div>
                        <div class="ml-3 author">
                            <img src="{{ $post['author']['avatar_url'] }}" class="img-author">
                            <p style="color:red">{{ $post['author']['name'] }}</p>
                            <p>{{ $post['author']['role'] }}</p>
                            <p>
                                <span class="glyphicon glyphicon-map-marker"></span>
                                {{ $post['author']['place'] }}
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="pagination">
                <div class="list-page">
                <input type="hidden" class="last-page" value={{ $posts['last_page'] }} >
                <a class="previous" style="font-weight: bold" href="#">Previous</a>
                @for($i = 0; $i < $posts['last_page']; $i++)
                    @if($posts['page'] == $i + 1)
                        <a class="page-btn active" href="http://localhost:8000/post?page={{ $i + 1 }}">{{ $i + 1 }}</a>
                    @else
                        <a class="page-btn" href="http://localhost:8000/post?page={{ $i + 1 }}">{{ $i + 1 }}</a>
                    @endif
                @endfor
                <a class="next" style="font-weight: bold" href="#">Next</a>
                <div>
            </div>
        </div>
    </body>
</html>