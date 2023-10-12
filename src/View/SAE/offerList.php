<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/offer.css">
    <link rel="stylesheet" href="assets/css/filter.css">
</head>

<body>
    <div class="container">

    <textarea id="search-bar" name="session_id" rows="1" cols="50" style="resize: none"
                                  placeholder="Rechercher une offre" ></textarea>
    <button class="custom-button" onclick="joinSessionById()">
        <img src="assets/images/loupe.png" alt="Loupe Icon" width="20" height="20">
    </button>

        <form method="get" style="display:none">
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


    </div>
<div class="HBox" id="center">

<div class="container VBox" id="sideFilter">
<form method="get">

                    <select name="datePublication" id="datePublication">
                    <option value="" disabled selected style="display:none;">Période de publication</option>
                        <option value="last24">Dernières 24 heures</option>
                        <option value="lastWeek">Dernière semaine</option>
                        <option value="lastMonth">Dernier mois</option>
                    </select>

                    <label for="dateDebut">Date de début</label>
                                <input type="date" name="dateDebut" id="dateDebut">
                                <label for="dateFin">Date de fin</label>
                                <input type="date" name="dateFin" id="dateFin">


                    <div class="button-checkbox">
                        <input type="checkbox" id="stage" name="stage" value="stage">
                        <label for="stage">Stage</label>
                    </div>

                    <div class="button-checkbox">
                        <input type="checkbox" id="alternance" name="alternance" value="alternance">
                        <label for="alternance">Alternance</label>
                    </div>



                        <label for="codePostal">Code Postal</label>
                        <input type="text" id="codePostal" name="codePostal" pattern="[0-9]{5}" maxlength="5" placeholder="34090">

                                <select name="optionTri" id="optionTri">
                                <option value="" disabled selected style="display:none;">Trier par</option>

                                    <option value="datePublication">Offres les plus récentes</option>
                                    <option value="datePublicationInverse">Offres les plus anciennes</option>
                                    <option value="salaireCroissant">Salaire croissant</option>
                                    <option value="salaireDecroissant">Salaire décroissant</option>
                                </select>

                    <button type="reset" id="reset">Tout effacer</button>

                    <input type="submit" id="rechercher" value="rechercher">
        </form>
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
             if ($cellCount === 2) {
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
   </div>


</body>
</html>
