
    let paginaActual = 1;

    function cargarPagina(page) {
        if (page < 1) return;

        let url = `/carnet_index/?page=${page}`;

        fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
        .then(response => response.json())
        .then(data => {
            let tbody = document.querySelector("#tabla-carnets");
            if (!tbody) return console.error("No se encontró la tabla en el DOM.");
            tbody.innerHTML = "";

            data.data.forEach(carnet => {
                let row = `
                    <tr>
                        <td>${carnet.ficha}</td>
                        <td>${carnet.num_doc}</td>
                        <td>${carnet.nombre}</td>
                        <td class="estado">${carnet.estado ? "Activo" : "Inactivo"}</td>
                        <td>${carnet.rol}</td>
                        <td>
                            <button class="btn ${carnet.estado ? 'btn-danger' : 'btn-success'}" onclick="cambiarEstado(${carnet.num_doc}, this)">
                                ${carnet.estado ? "Deshabilitar" : "Habilitar"}
                            </button>
                        </td>
                    </tr>`;
                tbody.innerHTML += row;
            });

            document.querySelector("#btn-prev").disabled = !data.has_prev;
            document.querySelector("#btn-next").disabled = !data.has_next;
            document.querySelector("#total-carnets").innerText = data.total_carnets;
            paginaActual = page;
        })
        .catch(error => console.error("Error en la paginación:", error));
    }
    function buscarUsuario() {
        const filtro = document.getElementById("buscador").value.toLowerCase();
        const filas = document.querySelectorAll("#tabla-carnets tr");

        filas.forEach(fila => {
            const doc = fila.children[1]?.innerText.toLowerCase();
            if (doc && doc.includes(filtro)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    }
    function cambiarEstado(num_doc, boton) {
        let url = `/estado_carnet/${num_doc}/`;
    
        fetch(url, {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRFToken": getCSRFToken()
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error("Error al cambiar estado:", data.error);
            } else {
                // Encontrar la fila del usuario afectado
                let fila = boton.closest("tr");
                let estadoCelda = fila.querySelector(".estado");
                let totalCarnets = document.querySelector("#total-carnets");
    
                // Usar el nuevo estado enviado por el servidor
                if (data.nuevo_estado === 1) {
                    estadoCelda.innerText = "Activo";
                    boton.className = "btn btn-danger";
                    boton.innerText = "Deshabilitar";
                } else {
                    estadoCelda.innerText = "Inactivo";
                    boton.className = "btn btn-success";
                    boton.innerText = "Habilitar";
                }
    
                // Actualizar el contador de carnets con el valor real
                totalCarnets.innerText = data.total_carnets;
            }
        })
        .catch(error => console.error("Error al cambiar estado:", error));
    }
    
    // Función para obtener el CSRF Token correctamente
    function getCSRFToken() {
        let csrfToken = null;
        document.cookie.split(";").forEach(cookie => {
            let [name, value] = cookie.trim().split("=");
            if (name === "csrftoken") {
                csrfToken = value;
            }
        });
        return csrfToken;
    }
    
    
