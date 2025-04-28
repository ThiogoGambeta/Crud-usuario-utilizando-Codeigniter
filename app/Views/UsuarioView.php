<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Usuários</title>
    <style>
        body {
            padding-top: 80px;
        }
        table {
    width: 50%;
    border-collapse: collapse;
    min-height: 400px;
    border: 1px solid #ccc;
    margin: 80px auto;  /* Empurra a tabela para baixo do título */
}

        h1 {
    position: fixed;  /* Fixa o título no topo */
    top: -9.5%;
    left: 0;
    width: 100%;
    margin: 0;
    padding: 16px 0;
    background-color: white;
    text-align: center;
    font-size: 24px;
    z-index: 1000;  /* Garantir que fique acima dos outros elementos */
    border-bottom: 1px solid #ccc;  /* Linha abaixo do título */
}

        thead {
            background-color: #f5f5f5;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .tr-pai{
            background-color: grey;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-block;
        }

        .btn-add:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-add:active {
            background-color: #1e7e34;
        }

        .btn {
            padding: 8px 12px;
            margin-right: 5px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
        }
        .btn-grupo {
            display: flex;
            gap: 10px; /* Espaço entre os botões */
            justify-content: flex-start;
            align-items: center;
            }
        .btn-edit {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            order: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;*/
            margin: 0;
        }

        .btn-edit:hover {
            background-color: #0069d9;
            transform: scale(1.05);
        }

        .btn-delete {
            text-align: center;
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            order: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;*/
            margin: 0;
        }

        .btn-delete:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }
        /* Formulário */
        #formAdicionar {
            display: none;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        #formAdicionar input[type="text"],
        #formAdicionar input[type="password"] {
            padding: 8px;
            margin: 6px 0;
            width: 98%;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        #formAdicionar button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        #formAdicionar button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<h1 style="text-align: center; margin-top: 70px;">Tabela de Usuários</h1>

<!-- TABELA DOS DADOS DO BANCO -->
<table>
    <thead>
    <tr>
            <th colspan="5">
                <a href="javascript:void(0)" onclick="mostrarFormulario()" class="btn-add">Adicionar Usuário</a>
            </th>
        </tr>
    </thead>
    <tbody>
        <!-- Linha de formulário -->
        <tr id="formAdicionar" style="display: <?= isset($validation) ? 'table-row' : 'none'; ?>;">
    <td colspan="5">
        <?php if (isset($validation)) : ?>
            <div style="color: red; font-size: 14px; margin-bottom: 10px;">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="/usuarios/salvar" method="post">
            <input type="text" name="nome" placeholder="Nome" value="<?= old('nome') ?>" required>
            <input type="text" name="sobrenome" placeholder="Sobrenome" value="<?= old('sobrenome') ?>" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Salvar</button>
        </form>
    </td>
</tr>
        <tr style="background-color: #f5f5f5;">
            <th>ID</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Senha</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= esc($usuario['id']) ?></td>                
                <td><?= esc($usuario['nome']) ?></td>
                <td><?= esc($usuario['sobrenome']) ?></td>
                <td><?= esc($usuario['senha']) ?></td>
                <td>
                    <div class="btn-grupo">
                    <a class="btn-edit" href="/usuarios/editar/<?= esc($usuario['id']) ?>">Editar</a>
                    <a class="btn-delete" href="/usuarios/excluir/<?= esc($usuario['id']) ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </div>                
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
function mostrarFormulario() {
    const formRow = document.getElementById('formAdicionar');
    formRow.style.display = formRow.style.display === 'none' ? 'table-row' : 'none';
}
</script>

</body>
</html>