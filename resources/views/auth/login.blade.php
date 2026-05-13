<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #706ad8, #3a40ed);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* card */
        .login-card{
            background: white;
            width: 800px;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        /* title */
        .title{
            text-align: center;
            margin-bottom: 25px;
        }

        .title h2{
            color: #333;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .title p{
            color: #777;
            font-size: 14px;
        }

        /* labels */
        label{
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: 600;
            color: #444;
        }

        /* inputs */
        input{
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            outline: none;
            transition: 0.3s;
            font-size: 14px;
        }

        input:focus{
            border-color: #4f46e5;
            box-shadow: 0 0 8px rgba(79,70,229,0.3);
        }

        /* button */
        button{
            width: 100%;
            margin-top: 22px;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #4f46e5;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover{
            background: #372fcf;
            transform: translateY(-2px);
        }

        /* error */
        .error-text{
            display: block;
            margin-top: 6px;
            color: #dc3545;
            font-size: 13px;
            font-weight: 600;
            background: #ffe5e5;
            padding: 7px 10px;
            border-radius: 6px;
            border-left: 4px solid #dc3545;
        }

        /* small decoration */
        .emoji{
            font-size: 45px;
            text-align: center;
            margin-bottom: 10px;
            color: #4f46e5;
        }
    </style>
</head>
<body>

    <div class="login-card">

        <div class="emoji"><i class="fa-solid fa-hand-holding-medical"></i></div>

        <div class="title">
            <h2>Bonjour !</h2>
            <p>Connectez-vous à votre compte</p>
        </div>

        <form action="{{ route('login') }}" method="post">
            @csrf

            <label>Email</label>
            <input type="email" name="email" placeholder="Entrez votre email">

            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <label>Mot de Passe</label>
            <input type="password" name="password" placeholder="Entrez votre mot de passe">

            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <button type="submit">
                Se connecter
            </button>
        </form>

    </div>

</body>
</html>