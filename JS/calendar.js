const reservations = [
    { start: "2024-12-10", end: "2024-12-15" }, // Exemplo de datas reservadas
    { start: "2024-12-20", end: "2024-12-25" },
];

function createCalendar(year, month) {
    const calendarGrid = document.getElementById("calendarGrid");
    calendarGrid.innerHTML = ""; // Limpa o calendário anterior

    const firstDay = new Date(year, month, 1).getDay(); // Primeiro dia do mês
    const daysInMonth = new Date(year, month + 1, 0).getDate(); // Número de dias no mês

    // Preencher os dias vazios antes do primeiro dia do mês
    for (let i = 0; i < firstDay; i++) {
        const emptyDiv = document.createElement("div");
        calendarGrid.appendChild(emptyDiv);
    }

    // Gerar os dias do mês
    for (let day = 1; day <= daysInMonth; day++) {
        const currentDate = `${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;
        const dayDiv = document.createElement("div");
        dayDiv.textContent = day;

        // Verifica se a data está reservada
        if (isDateReserved(currentDate)) {
            dayDiv.classList.add("disabled");
        } else {
            dayDiv.classList.add("available");
        }

        calendarGrid.appendChild(dayDiv);
    }
}

function isDateReserved(date) {
    return reservations.some(reservation => {
        const start = new Date(reservation.start);
        const end = new Date(reservation.end);
        const current = new Date(date);
        return current >= start && current <= end;
    });
}

// // Controle de navegação do calendário
// let currentYear = new Date().getFullYear();
// let currentMonth = new Date().getMonth();

// function updateCalendar() {
//     const currentMonthName = new Date(currentYear, currentMonth).toLocaleString("default", { month: "long" });
//     document.getElementById("currentMonth").textContent = `${currentMonthName} ${currentYear}`;
//     createCalendar(currentYear, currentMonth);
//     console.log("updateCalendar");
// }

// document.getElementById("prevMonth").addEventListener("click", () => {
//     currentMonth--;
//     if (currentMonth < 0) {
//         currentMonth = 11;
//         currentYear--;
//     }
//     updateCalendar();
// });

// document.getElementById("nextMonth").addEventListener("click", () => {
//     currentMonth++;
//     if (currentMonth > 11) {
//         currentMonth = 0;
//         currentYear++;
//     }
//     updateCalendar();
// });

// // Inicializa o calendário
// updateCalendar();

// document.addEventListener('DOMContentLoaded', function () {
//     const matricula = document.getElementById('matricula').value;

//     fetch(`../get_reserved_dates.php?matricula=${encodeURIComponent(matricula)}`)
//         .then(response => response.json())
//         .then(data => {
//             console.log(data);
//             reservations.push(...data); // Adiciona as reservas obtidas ao array
//             updateCalendar(); // Atualiza o calendário
//         })
//         .catch(error => console.error("Error fetching reserved dates:", error));
// });