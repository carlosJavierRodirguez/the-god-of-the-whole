// Variables para el drag-and-drop
const draggables = document.querySelectorAll('.draggable');
const dropzone = document.getElementById('dropzone');

// Añade eventos de arrastrar y soltar
draggables.forEach(draggable => {
  draggable.addEventListener('dragstart', dragStart);
  draggable.addEventListener('dragend', dragEnd);
});

dropzone.addEventListener('dragover', dragOver);
dropzone.addEventListener('dragenter', dragEnter);
dropzone.addEventListener('dragleave', dragLeave);
dropzone.addEventListener('drop', drop);

function dragStart(e) {
  e.dataTransfer.setData('text/plain', e.target.id);
  setTimeout(() => (e.target.style.display = 'none'), 0);
}

function dragEnd(e) {
  e.target.style.display = 'block';
}

function dragOver(e) {
  e.preventDefault();
}

function dragEnter(e) {
  e.preventDefault();
  dropzone.classList.add('over');
}

function dragLeave(e) {
  dropzone.classList.remove('over');
}

function drop(e) {
  const id = e.dataTransfer.getData('text');
  const draggable = document.getElementById(id);
  dropzone.appendChild(draggable);
  draggable.style.display = 'block';
}