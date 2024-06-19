


let loginuser = ""
let senhaLog = "";




function validaçãoTLOgin() {
  
 // Clear previous errors
 const errorInputs = document.querySelectorAll('.error');
 errorInputs.forEach(input => {
     input.classList.remove('error');
     input.placeholder = input.getAttribute('data-original-placeholder');
     
 });
    
 loginuser = document.getElementById("loogin");

  if (loginuser.value == "") {
    loginuser.classList.add('error');
    loginuser.setAttribute('data-original-placeholder', loginuser.placeholder);
    loginuser.placeholder = 'O Campo Login deve ser preenchido';
    loginuser.value = '';
       return;
  }
  
   
 

  senhaLog = document.getElementById("senha-log")
  if (senhaLog.value == "") {
    senhaLog.classList.add('error');
    senhaLog.setAttribute('data-original-placeholder', senhaLog.placeholder);
    senhaLog.placeholder = 'O Campo Senha deve ser preenchido';
    senhaLog.value = '';
       return;
  }

  


  else {

    let form = document.form;
  const xml = new XMLHttpRequest();
  xml.responseType = 'text';
  xml.onreadystatechange = function(){
      if (xml.readyState == 4) {
          if (xml.status == 200) {
              var json = xml.response;
              var div = document.getElementById("texto-aviso");
              var avisos = document.getElementById("aviso");
              avisos.classList.add("avisos");
              div.classList.remove('sucesso');
              div.classList.remove('erro');
              console.log(json)
              if(json['succes'] == "true"){
                  div.classList.add('sucesso');
                  return form.submit();
              }
              if(json['succes'] == "false"){
                  div.classList.add('erro');
              }
              var h1 = document.getElementById("texto-aviso");
              h1.innerHTML = json['message'];
          }
          if (xml.status == 404) {
              console.log("deu erro aq");
          }
      }
  }
  
  nome = nome.value
  cpf = cpf.value
  email = email.value
  telefonecelular = telefonecelular.value
  login = login.value
  senha = senha.value
  nomemae = nomemae.value


  xml.open("POST", "/cadastro.php");
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xml.send("nome="+nome+"&cpf="+cpf+"&email="+email+"&telefonecelular="+telefonecelular+"&login="+login+"&senha="+senha+"&nomemae="+nomemae);

  return false;



 
}



}


  



let nome = "nome";
let cep = "";
let email = "";
let senha = "";
let confSenha = "";
let telefone = "";
let Mnome = "Mnome";
let login = "";
let telefoneFixo = "";
let data ="";




function validaçãoCAD() {




  // Clear previous errors
  const errorInputs = document.querySelectorAll('.error');
  errorInputs.forEach(input => {
      input.classList.remove('error');
      input.placeholder = input.getAttribute('data-original-placeholder');
      
  });

   // Nome validation
   nome = document.getElementById('nome');
   if (nome.value.length < 15 || nome.value.length > 80 || !/^[a-zA-Z\s]+$/.test(nome.value)) {
       nome.classList.add('error');
       nome.setAttribute('data-original-placeholder', nome.placeholder);
       nome.placeholder = 'Nome deve ter entre 15 e 80 caracteres alfabéticos.';
       nome.value = '';
       return;
   }

  data = document.getElementById("data").value;
  if (data == "") {
       return;
   }

  sexo = document.getElementById("sexo").value;
  defalt = document.getElementById("defalt").value;
  if (sexo == defalt) {
    document.getElementById('sexoError').innerHTML = 'Por favor, selecione o sexo.';
                return;
  }
   
  
   // Nome Materno validation
  nomemae = document.getElementById('nomemae');
   if (nomemae.value.length < 3 || nomemae.value.length > 30|| !/^[a-zA-Z\s]+$/.test(nomemae.value)) {
       nomemae.classList.add('error');
       nomemae.setAttribute('data-original-placeholder', nomemae.placeholder);
       nomemae.placeholder = 'Nome materno deve ter entre 3 e 30 caracteres alfabéticos.';
       nomemae.value = '';
     return;

   }

    // CPF validation
    const cpf = document.getElementById('cpf');
    if (!validaCPF(cpf.value)) {
        cpf.classList.add('error');
        cpf.setAttribute('data-original-placeholder', cpf.placeholder);
        cpf.placeholder = 'CPF inválido.';
        cpf.value = '';
        return;
    }

   



  // Telefone Celular validation
  const telefonecelular = document.getElementById('telefonecelular');
  if (telefonecelular.value == "") {
      telefonecelular.classList.add('error');
      telefonecelular.setAttribute('data-original-placeholder', telefonecelular.placeholder);
      telefonecelular.placeholder = 'Formato inválido. Use (+55)XX-XXXXXXXX.';
      telefonecelular.value = "";
     return;
  }
  // Nome validation
  email = document.getElementById('email');
  if (email.value =="") {
    email.classList.add('error');
    email.setAttribute('data-original-placeholder', email.placeholder);
    email.placeholder = 'Digite um E-mail Válido';
    email.value = '';
    return;
     
  }

  login = document.getElementById("login")
  if ((login.value.length < 6 || login.value.length > 6 || !/^[a-zA-Z\s]+$/.test(login.value))) {
    login.classList.add('error');
    login.setAttribute('data-original-placeholder', login.placeholder);
    login.placeholder = 'O campo Login deve ter exatamente 6 caracteres alfabéticos.';
    login.value = '';
    return;
      
  }

  senha = document.getElementById("senha");
  if ((senha.value.length < 8 || senha.value.length > 8 || !/^[a-zA-Z\s]+$/.test(senha.value))) {
    senha.classList.add('error');
    senha.setAttribute('data-original-placeholder', senha.placeholder);
    senha.placeholder = 'O campo Senha deve ter exatamente 8 caracteres alfabéticos.';
    senha.value = '';
    return;
  }
  

  // Confirmação de Senha validation
  const confsenha = document.getElementById('confsenha');
  if (senha.value !== confsenha.value) {
      confsenha.classList.add('error');
      confsenha.setAttribute('data-original-placeholder', confsenha.placeholder);
      confsenha.placeholder = 'As senhas não coincidem.';
      confsenha.value = '';
      return;
  }

  cep = document.getElementById("cep").value;
  if (cep == "") {
    cep.classList.add('error');
    cep.setAttribute('data-original-placeholder', cep.placeholder);
    cep.placeholder = 'As senhas não coincidem.';
    cep.value = '';
      return;
}



  // Telefone Celular validation
  const telefoneFixo = document.getElementById('fixo');
  if (telefoneFixo.value == "") {
    telefoneFixo.classList.add('error');
    telefoneFixo.setAttribute('data-original-placeholder', telefoneFixo.placeholder);
    telefoneFixo.placeholder = 'Formato inválido. Use (+55)XX-XXXXXXXX.';
    telefoneFixo.value = "";
     return;
  }
  


  let form = document.form;
  const xml = new XMLHttpRequest();
  xml.responseType = 'text';
  xml.onreadystatechange = function(){
      if (xml.readyState == 4) {
          if (xml.status == 200) {
              var json = xml.response;
              var div = document.getElementById("texto-aviso");
              var avisos = document.getElementById("aviso");
              avisos.classList.add("avisos");
              div.classList.remove('sucesso');
              div.classList.remove('erro');
              console.log(json)
              if(json['succes'] == "true"){
                  div.classList.add('sucesso');
                  return form.submit();
              }
              if(json['succes'] == "false"){
                  div.classList.add('erro');
              }
              var h1 = document.getElementById("texto-aviso");
              h1.innerHTML = json['message'];
          }
          if (xml.status == 404) {
              console.log("deu erro aq");
          }
      }
  }
  
  nome = nome.value
  cpf = cpf.value
  email = email.value
  telefonecelular = telefonecelular.value
  login = login.value
  senha = senha.value
  nomemae = nomemae.value


  xml.open("POST", "/cadastro.php");
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xml.send("nome="+nome+"&cpf="+cpf+"&email="+email+"&telefonecelular="+telefonecelular+"&login="+login+"&senha="+senha+"&nomemae="+nomemae);

  return false;



 
}

  
 


  



 
  

  
 

 // CPF validation function
 function validaCPF(cpf) {
  cpf = cpf.replace(/[^\d]+/g,'');
  if (cpf == '') return false;
  // Elimina CPFs inválidos conhecidos
  if (cpf.length != 11 || 
      cpf == "00000000000" || 
      cpf == "11111111111" || 
      cpf == "22222222222" || 
      cpf == "33333333333" || 
      cpf == "44444444444" || 
      cpf == "55555555555" || 
      cpf == "66666666666" || 
      cpf == "77777777777" || 
      cpf == "88888888888" || 
      cpf == "99999999999")
      return false;
  // Valida 1o digito
  add = 0;
  for (i=0; i < 9; i ++)
      add += parseInt(cpf.charAt(i)) * (10 - i);
      rev = 11 - (add % 11);
      if (rev == 10 || rev == 11) 
          rev = 0;
      if (rev != parseInt(cpf.charAt(9))) 
          return false;
  // Valida 2o digito
  add = 0;
  for (i = 0; i < 10; i ++)
      add += parseInt(cpf.charAt(i)) * (11 - i);
  rev = 11 - (add % 11);
  if (rev == 10 || rev == 11) 
      rev = 0;
  if (rev != parseInt(cpf.charAt(10)))
      return false;
  return true;
}

function mascararTelefone() {
  const telefone = document.getElementById('telefonecelular');
  let valor = telefone.value;
  
  // Remove todos os caracteres não numéricos do valor
  valor = valor.replace(/\D/g, '');
  
  // Aplica a máscara (XX) (XX) X XXXX-XXXX
  valor = valor.replace(/^(\d{2})(\d)/g, '($1) $2');
  valor = valor.replace(/(\d)(\d{4})(\d{4})$/, '$1 $2-$3');
  
  // Atualiza o valor do campo
  telefone.value = valor;
}


// Função para validar o email
function validarEmail(email) {
  var regex = /@/;
  return regex.test(email);
}
