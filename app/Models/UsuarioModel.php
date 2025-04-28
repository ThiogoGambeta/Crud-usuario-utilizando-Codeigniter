<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id';  // Chave primária da tabela
    protected $allowedFields = ['nome', 'sobrenome', 'senha']; // Campos que podem ser manipulados

    // Definindo regras para validação, se necessário
    protected $validationRules = [
        'nome' => 'required|min_length[3]|max_length[255]',
        'sobrenome' => 'required|min_length[3]|max_length[255]',
        'senha' => 'required|min_length[4]',
    ];

    // Salvar novo usuário
    public function salvar($nome, $sobrenome, $senha)
    {
        // Criptografar a senha antes de salvar
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Utilizando o método 'insert' do CodeIgniter para inserir dados
        return $this->insert([
            'nome' => $nome,
            'sobrenome' => $sobrenome,
            'senha' => $senhaHash
        ]);
    }

    // Atualizar usuário
    public function atualizar($id, $nome, $sobrenome, $senha)
    {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Atualizar os dados do usuário com o id fornecido
        return $this->update($id, [
            'nome' => $nome,
            'sobrenome' => $sobrenome,
            'senha' => $senhaHash
        ]);
    }

    // Excluir usuário
    public function excluir($id)
    {
        // Deletar o usuário com o id fornecido
        return $this->delete($id);
    }
}
