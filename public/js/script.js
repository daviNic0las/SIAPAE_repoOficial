function show(route) {
    window.location.href = route;
}

//VIEW Student - Atualiza o nome a direita do input tipo file com o nome do arquivo
function updateImageLabel(event) {

    const fileInput = event.target;
    const labelImage = document.getElementById('label-image');


    if (labelImage && fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        labelImage.textContent = fileName; // Atualiza o texto com o nome do arquivo
    } else {
        console.error("Elemento label-image não encontrado ou nenhum arquivo selecionado.");
    }

}

function updateImagePreview(event) {
    const fileInput = event.target;
    const imagePreview = document.getElementById('image-preview');

    if (imagePreview && fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result; // Atualiza a imagem prévia com a nova imagem
        }

        reader.readAsDataURL(file); // Lê o arquivo como uma URL de dados
    } else {
        console.error("Elemento image-preview não encontrado ou nenhum arquivo selecionado.");
    }
}

// VIEW Expense - p/ mascara de moeda com o R$
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

// VIEW Donation - p/ mascara de moeda sem o R$
const maskMoedaSemRS = (event) => {
    // Retira qualquer caractere que não seja número ou vírgula (permitindo que o usuário digite a vírgula)
    const onlyDigits = event.target.value.replace(/\D/g, '');

    // Se o valor for maior que 2 dígitos, formatamos ele para ter 2 casas decimais
    let formattedValue = onlyDigits;

    // Se o número tiver mais que dois dígitos, insere a vírgula
    if (formattedValue.length > 2) {
        formattedValue = formattedValue.slice(0, -2) + ',' + formattedValue.slice(-2);
    }

    // Atualiza o valor no campo
    event.target.value = formattedValue;
}

const currency = (valor, currency = 'BRL') => {
    // Formata o número como moeda
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency,
        minimumFractionDigits: 2, // Garante que tenha 2 casas decimais
        maximumFractionDigits: 2,
    }).format(valor);
}

//Warning Confirm
window.warningConfirm = function (e, text, icon, confirmButtonText) {
    e.preventDefault();
    var form = e.target.closest('form');

    Swal.fire({
        title: "Você tem Certeza?",
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: confirmButtonText,
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
};

// Validação da Data
function validateDate() {
    document.getElementById('dateForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const dateInputs = document.querySelectorAll('.dateInput');
        const errorMessage = document.getElementById('errorMessage');

        let isValid = true;

        dateInputs.forEach(function (dateInput) {
            const dateFormated = moment(dateInput.value, 'DD/MM/YYYY').format('YYYY-MM-DD');
            const dateValue = new Date(dateFormated);
            const minDate = new Date('1960-01-01');
            const maxDate = new Date('2200-12-31');

            if (dateValue < minDate || dateValue > maxDate || isNaN(dateValue)) {
                errorMessage.style.display = 'inline';
                isValid = false;
            } else {
                errorMessage.style.display = 'none';
                dateInput.style.borderColor = '';
            }
        });

        if (isValid) {
            this.submit();
        }
    });
}

// View Anamnese - Função para habilitar/desabilitar inputs dependendo da checkbox
function toggleInput(checkbox) {
    const targetClass = checkbox.getAttribute('data-target');
    const targetInputs = document.querySelectorAll(`.${targetClass}`);

    // Se a checkbox estiver marcada, habilita os inputs. Caso contrário, desabilita.
    targetInputs.forEach(function (input) {
        if (checkbox.checked) {
            input.disabled = false;
        } else {
            input.disabled = true;
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const elementsToUpdate = [
        { selector: 'input[type="file"]', handler: updateImageLabel, event: 'change' },
        { selector: 'input[type="file"]', handler: updateImagePreview, event: 'change' },
        { selector: '#tipo_gasto', handler: handleExpenseTypeChange, event: 'change' },
        // { selector: '.anamnesis_student', handler: handleAnamnesisStudentChange, event: 'change' },
    ];

    // Verificação de todos os elementos que podem não existir
    elementsToUpdate.forEach(({ selector, handler, event }) => {
        const elements = document.querySelectorAll(selector);
        elements.forEach(element => {
            if (element) {
                element.addEventListener(event, handler);
            } else {
                console.error(`Elemento ${selector} não encontrado no DOM.`);
            }
        });
    });

    // Inicializa o estado dos inputs conforme o estado das checkboxes
    const checkboxes = document.querySelectorAll('input[type="checkbox"][data-target]');
    checkboxes.forEach(function (checkbox) {
        toggleInput(checkbox);
    });

    // Inicializa o estado dos campos conforme o valor inicial do select 
    const tipoGastoSelect = document.getElementById('tipo_gasto'); 
    if (tipoGastoSelect) { 
        mostrarCampos(tipoGastoSelect.value); 
    }

    if (document.querySelector('.dateInput')) {
        validateDate();
    }

    if (window.messages && window.messages.success) { 
        toastr.success(window.messages.success); 
    } 
    if (window.messages && window.messages.error) { 
        toastr.error(window.messages.error); 
    }
});

function handleExpenseTypeChange(event) {
    var tipoGasto = event.target.value;
    mostrarCampos(tipoGasto);
}

function mostrarCampos(tipoGasto) {
    ocultarCampos();
    if (tipoGasto === 'Nota Fiscal') {
        document.getElementById('campo_nota_fiscal').style.display = 'block';
    } else if (tipoGasto === 'Recibo') {
        document.getElementById('campo_recibo').style.display = 'block';
    }
}

function ocultarCampos() {
    document.getElementById('campo_recibo').style.display = 'none';
    document.getElementById('campo_nota_fiscal').style.display = 'none';
}

// function handleAnamnesisStudentChange(event) {
//     const studentId = event.target.value;
//     if (studentId) {
//         fetch(`/anamnesis/${studentId}`)
//             .then(response => response.json())
//             .then(data => {
//                 document.getElementById('turma').value = data.turma;
//                 document.getElementById('turno').value = data.turno;
//                 document.getElementById('escola').value = data.escola;
//             })
//             .catch(error => console.error('Erro:', error));
//     } else {
//         document.getElementById('turma').value = '';
//         document.getElementById('turno').value = '';
//         document.getElementById('escola').value = '';
//     }
// }