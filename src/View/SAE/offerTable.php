<div class="tableResponsive">
<?php
foreach($listeExpPro as $expPro){
    require 'smallOffer.php';
}
?>
<!--
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
             if ($cellCount === 4) {
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
     -->
   </div>