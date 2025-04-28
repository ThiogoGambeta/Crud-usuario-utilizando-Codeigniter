<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class UsuarioController extends Controller
{
    // Mostrar a tabela de usuários
    public function index()
    {
        $model = new UsuarioModel();
        $usuarios = $model->find();

        return view('usuarioView', ['usuarios' => $usuarios]);
    }

    public function salvar()
{
    helper(['form']);

    $lang = \Config\Services::language();

    // Regras de validação
    $validationRules = [
        'nome' => 'required',
        'sobrenome' => 'required',
        'senha' => 'required|min_length[4]',  // Validação de senha com no mínimo 4 caracteres
    ];

    // Validação dos dados
    if (!$this->validate($validationRules)) {
        // Se a validação falhar, carrega os dados para mostrar a tabela de novo
        $model = new UsuarioModel();
        $data['usuarios'] = $model->findAll();
        $data['validation'] = $this->validator;

        return view('UsuarioView', $data);
    }

    // Se a senha for válida, continua o processo
    $nome = $this->request->getPost('nome');
    $sobrenome = $this->request->getPost('sobrenome');
    $senha = $this->request->getPost('senha');

    // Verifica se a senha tem pelo menos 4 caracteres
    if (strlen($senha) < 4) {
        // Exibe um erro flash e mantém o formulário visível
        $session = session();
        $session->setFlashdata('error', 'A senha precisa ter pelo menos 4 caracteres. Tente novamente.');
        // Recarrega a página e mantém os dados preenchidos e a aba visível
        return redirect()->back()->withInput(); 
    }

    // Salvando no banco de dados
    $model = new UsuarioModel();
    if ($model->salvar($nome, $sobrenome, $senha)) {
        return redirect()->to('/usuarios')->with('success', 'Usuário salvo com sucesso!');
    } else {
        return redirect()->back()->with('error', 'Erro ao salvar usuário');
    }
}
    // Editar usuário
    public function editar($id)
    {
        $model = new UsuarioModel();
        $usuario = $model->find($id); // Busca o usuário pelo ID

        // Verifica se o usuário existe
        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuário não encontrado.');
        }

        // Passa os dados para a view
        return view('usuario_edit', ['usuario' => $usuario]);
    }

// Atualizar usuário
public function atualizar($id)
{
    helper(['form']);

    $validationRules = [
        'nome' => 'required',
        'sobrenome' => 'required',
        'senha' => 'required|min_length[4]',
    ];

    if (!$this->validate($validationRules)) {
        $model = new UsuarioModel();
        $usuario = $model->find($id);

        if (!$usuario) {
            return redirect()->to('/usuarios')->with('error', 'Usuário não encontrado.');
        }

        return view('usuario_edit', [
            'usuario' => $usuario,
            'validation' => $this->validator
        ]);
    }

    $nome = $this->request->getPost('nome');
    $sobrenome = $this->request->getPost('sobrenome');
    $senha = password_hash($this->request->getPost('senha'), PASSWORD_DEFAULT);

    $model = new UsuarioModel();

    $dados = [
        'nome' => $nome,
        'sobrenome' => $sobrenome,
        'senha' => $senha
    ];

    if ($model->update($id, $dados)) {
        return redirect()->to('/usuarios')->with('success', 'Usuário atualizado com sucesso!');
    } else {
        return redirect()->back()->with('error', 'Erro ao atualizar o usuário.');
    }
}

    // Excluir usuário
    public function excluir($id)
    {
        $model = new UsuarioModel();
        if ($model->excluir($id)) {
            return redirect()->to('/usuarios');
        } else {
            return redirect()->back()->with('error', 'Erro ao excluir usuário');
        }
    }
}
