document.addEventListener("DOMContentLoaded", () => {
    setupDraggableElements();
  });
  
  function setupDraggableElements() {
    const draggables = document.querySelectorAll(".draggable");
  
    draggables.forEach((draggable) => {
      draggable.addEventListener("dragstart", handleDragStart);
      draggable.addEventListener("dragend", handleDragEnd);
    });
  
    console.log(`Se configuraron ${draggables.length} elementos para arrastrar.`);
  }
  
  function handleDragStart(event) {
    event.dataTransfer.setData("text/plain", event.target.id);
    console.log(`Inicio de arrastre: ${event.target.id}`);
  }
  
  function handleDragEnd(event) {
    console.log(`Fin de arrastre: ${event.target.id}`);
  }