<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="/css/main.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <h1 id="main-heading">My first blog</h1>
            <hr>
        	<div id="navigation">
                <a href="/">
                    <button type="button" class="btn btn-primary"> Home </button>
                </a>  
                @if (! \Auth::check())
            		<a href="/login">
                        <button type="button" class="btn btn-primary"> Login </button>
                    </a>
                    <a href="/register">
                        <button type="button" class="btn btn-primary"> Register </button>
                    </a>
                @else    
                    <a href="/logout">
                        <button type="button" class="btn btn-primary"> Logout </button>
                    </a>
                    <a href="/create_post">
                        <button type="button" class="btn btn-primary"> Create Post </button>
                    </a>
                    <h4 class="welcome-msg">
                        Greetings, {{ Auth::user()->name }}!!                         
                    </h4>
                @endif
                @if (session('info'))
                    <h4 class="welcome-msg">
                        {{ session('info') }}
                    </h4>
                @endif 
            </div>    
        </header>     
	</div>