document.querySelector('form').addEventListener('submit', function (e) {
    let erros = [];

    const nome = document.getElementById('nome-cadastro').value;
    const email = document.getElementById('email-cadastro').value;
    const telefone = document.getElementById('telefone-cadastro').value;
    const senha = document.getElementById('senha-cadastro').value;
    const cSenha = document.getElementById('confirmar-senha').value;

    // Validação do Nome
    if (!nome) {
        erros.push("O nome é obrigatório.");
    } else if (nome.length < 2) {
        erros.push("O nome deve ter pelo menos 2 letras.");
    } else if (!/^[a-zA-Z\s]+$/.test(nome)) {
        erros.push("O nome deve conter apenas letras e espaços.");
    }

    // Validação do Email
    if (!email) {
        erros.push("O email é obrigatório.");
    } else if (!/\S+@\S+\.\S+/.test(email)) {
        erros.push("O email informado é inválido.");
    }

    // Validação do Telefone
    if (!telefone) {
        erros.push("O telefone é obrigatório.");
    } else if (!/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/.test(telefone)) {
        erros.push("O telefone deve conter apenas números (entre 8 e 15 dígitos).");
    }

    // Validação da Senha
    if (!senha) {
        erros.push("A senha é obrigatória.");
    } else if (senha.length < 8) {
        erros.push("A senha deve ter pelo menos 8 caracteres.");
    } else if (!/[A-Z]/.test(senha) || !/[a-z]/.test(senha) || !/\d/.test(senha) || !/[^a-zA-Z\d]/.test(senha)) {
        erros.push("A senha deve conter letras maiúsculas, minúsculas, números e caracteres especiais.");
    }

    // Validação da Confirmação de Senha
    if (senha !== cSenha) {
        erros.push("As senhas não coincidem.");
    }

    // Se houver erros, previne o envio do formulário e exibe as mensagens de erro
    if (erros.length > 0) {
        e.preventDefault();
        alert(erros.join("\n"));
    }
});
