<?php if (!empty($pokemons)): ?> 
   <section>
    <table>
       <?php foreach ($pokemons as $pokemon): ?>
           <tr>
               <td><img src="<?= $pokemon->__get('image'); ?>"></td>
               <td><?= $pokemon->__get('name'); ?></td>
               <td>
                   <form action="" method="POST" class="del-form">
                       <input type="hidden" name='id' value="<?= $pokemon->__get('id'); ?>">
                       <input type="submit" value="Remove">
                   </form>
               </td>
           </tr>
       <?php endforeach; ?>  
    </table>
</section>
<?php endif; ?>