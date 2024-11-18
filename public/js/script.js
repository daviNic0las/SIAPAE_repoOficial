function show(route) {
    window.location.href = route;
}

function goToUrl(route) {
    window.location.href = route;
}

//Atualiza o nome a direita do input tipo file com o nome do arquivo
function updateImageLabel(event) {

    const fileInput = event.target;
    const labelImage = document.getElementById('label-image');


    const fileName = fileInput.files[0].name;
    labelImage.textContent = fileName; // Atualiza o texto com o nome do arquivo

}

function updateImagePreview(event) {
    const fileInput = event.target;
    const imagePreview = document.getElementById('image-preview');

    const file = fileInput.files[0];
    const reader = new FileReader();

    if (fileInput.files.length > 0) { 
        reader.onload = function (e) {
            imagePreview.src = e.target.result; // Atualiza a imagem prévia com a nova imagem
        }
        
        reader.readAsDataURL(file); 
    }
    
// Lê o arquivo como uma URL de dados

    // if (fileInput.files.length > 0) { };
}

const mascaraMoeda = (event) => {
    const onlyDigits = event.target.value
        .split("")
        .filter(s => /\d/.test(s))
        .join("")
        .padStart(3, "0")
    const digitsFloat = onlyDigits.slice(0, -2) + "." + onlyDigits.slice(-2)
    event.target.value = maskCurrency(digitsFloat)
}

const maskCurrency = (valor, locale = 'pt-BR', currency = 'BRL') => {
    return new Intl.NumberFormat(locale, {
        style: 'currency',
        currency
    }).format(valor)
}

//Para algumas views do expense para ocultar alguns campos de acordo com o seu id
document.addEventListener('DOMContentLoaded', function() {
    
    var tipoGasto = document.getElementById('tipo_gasto').value;

    // Função para ocultar todos os campos
    function ocultarCampos() {
        document.getElementById('campo_recibo').style.display = 'none';
        document.getElementById('campo_nota_fiscal').style.display = 'none';
    }

    // Mostrar o campo correto baseado no tipo de gasto
    function mostrarCampos(tipoGasto) {
        ocultarCampos(); // Primeiro, esconder todos os campos

        if (tipoGasto === 'Nota Fiscal') {
            document.getElementById('campo_nota_fiscal').style.display = 'block';
        } else if (tipoGasto === 'Recibo') {
            document.getElementById('campo_recibo').style.display = 'block';
        } 
    }

    // Chamar a função para mostrar o campo correto ao carregar a página
    mostrarCampos(tipoGasto);

    // Ouvir mudanças no select
    document.getElementById('tipo_gasto').addEventListener('change', function() {
        mostrarCampos(this.value);
    });
});
