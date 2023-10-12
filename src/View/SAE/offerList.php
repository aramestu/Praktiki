<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/offer.css">
</head>

<body>
    <div class="container">

<!--        PROPOSITION NOUVEAUX FILTRES-->
        <form method="get">
            <label for="dateDebut">Dates</label>
                    <select name="datePublication" id="datePublication">
                        <option value="last24">Dernières 24 heures</option>
                        <option value="lastWeek">Dernière semaine</option>
                        <option value="lastMonth">Dernier mois</option>
                    </select>

                    <label for="dateDebut">Date de début</label>
                                <input type="date" name="dateDebut" id="dateDebut">
                                <label for="dateFin">Date de fin</label>
                                <input type="date" name="dateFin" id="dateFin">

                    <label for="stage">Stage</label>
                    <input type="checkbox" name="stage" id="stage">
                    <label for="alternance">Alternance</label>
                    <input type="checkbox" name="alternance" id="alternance">

                    <label for="codePostal">Code Postal:</label>
                        <input type="text" id="codePostal" name="codePostal" pattern="[0-9]{5}" maxlength="5">

                    <label for="optionTri">Trier par</label>
                                <select name="optionTri" id="optionTri">
                                    <option value="datePublication">Offres les plus récentes</option>
                                    <option value="datePublicationInverse">Offres les plus anciennes</option>
                                    <option value="salaireCroissant">Salaire croissant</option>
                                    <option value="salaireDecroissant">Salaire décroissant</option>
                                </select>

                    <button type="reset">Tout effacer</button>

                    <button type="button" id="rechercher">Rechercher</button>
        </form>
<!--        FIN PROPOSITION NOUVEAUX FILTRES-->

        <form method="get">
            <label for="dateDebut">Date de début</label>
            <input type="date" name="dateDebut" id="dateDebut">
            <label for="dateFin">Date de fin</label>
            <input type="date" name="dateFin" id="dateFin">
            <label for="optionTri">Option tri</label>
            <select name="optionTri" id="optionTri">
                <option value="ville">Ville</option>
                <option value="thematique">Thématique</option>
                <option value="sujet">Sujet</option>
                <option value="taches">Taches</option>
            </select>
            <input type="hidden" name="action" value="getExpProByFiltre"/>
            <input type="hidden" name="controller" value="ExpPro">
            <input type="submit" value="Envoyer"/>
        </form>


        <textarea id="search-bar" name="session_id" rows="1" cols="50" style="resize: none"
                              placeholder="Rechercher une offre" ></textarea>
        <button class="custom-button" onclick="joinSessionById()">
            <img src="assets/images/loupe.png" alt="Loupe Icon" width="20" height="20">
        </button>
    </div>

<div class="table-responsive" style="display:flex;">
      <table class="table table-bordered" style="border:none;">
       <thead>
         <tr>
         </tr>
       </thead>
       <tbody>
         <?php
           $rank = 1;
           $cellCount = 0;
           foreach ($listeExpPro as $expPro) {
             if ($cellCount === 0) {
               echo '<tr>';
             }
             ?>
             <td class="session-cell" data-session-id="<?php echo $data['idSession']; ?>">
               <?php require 'smallOffer.php'; ?>
             </td>
             <?php
             $cellCount++;
             if ($cellCount === 3) {
               echo '</tr>';
               $cellCount = 0;
             }
           }
           if ($cellCount > 0) {
             echo str_repeat('<td colspan="3"></td>', 3 - $cellCount) . '</tr>';
           }
            ?>

       </tbody>
     </table>
   </div>


</body>
</html>
