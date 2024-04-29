// Création d'un objet XMLHttpRequest
let xhr = new XMLHttpRequest();

let table = document.getElementById('defaulTable');

if (document.getElementById("searchBtn")) {
    document.getElementById("searchBtn").addEventListener('click', () => {
        let searchText = document.getElementById('searchText');
        search(searchText.value);
    });
}

let tbody = table.querySelector('tbody');
// Définition de la méthode et de l'URL de la requête
xhr.open("POST", "./enginePhp/getAllStage.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

let allStage = [], proStage = [], academicStage = [], finishedStage = [];

// Ajout d'un événement de rappel à l'événement `load`
xhr.onload = function () {
    try {
        // Récupération des données JSON
        var data = xhr.responseText;
        //console.log(xhr.response);
        var d = JSON.parse(data);
        if (d.status == 'success') {
            const jsonObj = JSON.parse(data);
            allStage = jsonObj.allStage;
            proStage = jsonObj.proStage;
            academicStage = jsonObj.academicStage;
            finishedStage = jsonObj.finishedStage;

            tbody.innerHTML = "";
            //console.log(allStage, proStage, academicStage, finishedStage);
            let classi = "";
            for (let i = 0; i < allStage.length; i++) {
                if (allStage[i].status.includes("En cours")) {
                    if (allStage[i].status.includes("fini"))
                        classi = "status pending";
                    else classi = "status delivered";
                }
                else classi = "status return";

                tbody.innerHTML += `
                <tr>
                    <td>${allStage[i].nom_complet}</td>
                    <td>${allStage[i].departement}</td>
                    <td>${allStage[i].type_stage}</td>
                    <td>${allStage[i].date_debut}</td>
                    <td>${allStage[i].duree}</td>
                    <td><span class="${classi}">${allStage[i].status}</span></td>
                    <td>
                        <ul>
                            <li>
                                <a class="small-btn bg-primary" href="stageView.php?id=${allStage[i].id}">
                                    <i class="ti-eye"></i>
                                </a>
                            </li>
                            <li>
                                <a class="small-btn bg-yellow" href="form.php?id=${allStage[i].id}">
                                    <i class="ti-pencil"></i>
                                </a>
                            </li>
                            <li onclick="deleteStage(${allStage[i].id})" >
                                <a class="small-btn" href="#">
                                    <i class="ti-trash"></i>
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
                `;
            }

            //Ajout des markers des accords
        }
        else {
            alert("Erreur de lecture dans la base des données :" + data.msg)
        }
    }
    catch (e) {
        alert("Erreur de lecture dans la base des données :" + e)
    }

};

function reloadTable() {
    xhr.open("POST", "../enginePhp/getAllStage.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();

    search("");
}

function deleteStage(id) {
    console.log("Deleting")
    if (confirm("Voulez-vous supprimer ce stagiaire?")) {
        window.location.href = "./enginePhp/delete.php?id=" + id;
    }
}

function search(mot) {
    const rows = tbody.querySelectorAll('tr');
    //console.log("Searching", mot)
    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        let found = false;

        if (mot == "") {
            //console.log("no Term");
            row.style.display = 'table-row';
        }
        else {
            cells.forEach(cell => {
                const cellText = cell.textContent.toLocaleLowerCase();
                if (cellText.includes(mot)) {
                    found = true;
                    //console.log("Found", row);
                    //row.style.display = found ? 'table-row' : 'noe';
                    //return;
                }
                row.style.display = found ? 'table-row' : 'none';
            });
        }

    });
}

// Envoi de la requête
xhr.send();

//tbody.innerHTML="";
//console.log(tbody);