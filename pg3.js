// Sample JSON data (can be replaced with fetched data)
const data = {
    events: [
        { id: 1, name: "Championship Finals", date: "2024-07-15", location: "Stadium A" },
        { id: 2, name: "All-Star Game", date: "2024-08-01", location: "Arena B" }
    ],
    starPlayers: [
        { id: 101, name: "Jordan Smith", position: "Guard", team: "Eagles", stats: { points: 28, assists: 7 } },
        { id: 102, name: "Leah Brown", position: "Forward", team: "Falcons", stats: { points: 22, rebounds: 10 } }
    ]
};

// Function to render events
function renderEvents(events) {
    const eventsContainer = document.getElementById('events');
    eventsContainer.innerHTML = '<h2>Events</h2>' +
        events.map(event =>
            `<div class="event">
                <strong>${event.name}</strong><br>
                Date: ${event.date}<br>
                Location: ${event.location}
            </div>`
        ).join('');
}

// Function to render star players
function renderStarPlayers(players) {
    const playersContainer = document.getElementById('starPlayers');
    playersContainer.innerHTML = '<h2>Star Players</h2>' +
        players.map(player =>
            `<div class="player">
                <strong>${player.name}</strong> (${player.position}, ${player.team})<br>
                Stats: Points - ${player.stats.points}${player.stats.assists ? ', Assists - ' + player.stats.assists : ''}${player.stats.rebounds ? ', Rebounds - ' + player.stats.rebounds : ''}
            </div>`
        ).join('');
}

// Render on page load
document.addEventListener('DOMContentLoaded', () => {
    renderEvents(data.events);
    renderStarPlayers(data.starPlayers);
});