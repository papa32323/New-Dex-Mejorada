<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API DEX</title>

    <style>

        body {
            background: url("{{ asset('Pikachu.jpg') }}");
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 40px;
            font-family: 'Segoe UI', sans-serif;
        }

        h1 {
            text-align: center;
            font-size: 55px;
            font-weight: 900;
            margin-bottom: 40px;
            color: #b8842a;
            text-shadow: 0 0 12px rgba(255, 230, 150, 0.9);
        }

        .grid {
            width: 95%;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 35px;
        }

        .card {
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            padding: 35px 25px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(20px);
            overflow: hidden;
            transition: 0.4s ease;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            box-shadow: 0 0 25px rgba(255, 200, 120, 0.35);
        }

        .card::before {
            content: "";
            position: absolute;
            inset: -60px;
            background: conic-gradient(
                #ffdf6b,
                #ff9a3c,
                #ff70d6,
                #8d6bff,
                #4db8ff,
                #4dffb8,
                #fff387,
                #ffdf6b
            );
            opacity: 0.45;
            mix-blend-mode: screen;
            animation: holoSpin 5s linear infinite;
            pointer-events: none;
            z-index: -1;
        }

        .card::after {
            content: "";
            position: absolute;
            inset: -10px;
            background:
                radial-gradient(circle at 25% 30%, rgba(255,255,255,0.8), transparent 60%),
                radial-gradient(circle at 75% 70%, rgba(255,255,200,0.6), transparent 70%);
            animation: holoGlow 4s ease-in-out infinite alternate;
            mix-blend-mode: overlay;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes holoSpin {
            0% { transform: rotate(0deg) scale(1.3); }
            100% { transform: rotate(360deg) scale(1.3); }
        }

        @keyframes holoGlow {
            0% { opacity: 0.2; filter: brightness(1); }
            100% { opacity: 0.9; filter: brightness(1.5); }
        }

        .card:hover {
            transform: translateY(-12px) scale(1.08);
            box-shadow: 0 0 40px rgba(255, 230, 150, 1),
                        0 0 80px rgba(255, 170, 90, 0.9);
        }

        .poke-id {
            font-size: 22px;
            font-weight: 900;
            color: #8a6a2d;
            text-shadow: 0 0 8px rgba(255,255,180,0.8);
        }

        .poke-name {
            font-size: 32px;
            font-weight: 900;
            text-transform: capitalize;
            color: #5e4210;
            text-shadow: 0 0 6px rgba(255,220,150,0.9);
        }

        .data-box {
            width: 80%;
            background: rgba(255, 240, 190, 0.65);
            border: 2px solid #d9a441;
            border-radius: 15px;
            padding: 15px;
            font-size: 18px;
            line-height: 26px;
            color: #6c4d1a;
            box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.15);
        }

        .data-box strong {
            color: #d98913;
        }

        .type {
            background: #d98913;
            padding: 6px 14px;
            border-radius: 10px;
            font-weight: bold;
            color: white;
            margin-right: 6px;
            display: inline-block;
        }

    </style>
</head>
<body>

    <h1>API POKEDEX</h1>

    <div class="grid">
        @foreach ($pokemones as $pokemon)
            <div class="card">

                <div class="poke-id">#{{ $pokemon['id'] }}</div>

                <img src="{{ $pokemon['sprite'] }}" alt="{{ $pokemon['name'] }}">

                <div class="poke-name">{{ $pokemon['name'] }}</div>

                <div class="data-box">
                    <strong>Altura:</strong> {{ $pokemon['height'] }} dm <br>
                    <strong>Peso:</strong> {{ $pokemon['weight'] }} hg <br>
                    <strong>Tipo:</strong>
                    @foreach ($pokemon['types'] as $type)
                        <span class="type">{{ $type }}</span>
                    @endforeach
                </div>

            </div>
        @endforeach
    </div>

</body>
</html>
