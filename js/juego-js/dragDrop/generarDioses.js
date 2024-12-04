document.addEventListener("DOMContentLoaded", async () => {
    const preguntaContainer = document.getElementById("woodquest");
    const dragContainer = document.getElementById("drag-container");
  
    try {
      const response = await fetch(`../js/juego-js/dragDrop/parametros.php`);
      const data = await response.json();
  
      if (data.error) {
        throw new Error(data.error);
      }
  
      if (preguntaContainer) {
        preguntaContainer.innerHTML = `
          <h1 class="pregunta-texto text-center">${data.pregunta}</h1>
          <p id="contador" class="text-center">Tiempo restante: 20s</p>
        `;
      }
  
      const imagenes = data.imagenes;
      if (imagenes.length === 0) {
        throw new Error("No se encontraron imágenes.");
      }
  
      dragContainer.innerHTML = "";
  
      imagenes.forEach((imagen, index) => {
        const imgDiv = document.createElement("div");
        imgDiv.className = "draggable text-center";
        imgDiv.id = `item${index + 1}`;
        imgDiv.draggable = true;
  
        const imgElement = document.createElement("img");
        imgElement.src = imagen.imagen_url;
        imgElement.alt = imagen.nombre;
        imgElement.className = "img-dios";
  
        const nameElement = document.createElement("p");
        nameElement.textContent = imagen.nombre;
        nameElement.className = "nombre-dios";
  
        imgDiv.appendChild(imgElement);
        imgDiv.appendChild(nameElement);
        dragContainer.appendChild(imgDiv);
  
        imgDiv.addEventListener("dragstart", (event) => {
          event.dataTransfer.setData("text/plain", imgDiv.id);
          console.log(`Inicio de arrastre: ${imgDiv.id}`);
        });
  
        imgDiv.addEventListener("dragend", () => {
          console.log(`Fin de arrastre: ${imgDiv.id}`);
        });
      });
  
      console.log(`Se configuraron ${imagenes.length} elementos para arrastrar.`);
    } catch (error) {
      console.error("Error al cargar los datos:", error);
      if (preguntaContainer) {
        preguntaContainer.innerHTML = `
          <h1 class="text-danger text-center">Error al cargar los datos.</h1>
        `;
      }
    }
  });