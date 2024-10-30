function goToUrl(route) {
    window.location.href = route;
}

function updateImageLabel(event) {
    
    const fileInput = event.target;
    const labelImage = document.getElementById('label-image');

    if (fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        labelImage.textContent = fileName; // Atualiza o texto com o nome do arquivo
    } else {
        labelImage.textContent = 'Nenhuma Imagem selecionada'; // Caso não tenha arquivo
    }
}