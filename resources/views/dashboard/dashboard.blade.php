<!-- filepath: /C:/Users/Steve/santeIA/resources/views/dashboard/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- HEADER -->
    <header class="bg-success text-white p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h2>IA-FIRMIERE</h2>
            <div>
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Photo de {{ $user->prenom }}" class="img-thumbnail" width="150">
                <h1>Bienvenue, {{ $user->prenom }}</h1>
                <a href="{{ route('home', ['form' => 'logout']) }}" class="btn btn-outline-light">deconnexion</a>
                <!-- Bouton pour ouvrir le chat -->
                <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#chatModal">
                    Ouvrir le Chat
                </button>
            </div>
        </div>
    </header>
    <div class="container mt-5">
    </div>

    <div class="container py-5">
        <h1 class="text-center text-primary mb-4">Tableau de Bord de Santé Cardiovasculaire</h1>

        <!-- Cartes des Statistiques Clés -->
        <div class="row mb-4">
            <!-- Fréquence cardiaque -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Fréquence Cardiaque</h5>
                        <p class="display-4 text-primary">{{ $healthData['latestHeartRate'] }} bpm</p>
                    </div>
                </div>
            </div>

            <!-- Tension artérielle -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Tension Artérielle</h5>
                        <p class="display-4 text-primary">{{ $healthData['latestBloodPressure'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Poids -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Poids</h5>
                        <p class="display-4 text-primary">{{ $healthData['latestWeight'] }} kg</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphique Fréquence Cardiaque -->
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Graphique de Fréquence Cardiaque</h5>
                        <canvas id="heartRateChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conseils Santé -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Conseils Personnalisés</h5>
                        <ul>
                            <li>Faites de l'exercice régulièrement.</li>
                            <li>Réduisez le sel dans votre alimentation.</li>
                            <li>Contrôlez régulièrement votre tension artérielle.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Chat -->
<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="chatModalLabel">Chat avec IA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <!-- Chatbox -->
                <div id="chatBox" style="height: 300px; overflow-y: auto; border-radius: 10px; padding: 10px; background-color: #ffffff; border: 1px solid #ddd;">
                    <!-- Messages -->
                </div>
                
                <!-- Ajout de fichiers -->
                <div class="d-flex justify-content-between mt-2">
                    <input type="file" id="fileInput" class="form-control" style="display: none;">
                    <button class="btn btn-outline-secondary" id="fileButton">
                        <i class="bi bi-paperclip"></i> Joindre un fichier
                    </button>
                    
                    <!-- Zone d'entrée de texte -->
                    <div class="input-group mt-3 w-75">
                        <input type="text" id="chatInput" class="form-control rounded-pill" placeholder="Tapez votre message..." aria-label="Votre message">
                        <button class="btn btn-primary rounded-pill" id="sendChat" type="button">
                            <i class="bi bi-send"></i> Envoyer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import de Bootstrap et des icônes -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    {{-- Ajouter le script pour le graphique --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Exemple de graphique pour la fréquence cardiaque
        var ctx = document.getElementById('heartRateChart').getContext('2d');
        var heartRateChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($heartRateData['labels']),  // Données dynamiques du contrôleur
                datasets: [{
                    label: 'Fréquence Cardiaque',
                    data: @json($heartRateData['values']), // Données dynamiques du contrôleur
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                scales: {
                    x: {
                        beginAtZero: true,
                    },
                    y: {
                        beginAtZero: true,
                    },
                }
            }
        });

        // Script pour le chat

        document.getElementById('sendChat').addEventListener('click', function() {
    var chatInput = document.getElementById('chatInput');
    var chatBox = document.getElementById('chatBox');

    if (chatInput.value.trim() !== "") {
        var userMessage = document.createElement('div');
        userMessage.classList.add('chat-message', 'text-end', 'mb-2');
        userMessage.innerHTML = '<div class="bg-primary text-white p-2 rounded-pill d-inline-block">' + chatInput.value + '</div>';
        chatBox.appendChild(userMessage);

        // Ajout d'un message automatique de l'IA
        var aiMessage = document.createElement('div');
        aiMessage.classList.add('chat-message', 'mb-2');
        aiMessage.innerHTML = '<div class="bg-light text-dark p-2 rounded-pill d-inline-block">' + "Réponse automatique de l'IA." + '</div>';
        chatBox.appendChild(aiMessage);

        // Faire défiler la boîte de chat jusqu'en bas
        chatBox.scrollTop = chatBox.scrollHeight;

        // Effacer l'input
        chatInput.value = "";
    }
});

// Fonction pour activer l'input de fichier lorsque l'on clique sur le bouton "Joindre un fichier"
document.getElementById('fileButton').addEventListener('click', function() {
    document.getElementById('fileInput').click();
});

// Gérer l'affichage du fichier téléchargé
document.getElementById('fileInput').addEventListener('change', function(event) {
    var fileInput = event.target;
    var fileName = fileInput.files[0].name;

    // Affichage du message avec le nom du fichier
    var fileMessage = document.createElement('div');
    fileMessage.classList.add('chat-message', 'text-end', 'mb-2');
    fileMessage.innerHTML = '<div class="bg-success text-white p-2 rounded-pill d-inline-block">Fichier joint : ' + fileName + '</div>';
    document.getElementById('chatBox').appendChild(fileMessage);
});

                // Envoyer le message à l'IA (exemple de requête AJAX)
                fetch('/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    var aiMessage = document.createElement('div');
                    aiMessage.textContent = 'IA: ' + data.response;
                    chatBox.appendChild(aiMessage);
                    chatBox.scrollTop = chatBox.scrollHeight;
                });    

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>