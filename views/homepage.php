<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Bienvenue - Gestion des Clubs Universitaires</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .hero {
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('public/images/clubs') no-repeat center center;
      background-size: cover;
      color: white;
      padding: 100px 0;
    }
    .btn-connexion {
      font-size: 1.2rem;
      padding: 10px 25px;
    }
  </style>
</head>
<body>

 
  <section class="hero text-center">
    <div class="container">
      <h1 class="display-4 fw-bold">Bienvenue dans la plateforme de gestion des clubs universitaires</h1>
      <a href="index.php?action=login_d" class="btn btn-warning btn-connexion mt-4">Connexion</a>
    </div>
  </section>

  
  <section class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Pourquoi cette application ?</h2>
      <p class="text-center">Les clubs universitaires sont essentiels pour 
        développer l'esprit d'équipe, la créativité et l'engagement des 
        étudiants. Cette plateforme vise à centraliser la gestion,
         automatiser les processus,
         et faciliter la communication entre l’administration,
          les responsables et les étudiants.</p>
    </div>
  </section>

  
  <!-- À propos -->
  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-5">Clubs des années précédentes</h2>
      <div class="row align-items-center">
        <div class="col-md-4 d-flex justify-content-end">
          <img src="public/images/logo_creative.jpg" alt="logo_creative" class="img-fluid rounded shadow" style="width: 200px;" />
        </div>
        <div class="col-md-6">
          <h2>CLUB creative community</h2>
          <p>Creative Community est un club étudiant dédié à la créativité et aux arts.
             Il offre un espace d’expression pour les talents en design, photographie,
              écriture et création de contenu à travers des ateliers et des activités 
              interactives stimulant l’innovation et la sensibilité artistique.
          </p>
         
        </div>

        <div class="col-md-6 d-flex justify-content-end">
          <img src="public/images/logo_cyberdune.jpg" alt="logo_cyberdune" class="img-fluid rounded shadow"style="width: 200px;">
        </div>
        <div class="col-md-6">
          <h2>Club CYBER_DUNE </h2>
          <p>CyberDune est un club étudiant orienté vers le numérique 
            et les technologies. Il a pour objectif de développer les compétences des étudiants en programmation,
             cybersécurité, intelligence artificielle et technologies modernes à travers des ateliers,
              des compétitions et des activités éducatives.
          </p>
          
        </div>

        <div class="col-md-4 d-flex justify-content-end">
        <img src="public/images/logo_sportif.jpg" alt="logo_sportif" class="img-fluid rounded shadow "style="width: 200px ;">
        </div>
        <div class="col-md-6">
          <h2>Club Sportif</h2>
          <p>Le Club Sportif Universitaire est un espace dédié aux passionnés de sport,
             visant à promouvoir l’activité physique,
              l’esprit d’équipe et la compétition saine à travers des entraînements réguliers, 
            des tournois et divers événements sportifs</p>
          
         
        </div>
      </div>
    </div>
  </section>



  <!-- Modal pour le club cyberdune -->
  <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Détails de l'activité : Hackathon 2023</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Date :</strong> 15/02/2025</p>
          <p><strong>Organisé par :</strong> Club CYBER_DUNE</p>
          <p><strong>Description :</strong>  
            Le XMirage est un événement inter-universitaire sur le thème de la cybersécurité.  
            Les participants ont eu 48 heures pour développer une solution technique autour de la protection des données.  
            L'événement comprenait des ateliers, des conférences, et un jury composé de professionnels.
          </p>
          <p><strong>Nombre de participants :</strong> 120 étudiants</p>
          <img src="public/images/logo_cyberdune.jpg" class="img-fluid rounded" alt="photo de l'événement">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal pour le club sportif -->
  <div class="modal fade" id="sport" tabindex="-1" aria-labelledby="sport" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Détails de l'activité : Hackathon 2023</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Date :</strong> 15-17 Mai 2023</p>
          <p><strong>Organisé par :</strong> Club Sportif</p>
          <p><strong>Description :</strong>  
            Après un parcours plein de passion et de compétition, les deux équipes finalistes sont :

            ⚽ [RAJA WADNOUN ]
            ⚽ [HERO STREET]
            
            Elles s’affronteront dans un match final épique pour décrocher le titre de champion !.
          </p>
          <p><strong>Nombre de participants :</strong> 100 étudiants</p>
          <img src="public/images/logo_sportif.jpg" class="img-fluid rounded" alt="photo de l'événement">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>




<!-- Modal pour le club creative community -->
<div class="modal fade" id="creative" tabindex="-1" aria-labelledby="creative" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Détails de l'activité : Hackathon 2023</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><strong>Date :</strong> 9 march 2024</p>
        <p><strong>Organisé par :</strong> Club Creative community</p>
        <p><strong>Description :</strong>  
          activité solidaire visant à collecter des dons
           (vêtements, livres, nourriture ou argent) au profit des personnes 
           dans le besoin. Elle reflète l’esprit d’entraide et de responsabilité sociale
            au sein de la communauté étudiante.
        </p>
        <p><strong>Nombre de participants :</strong> 50 étudiants</p>
        <img src="public/images/logo_creative.jpg" class="img-fluid rounded" alt="photo de l'événement">
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>


  <!-- Clubs et Activités Passées -->
<section class="py-5 bg-light" >
    <div class="container">
      <h2 class="text-center mb-5">Clubs et Activités des années précédentes</h2>
      <div class="row g-4">

  
        <!-- Club 1 -->
        <div class="col-md-6"id="detailModal">
          <div class="card shadow-sm">
            <img src="public/images/activite_cyber_dune.jpg" class="card-img-top" alt="atelier informatique">
            <div class="card-body">
              <h5 class="card-title">Club CYBERDUNE– XMirage CTF 2025</h5>
              <p class="card-text">We're thrilled to announce XMirage CTF - the first-ever 
                Capture The Flag competition
                 in Southern Morocco! Brought to you by CYBERDUNE,
                 this exclusive event will push your skills to the limit.</p>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal">Voir plus</button>
            </div>

          </div>
        </div>
  
        
  
        <!-- Club 3 -->
        <div class="col-md-6" id="sport">
          <div class="card shadow-sm">
            <img src="public/images/final_sport.jpg" class="card-img-top" alt="club artistique" style="width:none">
            <div class="card-body">
              <h5 class="card-title">Club Sportif – FINAL 2023</h5>
              <p class="card-text">Après un parcours plein de passion et de compétition, les deux équipes finalistes sont :

                ⚽ [RAJA WADNOUN ]
                ⚽ [HERO STREET]
                
                Elles s’affronteront dans un match final épique pour décrocher le titre de champion !</p>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sport">Voir plus</button>
            </div>
          </div>
        </div>
        
  
        <!-- Club 4 -->
        <div class="col-md-6" id="creative">
          <div class="card shadow-sm">
            <img src="public/images/criative_activite.jpg" class="card-img-top" alt="club scientifique">
            <div class="card-body">
              <h5 class="card-title">Club creative_community – DONATE 9 MARCH 2024</h5>
              <p class="card-text">Organisation DONATE for childer part 2</p>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#creative">Voir plus</button>
            </div>
          </div>
        </div>
  
      </div>
    </div>
  </section>






  <!-- fonctionalites principales -->
  <section class="bg-light py-5">
    <div class="container">
      <h3 class="text-center mb-4">Fonctionnalités principales</h3>
      <div class="row text-center">
        <div class="col-md-4 mb-3">
          <div class="p-4 shadow-sm bg-white rounded">
            <h5>Gestion des Clubs</h5>
            <p>Créez, modifiez et organisez vos clubs facilement.</p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="p-4 shadow-sm bg-white rounded">
            <h5>Suivi des Activités</h5>
            <p>Programmez vos événements et suivez la participation des membres.</p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="p-4 shadow-sm bg-white rounded">
            <h5>Interaction Simplifiée</h5>
            <p>Communiquez avec l’administration et les étudiants en quelques clics.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <footer class="text-center py-3 bg-dark text-white">
    © 2025 - Gestion des Clubs Universitaires 
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>