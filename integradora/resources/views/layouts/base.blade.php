<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferretería El Tornillo</title>
    <style>
        body { font-family: sans-serif; background-color: #f5f5f5; color: #333; }
        header { background-color: #8B4513; color: white; padding: 20px; text-align: center; }
        main { max-width: 900px; margin: 30px auto; padding: 0 20px; }
        footer { background-color: #333; color: white; text-align: center; padding: 15px; margin-top: 40px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background-color: #8B4513; color: white; }
        .btn { display: inline-block; margin-top: 15px; padding: 10px 20px; background-color: #8B4513; color: white; text-decoration: none; border-radius: 5px; }
        .errores { background-color: #ffcccc; border: 1px solid #cc0000; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .errores ul { margin: 0; padding-left: 20px; }
        .campo { margin-bottom: 15px; }
        .campo label { display: block; margin-bottom: 5px; font-weight: bold; }
        .campo input { width: 100%; padding: 8px; font-size: 1em; }
        .campo button { padding: 10px 20px; background-color: #8B4513; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; }
    </style>
</head>
<body>
    <header>
        <h1>Ferretería El Tornillo</h1>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        Integradora - jhonathan david ramos jimenez - 18 de agosto de 2026
    </footer>
</body>
</html>
