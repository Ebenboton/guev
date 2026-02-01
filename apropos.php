<?php
session_start();
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - GUEV</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap4.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/apropos.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">

</head>

<body>
    <!-- Inclusion de l'en-tête -->
    <?php include 'header.php'; ?>

    <main>
        <!-- Section qui sommes nous  -->
        <section class="section-guev py-5">
            <div class="container">
                <div class="row align-items-center">

                    <!-- IMAGE -->
                    <div class="col-md-5 text-center mb-4 mb-md-0">
                        <img src="assets/images/question1.jpg" alt="GUEV logo illustration" class="img-fluid full-image">
                    </div>

                    <!-- TEXTE -->
                    <div class="col-md-7">
                        <h1 class="fw-bold text-success mb-3">Qui sommes-nous ?</h1>
                        <p>
                            <strong>GUEV Ecological Venture</strong> est une entreprise sociale et solidaire (Société À
                            Responsabilité Limitée) de droit béninois, à impact africain et à utilité globale.
                            Positionnée dans les énergies renouvelables, l’ingénierie verte et les technologies écoresponsables
                            centrées sur l’humain, elle œuvre à catalyser des solutions durables,
                            au profit des Peuples, de la Planète et la Postérité.
                        </p>
                        <p>
                            Les solutions vertes produites et promues par GUEV sont technologiquement fiables et économiquement
                            viables, et génèrent des effets positifs avérés sur
                            l’environnement, le climat, la santé, l’économie locale, la performance des systèmes agricoles et
                            alimentaires, et la société, en l’occurrence
                            sur l’autonomisation des femmes et la résilience des communautés rurales ainsi que sur la création
                            d’emplois décents.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- Section GUEV un rêve -->
        <section class="main-section">
            <h1 class="title">GUEV, un rêve</h1>
            <div class="cards-container">
                <!-- Card Vision -->
                <div class="card">
                    <h2 class="card-title">Notre vision</h2>
                    <p class="card-text">
                        Contribuer à accélérer la mise en place d’une infrastructure de développement économique à faible empreinte carbone, à fort potentiel de création d’emploi, et résilient aux changements climatiques. »
                    </p>
                </div>

                <!-- Card Mission -->
                <div class="card">
                    <h2 class="card-title">Notre mission</h2>
                    <p class="card-text">
                        Produire et commercialiser des innovations technologiques industrielles inclusives et vertes via des procédés et stratégies créatrices d’opportunités d’emplois, surtout en milieu rural.
                    </p>
                </div>

                <!-- Card Défi -->
                <div class="card">
                    <h2 class="card-title">Notre défi à l’horizon 2030</h2>
                    <p class="card-text">
                        Par nos solutions vertes, faire atteindre l’autonomie en énergie de cuisson et d’éclairage à au moins 60 millions de ménages ruraux et périurbains d’Afrique et créer 15.000 emplois directs, stables et décents pour des femmes rurales, et jeunes citoyens africains et afro descendants de moins de 35 ans.
                    </p>
                </div>
            </div><br><br>
        </section>

        <!-- Section Priorités -->
        <section class="priorites-guev-section py-5 bg-light">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold">Nos priorités</h2>
                <p class="text-muted">d'ci l'horizon 2030 </p>
            </div>

            <div class="flex">
                <div class="card" style="width: 18rem;" id="card">
                    <div class="card-body">
                        <h5 class="card-title">Energie</h5>
                        <p class="card-text" id="t-c">
                            Autonomiser la femme rurale des contraintes des énergies de cuisson et d’éclairage dans le ménage </p>
                    </div>
                </div>

                <div class="card" style="width: 18rem;" id="card">
                    <div class="card-body">
                        <h5 class="card-title">Economie</h5>
                        <p class="card-text" id="t-c">
                            Dynamiser la participation économique de la
                            femmes dans les AGR porteuses de valeur ajoutée communautaire </p>
                    </div>
                </div>


                <div class="card" style="width: 18rem;" id="card">
                    <div class="card-body">
                        <h5 class="card-title">Ecologie</h5>
                        <p class="card-text" id="t-c">
                            Renforcer la participation des filles et
                            femmes à la cocréation de solutions viables
                            aux défis écologiques contemporains majeurs </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- Section Activités -->
        <section class="green-cook-activities py-5 bg-white">
            <div class="container">
                <h2 class="fw-bold text-center mb-5" data-aos="fade-up">Nos activités</h2>

                <div class="row g-4">
                    <!-- Activité 01 -->
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="activity-card shadow-sm p-4 text-center h-100 border-start border-4 border-success">
                            <div class="activity-number">01</div>
                            <h6 class="fw-bold text-success">GUEV Official Launch</h6>
                            <p class="small mb-0">Lancement officiel de la gamme de cuisinières biodigitales efficientes GUEV.
                            </p>
                        </div>
                    </div>

                    <!-- Activité 02 -->
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="150">
                        <div class="activity-card shadow-sm p-4 text-center h-100 border-start border-4 border-success">
                            <div class="activity-number">02</div>
                            <h6 class="fw-bold text-success">Green Cook Fair</h6>
                            <p class="small mb-0">Foire Exposition de solutions vertes en énergie de cuisson propre et sobre en
                                carbone.</p>
                        </div>
                    </div>

                    <!-- Activité 03 -->
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                        <div class="activity-card shadow-sm p-4 text-center h-100 border-start border-4 border-success">
                            <div class="activity-number">03</div>
                            <h6 class="fw-bold text-success">Green Cook Ed</h6>
                            <p class="small mb-0">Formations, Ateliers, Initiations & MasterClass thématiques.</p>
                        </div>
                    </div>

                    <!-- Activité 04 -->
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="250">
                        <div class="activity-card shadow-sm p-4 text-center h-100 border-start border-4 border-success">
                            <div class="activity-number">04</div>
                            <h6 class="fw-bold text-success">Green Fuel Hackathon</h6>
                            <p class="small mb-0">Compétition d’ingénierie de biocombustibles innovants.</p>
                        </div>
                    </div>

                    <!-- Activité 05 -->
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="activity-card shadow-sm p-4 text-center h-100 border-start border-4 border-success">
                            <div class="activity-number">05</div>
                            <h6 class="fw-bold text-success">Green Cook Gala</h6>
                            <p class="small mb-0">Soirée de networking sur les solutions vertes, l’efficacité énergétique, le
                                climat & le développement rural.</p>
                        </div>
                    </div>

                    <!-- Activité 06 -->
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="350">
                        <div class="activity-card shadow-sm p-4 text-center h-100 border-start border-4 border-success">
                            <div class="activity-number">06</div>
                            <h6 class="fw-bold text-success">GUEV Factory Field Trip</h6>
                            <p class="small mb-0">Visite des unités de production des foyers économiques et des réfractaires
                                céramiques à l'usine de GUEV.</p>
                        </div>
                    </div>

                    <!-- Activité 07 -->
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                        <div class="activity-card shadow-sm p-4 text-center h-100 border-start border-4 border-success">
                            <div class="activity-number">07</div>
                            <h6 class="fw-bold text-success">GUEV Awards</h6>
                            <p class="small mb-0">Célébration des entrepreneurs utilisateurs de solutions vertes en cuisson et
                                biocombustibles.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Objectifs -->

        <section id="objectifs-green-cook-fest">
            <div class="container">
                <h2 class="section-title">Nos objectifs</h2>
                <div class="objectives-layout">
                    <div class="objective-block objective-dev" data-aos="fade-right">
                        <h3>OBJECTIF DE DEVELOPPEMENT</h3>
                        <p>Contribuer à catalyser sur le continent africain, l’atteinte de l’Objectif de Développement Durable numéro 7 de l’Agenda 2030 des Nations Unies lié à la garantie de l’accès de tous à des services énergétiques fiables, durables et modernes, à un coût abordable, ainsi que celle de l’Aspiration 1, de l’Agenda 2063 de l’Union Africaine, relative à une Afrique prospère fondée sur la croissance inclusive et le développement durable. </p>
                    </div>
                    <div class="objective-block objective-global" data-aos="fade-left">
                        <h3>OBJECTIF GLOBAL</h3>
                        <p>Impulser, par un événement multi-acteur fédérateur axé autour de l’ingénierie verte, une révolution dans la fourniture d’une énergie de cuisson sobre en carbone et de biocombustibles écoresponsables aux populations des pays en voie de développement, tant pour les usages domestiques qu’industrielles. </p>
                    </div>
                </div>
            </div>
            <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
            <script>
                AOS.init({
                    duration: 1000, // Durée de l'animation en ms
                    once: true, // L'animation ne se joue qu'une seule fois au défilement
                });
            </script>

        </section>


        <!-- Section qui suis je  -->

        <section id="justin-hounguevou-profile">
            <div class="container">
                <h2 class="section-title">Qui suis-je ? </h2>
                <div class="profile-layout">
                    <div class="profile-text" data-aos="fade-right">
                        <h2 class="profile-name">Justin<br>HOUNGUEVOU</h2>
                        <p class="profile-role">Economiste Agricole,<br>Entrepreneur Social & Solidaire,<br>Expert
                            Enerconologue</p>
                        <p class="profile-details">
                            Promoteur de la Marque GUEV
                            Ingénieur-Concepteur de GUEV Biodigital Cooking Stove
                            Expert en Technologies Vertes Résilientes & en Ingénierie Carboneutre
                        </p>
                        <p>
                            Membre des Commissions Transfert des Technologies et Atténuation des
                            Effets des Changements Climatiques du Ministère du Cadre de Vie et du
                            Développement Durable du Bénin, à la COP 23.
                        </p>
                        <p>
                            Représentant Afrique chargé des Innovations Durables du Réseau des Jeunes
                            Entrepreneurs d'Afrique et du Québec (RJEAQ)
                        </p>
                        <p>
                            Directeur Exécutif de l'Observatoire Africain des Initiatives de Développement
                            Durable (OAFIDD)
                        </p>
                    </div>
                    <div class="profile-image-container" data-aos="fade-left">
                        <img src="assets/images/justin.jpg"
                            alt="Justin HOUNGUEVOU" class="profile-image">
                    </div>
                </div>
            </div>
            <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
            <script>
                AOS.init({
                    duration: 1000, // Durée de l'animation en ms
                    once: true, // L'animation ne se joue qu'une seule fois au défilement
                });
            </script>

        </section>

        <!-- Section Pathway -->

        <section id="guev-pathway">
            <div class="container">
                <h2 class="section-title">Notre parcours</h2>
                <div class="timeline">
                    <div class="timeline-item left" data-aos="fade-right">
                        <div class="timeline-content">
                            <div class="timeline-date">Février 2012</div>
                            <div class="timeline-icon">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <p>Démarrage de la recherche expérimentale sur les biocombustibles</p>
                        </div>
                    </div>
                    <div class="timeline-item right" data-aos="fade-left">
                        <div class="timeline-content">
                            <div class="timeline-date">Mars 2015</div>
                            <div class="timeline-icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <p>Démarrage de la R&D sur les équipements de cuisson propre, sobre en carbone</p>
                        </div>
                    </div>
                    <div class="timeline-item left" data-aos="fade-right">
                        <div class="timeline-content">
                            <div class="timeline-date">Mai 2018</div>
                            <div class="timeline-icon">
                                <i class="fas fa-globe-americas"></i>
                            </div>
                            <p>Montage réussi du 1er prototype fonctionnel de GUEV Cooker</p>
                        </div>
                    </div>
                    <div class="timeline-item right" data-aos="fade-left">
                        <div class="timeline-content">
                            <div class="timeline-date">Octobre 2018</div>
                            <div class="timeline-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <p>Présentation des Cuisinières GUEV au XVIIème Sommet de la Francophonie en Arménie</p>
                        </div>
                    </div>
                    <div class="timeline-item left" data-aos="fade-right">
                        <div class="timeline-content">
                            <div class="timeline-date">Janvier 2019</div>
                            <div class="timeline-icon">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <p>Obtention du brevet d'invention OAPI n° 120 190 0031</p>
                        </div>
                    </div>
                    <div class="timeline-item right" data-aos="fade-left">
                        <div class="timeline-content">
                            <div class="timeline-date">Juin 2021</div>
                            <div class="timeline-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <p>Projet CRDI GUEV Cooker (mesure de l'impact de GUEV sur l'autonomisation économique des Femmes au Bénin)</p>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
            <script>
                AOS.init({
                    duration: 1000, // Durée de l'animation en ms
                    once: true, // L'animation ne se joue qu'une seule fois au défilement
                });
            </script>

        </section>


        <!-- Section Partenaires -->
        <section class="partenaires-section">
            <div class="container">
                <h2 class="fw-bold text-success text-center mb-4">Partenaires Cibles</h2>

                <div class="carousel" id="carousel-partenaires">
                    <div class="carousel-inner">
                        <!-- Page 1 -->
                        <div class="carousel-item active">
                            <div class="logo-grid">
                                <img src="assets/images/logos/img1.jpg" alt="Partenaire 1">
                                <img src="assets/images/logos/img2.jpg" alt="Partenaire 2">
                                <img src="assets/images/logos/img3.jpg" alt="Partenaire 3">
                                <img src="assets/images/logos/img4.jpg" alt="Partenaire 4">
                                <img src="assets/images/logos/img5.jpg" alt="Partenaire 5">
                                <img src="assets/images/logos/img6.jpg" alt="Partenaire 6">
                                <img src="assets/images/logos/img7.jpg" alt="Partenaire 7">

                            </div>
                        </div>

                        <!-- Page 2 -->
                        <div class="carousel-item">
                            <div class="logo-grid">
                                <img src="assets/images/logos/img8.jpg" alt="Partenaire 1">
                                <img src="assets/images/logos/img9.jpg" alt="Partenaire 2">
                                <img src="assets/images/logos/img10.jpg" alt="Partenaire 3">
                                <img src="assets/images/logos/img11.jpg" alt="Partenaire 4">
                                <img src="assets/images/logos/img12.jpg" alt="Partenaire 5">
                                <img src="assets/images/logos/img13.jpg" alt="Partenaire 6">
                                <img src="assets/images/logos/img14.jpg" alt="Partenaire 7">
                            </div>
                        </div>
                    </div>

                    <!-- Pagination Dots -->
                    <div class="carousel-dots">
                        <span class="dot active"></span>
                        <span class="dot"></span>
                    </div>
                </div>
            </div>
            <script>
                let currentIndex = 0;
                const carousel = document.getElementById("carousel-partenaires");
                const items = carousel.querySelectorAll(".carousel-item");
                const dots = carousel.querySelectorAll(".dot");

                function showSlide(index) {
                    const offset = -index * 100;
                    carousel.querySelector(".carousel-inner").style.transform = `translateX(${offset}%)`;
                    dots.forEach(dot => dot.classList.remove("active"));
                    dots[index].classList.add("active");
                }

                setInterval(() => {
                    currentIndex = (currentIndex + 1) % items.length;
                    showSlide(currentIndex);
                }, 4000);
            </script>

        </section>

    </main>

    <!-- Inclusion du pied de page -->
    <?php include 'footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>