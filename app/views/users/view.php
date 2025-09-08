<!DOCTYPE html>
<html>
<head>
    <title>Band Roster</title>
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
        .container { max-width: 1000px; margin: 40px auto; padding: 0 16px; }
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
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
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
            animation: shine 4s infinite;
        }
        .title { 
            margin: 0; 
            font-size: 28px; 
            color: #ffd700; 
            font-weight: 800; 
            text-transform: uppercase;
            letter-spacing: 1.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,.5);
        }
        .subtitle {
            margin: 4px 0 0 0;
            font-size: 14px;
            color: #b19cd9;
            font-weight: 400;
        }
        .actions { display: flex; gap: 12px; }
        .table-wrapper { 
            overflow-x: auto; 
            animation: fadeIn .8s ease .2s both; 
            background: linear-gradient(145deg, #2c2c54 0%, #232347 100%); 
        }
        table { border-collapse: collapse; width: 100%; }
        th, td { 
            border-bottom: 1px solid #40407a; 
            padding: 16px 20px; 
            text-align: left; 
        }
        th { 
            background: linear-gradient(135deg, #40407a 0%, #2c2c54 100%); 
            font-weight: 700; 
            color: #ffd700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
            text-shadow: 0 1px 2px rgba(0,0,0,.5);
        }
        td {
            color: #e0e0e0;
            font-size: 14px;
        }
        tr { 
            transition: all .3s ease; 
            position: relative;
        }
        tr:hover td { 
            background: linear-gradient(90deg, rgba(255,215,0,.05) 0%, rgba(255,69,0,.03) 100%);
            transform: translateX(2px);
        }
        .btn { 
            display: inline-block; 
            padding: 10px 16px; 
            text-decoration: none; 
            border-radius: 10px; 
            border: 2px solid transparent; 
            font-size: 12px; 
            font-weight: 700; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 3px 8px rgba(0,0,0,.3); 
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
            width: 150px;
            height: 150px;
        }
        .btn:active { 
            transform: translateY(1px); 
            box-shadow: 0 1px 4px rgba(0,0,0,.4); 
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
            box-shadow: 0 4px 12px rgba(255,71,87,.3);
        }
        .btn-edit { 
            background: linear-gradient(135deg, #ffa502 0%, #ff9500 100%); 
            color: white; 
            border-color: #ff9500;
            text-shadow: 0 1px 2px rgba(0,0,0,.3);
        }
        .btn-edit:hover { 
            background: linear-gradient(135deg, #ff9500 0%, #e6850e 100%); 
            border-color: #e6850e;
            box-shadow: 0 4px 12px rgba(255,165,2,.3);
        }
        .btn-delete { 
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); 
            color: white; 
            border-color: #c0392b;
            text-shadow: 0 1px 2px rgba(0,0,0,.3);
        }
        .btn-delete:hover { 
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%); 
            border-color: #a93226;
            box-shadow: 0 4px 12px rgba(231,76,60,.3);
        }
        .empty { 
            padding: 40px 24px; 
            text-align: center; 
            color: #b19cd9; 
            font-style: italic;
            font-size: 16px;
        }
        .empty::before {
            content: '🎸';
            display: block;
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
        .action-buttons { 
            display: flex; 
            gap: 8px; 
            align-items: center; 
        }
        .band-id {
            font-family: 'Courier New', monospace;
            color: #706fd3;
            font-weight: 600;
        }
        .band-name {
            color: #ffd700;
            font-weight: 600;
        }
        .band-email {
            color: #b19cd9;
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

        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            .actions {
                width: 100%;
            }
            .btn-primary {
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <div class="bg-decor"></div>
    <div class="container">
    <div class="card">
    <div class="card-header">
        <div>
            <h1 class="title">🎸 Band Roster</h1>
            <p class="subtitle">Rock stars united</p>
        </div>
        <div class="actions">
            <a href="<?= site_url('users/create') ?>" class="btn btn-primary">🎵 Register New Band</a>
        </div>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Band ID</th>
                    <th>Band Name</th>
                    <th>Contact Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach($users as $user): ?>
                    <tr>
                        <td><span class="band-id">#<?= str_pad($user['id'], 3, '0', STR_PAD_LEFT) ?></span></td>
                        <td><span class="band-name"><?= $user['username'] ?></span></td>
                        <td><span class="band-email"><?= $user['email'] ?></span></td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= site_url('users/update/' . $user['id']) ?>" class="btn btn-edit">✏️ Edit</a>
                                <a href="<?= site_url('users/delete/' . $user['id']) ?>" class="btn btn-delete">🗑️ Remove</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="empty">No bands registered yet. Time to rock and roll!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    </div>
    </div>
</body>
</html>