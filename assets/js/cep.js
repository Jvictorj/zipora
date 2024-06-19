function buscaCEP(){
    var cep = document.getElementById('CEP').value;
    if(cep !==""){
        let url = "https://brasilapi.com.br/api/cep/v1/" +cep;
        let req = new XMLHttpRequest();
        req.open("GET", url);
        req.send();

     //tratar a resposta da requisição 
     req.onload = function(){
        if(req.status === 200){
            let endereco = JSON.parse(req.response);
            document.getElementById('Rua').value = endereco.street;
            document.getElementById('Bairro').value = endereco.neighborhood;
            document.getElementById('Cidade').value = endereco.city;
            document.getElementById('Estado').value = endereco.state;
        }
        else if (req.status === 404){
            toast ("CEP inválido.")
        }
        else toast("Erro ao fazer a requisição");{
    }
     }  
}
}

window.onload = function(){
    let txtcep = document.getElementById('CEP');
    txtcep.addEventListener("blur", buscaCEP);
}