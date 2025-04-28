<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .form-container {
            width: 400px;
            padding: 30px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        h1 {
            text-align: center;
            margin-bottom: 24px;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button[type="submit"]:hover {
            background-color: #218838;
            transform: scale(1.03);
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1>Editar Usuário</h1>

    <?php if (isset($validation)) : ?>
    <div style="color: red; font-size: 14px; margin-bottom: 10px;">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>


    <form action="/usuarios/atualizar/<?= esc($usuario['id']) ?>" method="post">
        <input type="text" name="nome" value="<?= esc($usuario['nome']) ?>" placeholder="Nome" required>
        <input type="text" name="sobrenome" value="<?= esc($usuario['sobrenome']) ?>" placeholder="Sobrenome" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Salvar</button>
    </form>
</div>

</body>
</html>
