<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HISMS</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #111;
            min-height: 100vh;
            overflow-x: auto;
            position: relative;
        }

        .staff {
            animation: strike 0.5s 0.5s cubic-bezier(1, 0.25, 1, 1) both;
            bottom: 15vh;
            height: 100vh;
            left: 50%;
            position: absolute;
            transform: translate(15%, 0);
            width: 200px;
        }

        .shine {
            animation: flash 2s 1s ease;
            background: #fff;
            bottom: 0;
            left: 0;
            opacity: 0;
            position: fixed;
            right: 0;
            top: 0;
        }

        .text {
            animation-name: shake;
            animation-iteration-count: 20;
            animation-timing-function: ease;
            animation-delay: 1s;
            animation-duration: 0.1s;
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-100%, -50%);
            width: 150px;
        }

        @media (min-width: 768px) {
            .text {
                width: 300px;
            }
        }

        * {
            fill: #fff;
            stroke: #fff;
        }

        @keyframes flash {
            0% {
                opacity: 0.85;
            }
            50% {
                opacity: 0.5;
            }
            75%, 100% {
                opacity: 0;
            }
        }

        @keyframes strike {
            from {
                transform: translate(15%, -100%);
            }
        }

        @keyframes shake {
            0%, 50%, 100% {
                transform: translate(-100%, -50%);
            }
            25% {
                transform: translate(-102%, -52%);
            }
            75% {
                transform: translate(-98%, -48%);
            }
        }

        .logout-form {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .logout-form button {
            border: none;
            outline: none;
            color: #fff;
            font-size: 18px;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #00bf6a;
            border-radius: 5px;
        }

        .logout-form button:hover {
            background-color: #067547;
        }
    </style>
</head>

<body>

    <x-icon404 />

    @auth
        <div class="logout-form">
            <form method="POST" action="{{ route('logout') }}" x-data class="absolute top-5 right-5">
                @csrf
                <button type="submit" class="text-gray-600 hover:text-kaitoke-green-600 inline-flex items-center">
                    <i class="fa-regular fa-circle-xmark text-3xl"></i>
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    @endauth

</body>
</html>
