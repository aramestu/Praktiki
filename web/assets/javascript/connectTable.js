document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const parameter = urlParams.get('parameter');
        console.log("Showing results for", parameter);

        // Add click event listeners to each session cell
        const sessionCells = document.querySelectorAll('.session-cell');
        sessionCells.forEach(cell => {
            const sessionId = cell.dataset.sessionId;
            cell.addEventListener('click', () => {
                window.top.location.href = `/session.html?parameter=${sessionId}`;
            });
        });
});