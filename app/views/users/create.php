<!DOCTYPE html>
<html>
<head>
    <title>Register New Band</title>
    <style>
        * { box-sizing: border-box; }
        body { 
            margin: 0; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #e0e0e0; 
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
        }
        .bg-decor { 
            position: fixed; 
            inset: 0; 
            z-index: -1; 
            pointer-events: none; 
            background:
                radial-gradient(800px 800px at 20% 30%, rgba(255,69,0,.08), transparent 70%),
                radial-gradient(600px 600px at 80% 20%, rgba(255,215,0,.06), transparent 60%),
                radial-gradient(400px 400px at 40% 70%, rgba(138,43,226,.08), transparent 50%),
                radial-gradient(500px 500px at 90% 80%, rgba(255,105,180,.06), transparent 60%);
            animation: rockBg 20s ease-in-out infinite alternate; 
        }
        .container { max-width: 720px; margin: 40px auto; padding: 0 16px; }
        .card { 
            background: linear-gradient(145deg, #2c2c54 0%, #232347 100%); 
            border: 2px solid #40407a; 
            border-radius: 16px; 
            box-shadow: 
                0 15px 40px rgba(0,0,0,.4), 
                0 5px 15px rgba(255,69,0,.1),
                inset 0 1px 0 rgba(255,255,255,.1); 
            overflow: hidden; 
            transform: translateY(12px); 
            opacity: 0; 
            animation: cardRockIn .8s ease-out forwards; 
        }
        .card-header { 
            padding: 20px 24px; 
            border-bottom: 2px solid #40407a; 
            background: linear-gradient(135deg, #2c2c54 0%, #40407a 100%);
            position: relative;
            overflow: hidden;
        }
        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,215,0,.1), transparent);
            animation: shine 3s infinite;
        }
        .title { 
            margin: 0; 
            font-size: 24px; 
            color: #ffd700; 
            font-weight: 800; 
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0,0,0,.5);
        }
        .subtitle {
            margin: 4px 0 0 0;
            font-size: 14px;
            color: #b19cd9;
            font-weight: 400;
        }
        .card-body { 
            padding: 24px; 
            animation: fadeIn .8s ease .2s both; 
            background: linear-gradient(145deg, #2c2c54 0%, #232347 100%); 
        }
        .form-group { margin-bottom: 20px; }
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            color: #b19cd9; 
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        input[type="text"], input[type="email"] { 
            width: 100%; 
            max-width: 420px; 
            padding: 14px 16px; 
            border: 2px solid #40407a; 
            border-radius: 10px; 
            background: linear-gradient(145deg, #1e1e42 0%, #232347 100%); 
            color: #e0e0e0;
            font-size: 16px;
            transition: all .3s ease; 
            box-shadow: inset 0 2px 4px rgba(0,0,0,.3);
        }
        input[type="text"]:focus, input[type="email"]:focus { 
            outline: none; 
            border-color: #ffd700; 
            box-shadow: 
                0 0 0 3px rgba(255,215,0,.2),
                inset 0 2px 4px rgba(0,0,0,.3),
                0 4px 12px rgba(255,215,0,.1); 
            background: linear-gradient(145deg, #232347 0%, #2c2c54 100%);
        }
        input[type="text"]::placeholder, input[type="email"]::placeholder {
            color: #706fd3;
        }
        .actions { display: flex; gap: 12px; margin-top: 16px; }
        .btn { 
            display: inline-block; 
            padding: 14px 24px; 
            text-decoration: none; 
            border-radius: 12px; 
            border: 2px solid transparent; 
            font-size: 14px; 
            font-weight: 700; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(0,0,0,.3); 
            transition: all .15s ease; 
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width .3s ease, height .3s ease;
        }
        .btn:hover::before {
            width: 300px;
            height: 300px;
        }
        .btn:active { 
            transform: translateY(2px); 
            box-shadow: 0 2px 6px rgba(0,0,0,.4); 
        }
        .btn-primary { 
            background: linear-gradient(135deg, #ff4757 0%, #ff3742 100%); 
            color: white; 
            border-color: #ff3742;
            text-shadow: 0 1px 2px rgba(0,0,0,.3);
        }
        .btn-primary:hover { 
            background: linear-gradient(135deg, #ff3742 0%, #e23e3e 100%); 
            border-color: #e23e3e;
            box-shadow: 0 6px 20px rgba(255,71,87,.3);
        }
        .btn-secondary { 
            background: linear-gradient(135deg, #706fd3 0%, #5f5fc4 100%); 
            color: white; 
            border-color: #5f5fc4;
            text-shadow: 0 1px 2px rgba(0,0,0,.3);
        }
        .btn-secondary:hover { 
            background: linear-gradient(135deg, #5f5fc4 0%, #4834d4 100%); 
            border-color: #4834d4;
            box-shadow: 0 6px 20px rgba(112,111,211,.3);
        }

        @keyframes cardRockIn { to { transform: translateY(0); opacity: 1; } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes rockBg { 
            0% { background-position: 0% 0%, 100% 0%, 0% 100%, 100% 100%; } 
            100% { background-position: 15% 10%, 85% 15%, 10% 85%, 90% 90%; } 
        }
        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }
    </style>
</head>
<body>
    <div class="bg-decor"></div>
    <div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="title">🎸 Register New Band</h1>
            <p class="subtitle">Join the musical revolution</p>
        </div>
        <div class="card-body">
            <form action="<?= site_url('users/create') ?>" method="POST">
                <div class="form-group">
                    <label for="username">Band Name</label>
                    <input type="text" name="username" id="username" placeholder="Enter your band name..." required>
                </div>
                <div class="form-group">
                    <label for="email">Contact Email</label>
                    <input type="email" name="email" id="email" placeholder="band@rockmail.com" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">🎵 Register Band</button>
                    <a href="<?= site_url('users/view') ?>" class="btn btn-secondary">← Back to Roster</a>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>