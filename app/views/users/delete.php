<!DOCTYPE html>
<html>
<head>
    <title>Remove Band</title>
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
        .container { max-width: 600px; margin: 80px auto; padding: 0 16px; }
        .card { 
            background: linear-gradient(145deg, #2c2c54 0%, #232347 100%); 
            border: 2px solid #e74c3c; 
            border-radius: 16px; 
            box-shadow: 
                0 15px 40px rgba(0,0,0,.4), 
                0 5px 15px rgba(231,76,60,.2),
                inset 0 1px 0 rgba(255,255,255,.1); 
            overflow: hidden; 
            transform: translateY(12px); 
            opacity: 0; 
            animation: cardRockIn .8s ease-out forwards;
            position: relative;
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #e74c3c, #ff4757, #e74c3c);
            background-size: 200% 100%;
            animation: warningPulse 2s ease-in-out infinite;
        }
        .card-header { 
            padding: 24px; 
            border-bottom: 2px solid #40407a; 
            background: linear-gradient(135deg, #2c2c54 0%, #40407a 100%);
            position: relative;
            overflow: hidden;
            text-align: center;
        }
        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(231,76,60,.1), transparent);
            animation: shine 3s infinite;
        }
        h1 { 
            margin: 0; 
            font-size: 24px; 
            color: #ff4757; 
            font-weight: 800; 
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0,0,0,.5);
        }
        .warning-icon {
            font-size: 48px;
            margin-bottom: 12px;
            display: block;
            animation: bounce 2s infinite;
        }
        .card-body { 
            padding: 32px 24px; 
            animation: fadeIn .8s ease .2s both; 
            text-align: center; 
            background: linear-gradient(145deg, #2c2c54 0%, #232347 100%); 
        }
        .warning-message {
            color: #e0e0e0; 
            font-size: 18px; 
            line-height: 1.6; 
            margin-bottom: 24px;
        }
        .band-info {
            background: linear-gradient(145deg, #1e1e42 0%, #232347 100%);
            border: 2px solid #40407a;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: inset 0 2px 4px rgba(0,0,0,.3);
        }
        .band-name { 
            color: #ffd700; 
            font-weight: 700; 
            font-size: 20px;
            margin-bottom: 8px;
        }
        .band-email {
            color: #b19cd9;
            font-size: 16px;
        }
        .actions { 
            display: flex; 
            justify-content: center; 
            gap: 16px; 
            margin-top: 32px; 
        }
        .btn { 
            padding: 16px 28px; 
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
        .btn-confirm { 
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); 
            color: white; 
            border-color: #c0392b;
            text-shadow: 0 1px 2px rgba(0,0,0,.3);
        }
        .btn-confirm:hover { 
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%); 
            border-color: #a93226;
            box-shadow: 0 6px 20px rgba(231,76,60,.4);
        }
        .btn-cancel { 
            background: linear-gradient(135deg, #706fd3 0%, #5f5fc4 100%); 
            color: white; 
            border-color: #5f5fc4;
            text-shadow: 0 1px 2px rgba(0,0,0,.3);
        }
        .btn-cancel:hover { 
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
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        @keyframes warningPulse {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 200% 50%; }
        }

        @media (max-width: 600px) {
            .actions {
                flex-direction: column;
                gap: 12px;
            }
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="bg-decor"></div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <span class="warning-icon">⚠️</span>
                <h1>Remove Band from Roster</h1>
            </div>
            <div class="card-body">
                <p class="warning-message">Are you sure you want to remove this band from the roster? This action cannot be undone!</p>
                
                <div class="band-info">
                    <div class="band-name">🎸 <?= $user['username'] ?></div>
                    <div class="band-email">📧 <?= $user['email'] ?></div>
                </div>
                
                <form action="<?= site_url('users/delete/' . $user['id']) ?>" method="POST">
                    <div class="actions">
                        <button type="submit" class="btn btn-confirm">🗑️ Yes, Remove Band</button>
                        <a href="<?= site_url('users/view') ?>" class="btn btn-cancel">🎵 Cancel & Keep Rocking</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>