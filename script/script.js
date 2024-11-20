


function validarCPF(cpf) { cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos 
    if (cpf == '' || cpf.length != 11 || /^(\d)\1{10}$/.test(cpf)) 
        return false; // Calcula o primeiro dígito verificador 
    let soma = 0; for (let i = 0; i < 9; i++) { 
        soma += parseInt(cpf.charAt(i)) * (10 - i); 
    } 
    let resto = 11 - (soma % 11); if (resto == 10 || resto == 11) 
        resto = 0; if (resto != parseInt(cpf.charAt(9))) 
            return false; // Calcula o segundo dígito verificador 
    soma = 0; for (let i = 0; i < 10; i++) { 
        soma += parseInt(cpf.charAt(i)) * (11 - i); 
    } 
    resto = 11 - (soma % 11); 
    if (resto == 10 || resto == 11) 
        resto = 0; 
    if (resto != parseInt(cpf.charAt(10))) 
        return false;
     return true; 
    } 
    function verificarFormulario() { 
        var senha = document.getElementsByName('senha')[0].value; 
        var confirmacaoSenha = document.getElementById('txtConfirmacaoSenha').value; 
        var cpf = document.getElementById('cpf').value; 
        if (senha !== confirmacaoSenha) { alert('As senhas não coincidem. Por favor, tente novamente.'); 
            return false; 
        } else if (!validarCPF(cpf)) { alert('Por favor, insira um CPF válido.'); 
            return false; } 
            else { 
                var formulario = document.getElementById('formularioSenha'); 
                formulario.action = 'config/adicionar_usuario.php'; 
                formulario.submit(); 
                return true; 
            } 
        }


        