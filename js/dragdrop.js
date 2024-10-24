// Variables para el drag-and-drop
const draggables = document.querySelectorAll('.draggable');
const dropzone = document.getElementById('dropzone');
const originalPositions = {};

// Almacenar las posiciones originales de los elementos arrastrables
draggables.forEach(draggable => {
    originalPositions[draggable.id] = {
        parent: draggable.parentElement,
        left: draggable.offsetLeft,
        top: draggable.offsetTop,
    };
    
    draggable.addEventListener('dragstart', dragStart);
    draggable.addEventListener('dragend', dragEnd);
});

// Eventos de la zona de drop
dropzone.addEventListener('dragover', dragOver);
dropzone.addEventListener('dragenter', dragEnter);
dropzone.addEventListener('dragleave', dragLeave);
dropzone.addEventListener('drop', drop);

function dragStart(e) {
    e.dataTransfer.setData('text/plain', e.target.id);
    setTimeout(() => {
        e.target.classList.add('invisible');
    }, 0);
}

function dragEnd(e) {
    e.target.classList.remove('invisible');
}

function dragOver(e) {
    e.preventDefault();
}

function dragEnter(e) {
    e.preventDefault();
}

function dragLeave(e) {
    // No se necesita ninguna acción aquí
}

function drop(e) {
    e.preventDefault();
    
    const id = e.dataTransfer.getData('text');
    const draggable = document.getElementById(id);

    // Obtener la posición del mouse y el rectángulo del dropzone
    const dropzoneRect = dropzone.getBoundingClientRect();
    const x = e.clientX - dropzoneRect.left;
    const y = e.clientY - dropzoneRect.top;

    // Colocar el elemento arrastrado en la posición del mouse
    draggable.style.position = 'absolute';
    draggable.style.left = `${x}px`;
    draggable.style.top = `${y}px`;

    // Agregar el draggable al dropzone
    dropzone.appendChild(draggable);
}

// Retornar el elemento a su posición original si se suelta fuera del dropzone
document.addEventListener('dragend', function(e) {
    const draggable = e.target;

    // Si no se suelta dentro del dropzone, volver a la posición original
    if (!dropzone.contains(draggable)) {
        const originalPos = originalPositions[draggable.id];
        draggable.style.position = 'relative';
        draggable.style.left = `${originalPos.left}px`;
        draggable.style.top = `${originalPos.top}px`;

        // Reinserta el draggable en su contenedor original
        originalPos.parent.appendChild(draggable);
    }
});